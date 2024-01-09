<?php
require_once '../db/db.php';
require_once '../db/data1.php';

try {
    $pdo = Database::get()->connect();
    $data = new Data1($pdo);
    //$data->createTest1Table();
    //$data->insertDataToTest1Table();
    echo json_encode($data->getTable());
} catch(\PDOException $e) {
    echo $e->getMessage();
}
