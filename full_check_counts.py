import sqlite3
sqlite_db = 'c:\\xampp\\htdocs\\dmr\\dmr_recovery\\db.sqlite3'
conn = sqlite3.connect(sqlite_db)
cursor = conn.cursor()
cursor.execute("SELECT name FROM sqlite_master WHERE type='table';")
tables = [t[0] for t in cursor.fetchall()]
for table in sorted(tables):
    try:
        cursor.execute(f"SELECT count(*) FROM `{table}`")
        count = cursor.fetchone()[0]
        print(f"{table}: {count}")
    except Exception as e:
        print(f"{table}: ERROR ({e})")
conn.close()
