<?php
require_once '../db/db.php';
require_once '../db/data2.php';

try {
    $pdo = Database::get()->connect();
    $data = new Data2($pdo);
    //$data->createTest2Table();
    //$data->insertDataToTest2Table();
    echo json_encode($data->getTable());
} catch(\PDOException $e) {
    echo $e->getMessage();
}
