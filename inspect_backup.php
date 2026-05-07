<?php
$sqlite = new PDO('sqlite:C:/Users/mohit/Downloads/db.sqlite3');
$tables = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
print_r($tables);
foreach ($tables as $table) {
    if (strpos($table, 'product') !== false) {
        $count = $sqlite->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        echo "$table: $count rows\n";
    }
}
