<?php
class Data1 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTest1Table() 
    {
        $sql = 'CREATE TABLE if not exists test1 (
                    id int4 NOT NULL,
                    dt timestamp(6) NOT NULL,
                    group_id int4 NOT NULL
                );';

        $this->pdo->exec($sql);
    }

    public function insertDataToTest1Table() 
    {
        $sql = "
            DO
            \$do\$
            BEGIN
                IF NOT EXISTS (select * from public.test1 limit 1) THEN
                    INSERT INTO test1 VALUES (1, '2020-01-21 00:00:00', 1);
                    INSERT INTO test1 VALUES (2, '2020-01-22 00:00:00', 2);
                    INSERT INTO test1 VALUES (3, '2020-01-17 00:00:00', 1);
                    INSERT INTO test1 VALUES (4, '2020-01-20 00:00:00', 3);
                    INSERT INTO test1 VALUES (5, '2020-01-14 00:00:00', 4);
                    INSERT INTO test1 VALUES (6, '2020-01-16 00:00:00', 5);
                    INSERT INTO test1 VALUES (7, '2020-01-13 00:00:00', 6);
                    INSERT INTO test1 VALUES (8, '2020-01-18 00:00:00', 4);
                    INSERT INTO test1 VALUES (9, '2020-01-10 00:00:00', 7);
                    INSERT INTO test1 VALUES (10, '2020-01-12 00:00:00', 4);
                END IF;
            END
            \$do\$
        ";
        $this->pdo->exec($sql);
    }

    public function getTable() 
    {
        $sql = "
            SELECT t1.id, t1.dt, t1.group_id
            FROM public.test1 t1
            INNER JOIN (
                SELECT group_id, MAX(dt) AS max_dt
                FROM public.test1
                GROUP BY group_id
            ) t2 ON t1.group_id = t2.group_id
            ORDER BY t2.max_dt DESC, t1.group_id, t1.dt DESC;
        ";
        $result = $this->pdo->query($sql);
        $tableList = [];
        $index = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC))
        {
            $tableList[$index]['id'] = $row['id'];
            $tableList[$index]['dt'] = $row['dt'];
            $tableList[$index]['group_id'] = $row['group_id'];
            $index++;
        }

        return $tableList;
    }
}