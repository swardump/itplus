<?php
require_once '../db/db.php';
require_once '../db/branch.php';

try {
    $pdo = Database::get()->connect();
    $branch = new Branch($pdo);

    echo json_encode($branch->getBranch());
} catch(\PDOException $e) {
    echo $e->getMessage();
}