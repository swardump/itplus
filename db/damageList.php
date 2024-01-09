<?php
class DamageList 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTableDamageList() 
    {
        $sql = 'CREATE TABLE if not exists damageList (
                    id SERIAL PRIMARY KEY,
                    nameBranch int4 NOT NULL,
                    nameNode int4 NOT NULL,
                    timeDamage timestamp(6) WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                    countDamage numeric(6,2)
                );';

        $this->pdo->exec($sql);
    }

    public function getTable()
    {
        $sql = "select damagelist.id, branch.namebranch, node.namenode, TO_CHAR(damagelist.timedamage, 'DD-MM-YYYY HH24:MI:SS') as timedamage, damagelist.countdamage 
                from damagelist 
                inner join node  on damagelist.namenode = node.id
                inner join branch on damagelist.namebranch = branch.id";
        $result = $this->pdo->query($sql);
        $tableList = [];
        $index = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC))
        {
            $tableList[$index]['id'] = $row['id'];
            $tableList[$index]['nameBranch'] = $row['namebranch'];
            $tableList[$index]['nameNode'] = $row['namenode'];
            $tableList[$index]['timeDamage'] = $row['timedamage'];
            $tableList[$index]['countDamage'] = $row['countdamage'];
            $index++;
        }

        return $tableList;
    }

    public function insertData($nameBranch, $nameNode, $countDamage) 
    {
        $data = [
            'nameBranch' => $nameBranch,
            'nameNode' => $nameNode,
            'countDamage' => floatval($countDamage),
        ];

        var_dump($data);
        $sql = "
            INSERT INTO damageList(nameBranch, nameNode, countDamage) VALUES (:nameBranch, :nameNode, :countDamage);
        ";

        $this->pdo->prepare($sql)->execute($data);
    }

    public function deleteData($id) 
    {
        $data = [
            'id' => $id,
        ];

        var_dump($data);
        $sql = "
            DELETE FROM damageList WHERE id = :id
        ";

        $this->pdo->prepare($sql)->execute($data);
    }

    public function updateData($id,$nameBranch, $nameNode, $countDamage) 
    {
        $data = [
            'id' => $id,
            'nameBranch' => $nameBranch, 
            'nameNode' => $nameNode, 
            'countDamage' => $countDamage
        ];

        var_dump($data);
        $sql = "
            UPDATE damageList SET
            namebranch = :nameBranch,
            namenode = :nameNode,
            countdamage = :countDamage,
            timedamage = current_timestamp
            WHERE id = :id;
        ";

        $this->pdo->prepare($sql)->execute($data);
    }
}