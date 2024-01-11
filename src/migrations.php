<?php

use App\Database\DB;

require(__DIR__ . '/../vendor/autoload.php');


function run() {
    $connection = (new DB)->getConnection();
    $statements = [
        'CREATE TABLE contacts( 
        id   INT NOT NULL,
        email  VARCHAR(50) NOT NULL, 
        phone VARCHAR(50) NULL, 
        name   VARCHAR(50) NULL,
        last_name   VARCHAR(50) NULL,
        PRIMARY KEY(id)
    );',
        'CREATE TABLE deals (
        id   INT NOT NULL, 
        contact_id INT NOT NULL,
        title VARCHAR(50) NULL, 
        type  VARCHAR(50) NULL,
        close_date  DATE NULL,
        PRIMARY KEY(id),
        CONSTRAINT fk_contact 
            FOREIGN KEY(contact_id) 
            REFERENCES contacts(id) 
            ON DELETE CASCADE
    )'];

    foreach ($statements as $statement) {
        $connection->exec($statement);
    }
}

run();