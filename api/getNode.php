<?php
require_once '../db/db.php';
require_once '../db/node.php';

$id_branch = $_GET['id_branch'];

try {
    $pdo = Database::get()->connect();
    $node = new Node($pdo);
    echo json_encode($node->getNode($id_branch));
} catch(\PDOException $e) {
    echo $e->getMessage();
}