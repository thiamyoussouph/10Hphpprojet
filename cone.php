<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=db_micros', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('SET NAMES "utf8"');
} catch (\Throwable $th) {
    echo 'Error: ' . $th->getMessage();
    exit();
}
?>