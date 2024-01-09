<?php
require_once '../db/db.php';
require_once '../db/damageList.php';

$nameBranch = $_POST['nameBranch'];
$nameNode = $_POST['nameNode'];
$countDamage = $_POST['countDamage'];

try {
    $pdo = Database::get()->connect();
    $dl = new DamageList($pdo);
    $dl->insertData($nameBranch, $nameNode, $countDamage);
} catch(\PDOException $e) {
    echo $e->getMessage();
}