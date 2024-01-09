<?php
require_once '../db/db.php';
require_once '../db/damageList.php';
require_once '../db/branch.php';
require_once '../db/node.php';

try {
    $pdo = Database::get()->connect();
    $dl = new DamageList($pdo);
    $branch = new Branch($pdo);
    $node = new Node($pdo);

    echo json_encode($dl->getTable());
} catch(\PDOException $e) {
    echo $e->getMessage();
}
