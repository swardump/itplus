<?php
class Node 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTableNode() 
    {
        $sql = 'CREATE TABLE if not exists node (
                    id SERIAL PRIMARY KEY,
                    id_branch int4 NOT NULL,
                    nameNode varchar(255) UNIQUE NOT NULL,
                    FOREIGN KEY (id_branch)
                        REFERENCES branch (id)
                );';

        $this->pdo->exec($sql);
    }

    public function insertData() 
    {
        $sql = "
            INSERT INTO node(id_branch, nameNode) VALUES (1,'Узел 1');
            INSERT INTO node(id_branch, nameNode) VALUES (1,'Узел 2');
            INSERT INTO node(id_branch, nameNode) VALUES (1,'Узел 3');
            INSERT INTO node(id_branch, nameNode) VALUES (1,'Узел 4');
            INSERT INTO node(id_branch, nameNode) VALUES (2,'Узел 5');
            INSERT INTO node(id_branch, nameNode) VALUES (2,'Узел 6');
            INSERT INTO node(id_branch, nameNode) VALUES (2,'Узел 7');
            INSERT INTO node(id_branch, nameNode) VALUES (3,'Узел 8');
            INSERT INTO node(id_branch, nameNode) VALUES (3,'Узел 9');
            INSERT INTO node(id_branch, nameNode) VALUES (4,'Узел 10');
        ";
        $this->pdo->exec($sql);
    }

    public function getNode($id_branch) {
        $data = [
            'id_branch' => $id_branch,
        ];
        $sql = "
            select id, namenode from node where id_branch = :id_branch
        ";
        $result = $this->pdo->prepare($sql);
        //$result->bindParam(':id_branch',$id_branch, PDO::PARAM_INT);
        $result->execute($data);
        $tableList = [];
        $index = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC))
        {
            $tableList[$index]['id'] = $row['id'];
            $tableList[$index]['nameNode'] = $row['namenode'];
            $index++;
        }

        return $tableList;
    }
}