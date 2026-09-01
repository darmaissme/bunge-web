<?php
// Automatic deployment script to unzip package and import database on liege server
header('Content-Type: text/plain');

echo "=== BUNGE EVENT MICROSITE DEPLOYER ===\n";

$zipFile = __DIR__ . '/deploy_package.zip';
if (file_exists($zipFile)) {
    echo "Unzipping deploy_package.zip...\n";
    $zip = new ZipArchive();
    if ($zip->open($zipFile) === TRUE) {
        $zip->extractTo(__DIR__);
        $zip->close();
        echo "SUCCESS: All files extracted successfully!\n";
        // @unlink($zipFile);
    } else {
        echo "ERROR: Failed to open deploy_package.zip\n";
    }
} else {
    echo "INFO: deploy_package.zip not found (files may already be uploaded).\n";
}

// Database Import
$host = 'localhost';
$db   = 'eventbun_bunge';
$user = 'eventbun_bungeadmin';
$pass = 'November@202103';

echo "\nConnecting to MySQL ($user @ $db)...\n";
$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    echo "ERROR: MySQL Connection failed: " . $mysqli->connect_error . "\n";
} else {
    echo "Connected to MySQL successfully!\n";

    $sqlFile = __DIR__ . '/bunge_flexibetter_db_checkpoint_21.sql';
    if (file_exists($sqlFile)) {
        echo "Importing database schema & seed data...\n";
        $sql = file_get_contents($sqlFile);
        
        if ($mysqli->multi_query($sql)) {
            do {
                if ($result = $mysqli->store_result()) {
                    $result->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());
            
            if ($mysqli->error) {
                echo "DB IMPORT WARNING: " . $mysqli->error . "\n";
            } else {
                echo "SUCCESS: Database eventbun_bunge imported successfully!\n";
            }
        } else {
            echo "DB IMPORT ERROR: " . $mysqli->error . "\n";
        }
    } else {
        echo "WARNING: SQL file not found at " . $sqlFile . "\n";
    }
    $mysqli->close();
}

echo "\n=== DEPLOYMENT COMPLETE ===\n";
