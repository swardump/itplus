<?php
require_once '../db/db.php';
require_once '../db/damageList.php';

$id = $_POST['id'];
$nameBranch = $_POST['nameBranch']; 
$nameNode = $_POST['nameNode'];
$countDamage = $_POST['countDamage'];

try {
    $pdo = Database::get()->connect();
    $dl = new DamageList($pdo);
    $dl->updateData($id,$nameBranch, $nameNode, $countDamage);
} catch(\PDOException $e) {
    echo $e->getMessage();
}