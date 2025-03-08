<?php

$db = new SQLite3(__DIR__ . '/database/db.sqlite');

$createTableQuery = <<<SQL
CREATE TABLE IF NOT EXISTS expenses (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name text NOT NULL,
    amount INTEGER NOT NULL,
    date DATE NOT NULL,
    payment_method
);
SQL;

$createTableUserQuery = <<<SQL
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username text NOT NULL,
    password text NOT NULL
);
SQL;

if($db->query($createTableQuery)){
    echo "Table created";
}else{
    echo "Error creating table: " . $db->lastErrorMsg();
}

if($db->query($createTableUserQuery)){
    echo "Table created for users";
}else{
    echo "Error creating table: users " . $db->lastErrorMsg();
}

$db->close();
