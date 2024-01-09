<?php
require_once '../db/db.php';
require_once '../db/damageList.php';

$id = $_POST['id'];

try {
    $pdo = Database::get()->connect();
    $dl = new DamageList($pdo);
    $dl->deleteData($id);
} catch(\PDOException $e) {
    echo $e->getMessage();
}