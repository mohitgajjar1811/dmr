<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class MigrateDjangoData extends Command
{
    protected $signature = 'migrate:django {sqlite_path}';
    protected $description = 'Migrate data from Django SQLite to Laravel MySQL';

    public function handle()
    {
        $sqlitePath = $this->argument('sqlite_path');
        if (!file_exists($sqlitePath)) {
            $this->error("SQLite file not found at $sqlitePath");
            return;
        }

        $sqlite = new PDO("sqlite:$sqlitePath");
        $tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $this->info("Migrating table: $table");

            try {
                $rows = $sqlite->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);

                if (count($rows) > 0) {
                    DB::table($table)->truncate();
                    foreach (array_chunk($rows, 100) as $chunk) {
                        DB::table($table)->insert($chunk);
                    }
                    $this->info("  Successfully migrated " . count($rows) . " rows.");
                } else {
                    $this->warn("  No data found in $table.");
                }
            } catch (\Exception $e) {
                $this->error("  Error migrating $table: " . $e->getMessage());
                
                // If table doesn't exist, try to create it?
                // For now, assume it exists via artisan migrate or manual creation
            }
        }

        $this->info("Migration complete!");
    }
}
