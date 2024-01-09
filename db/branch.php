<?php
class Branch 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTableBranch() 
    {
        $sql = 'CREATE TABLE if not exists branch (
                    id SERIAL PRIMARY KEY,
                    nameBranch varchar(255) UNIQUE NOT NULL
                );';

        $this->pdo->exec($sql);
    }

    public function insertData() 
    {
        $sql = "
            INSERT INTO branch(nameBranch) VALUES ('Филиал №1');
            INSERT INTO branch(nameBranch) VALUES ('Филиал №2');
            INSERT INTO branch(nameBranch) VALUES ('Филиал №3');
            INSERT INTO branch(nameBranch) VALUES ('Филиал №4');
        ";
        $this->pdo->exec($sql);
    }

    public function getBranch()
    {
        $sql = "select id, namebranch from branch";
        $result = $this->pdo->query($sql);
        $tableList = [];
        $index = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC))
        {
            $tableList[$index]['nameBranch'] = $row['namebranch'];
            $tableList[$index]['id'] = $row['id'];
            $index++;
        }

        return $tableList;
    }
}