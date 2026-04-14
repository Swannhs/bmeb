<?php
try {
    $db = new SQLite3('/home/swann/WebstormProjects/gov/database/app.db');
    echo "Connected successfully\n";
    $db->exec('CREATE TABLE IF NOT EXISTS test (id INTEGER PRIMARY KEY)');
    echo "Table created\n";
    $db->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
