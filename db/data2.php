<?php
class Data2 
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTest2Table() 
    {
        $sql = 'CREATE TABLE if not exists test2 (
                    id int4 NOT NULL,
                    dt timestamp(6) NOT NULL,
                    group_id int4 NULL
                );';

        $this->pdo->exec($sql);
    }

    public function insertDataToTest2Table() 
    {
        $sql = "
            DO
            \$do\$
            BEGIN
                IF NOT EXISTS (select * from public.test2 limit 1) THEN
                    INSERT INTO test2 VALUES (1, '2020-01-21 00:00:00', 1);
                    INSERT INTO test2 VALUES (2, '2020-01-22 00:00:00', null);
                    INSERT INTO test2 VALUES (3, '2020-01-17 00:00:00', 1);
                    INSERT INTO test2 VALUES (4, '2020-01-20 00:00:00', null);
                    INSERT INTO test2 VALUES (5, '2020-01-14 00:00:00', 4);
                    INSERT INTO test2 VALUES (6, '2020-01-16 00:00:00', null);
                    INSERT INTO test2 VALUES (7, '2020-01-13 00:00:00', null);
                    INSERT INTO test2 VALUES (8, '2020-01-18 00:00:00', 4);
                    INSERT INTO test2 VALUES (9, '2020-01-10 00:00:00', null);
                    INSERT INTO test2 VALUES (10, '2020-01-12 00:00:00', 4);
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
            FROM public.test2 t1
            LEFT JOIN (
                SELECT group_id, MAX(dt) AS max_dt
                FROM public.test2
                GROUP BY group_id
            ) t2 ON t1.group_id = t2.group_id
            ORDER BY case when t2.max_dt is not null then t2.max_dt else t1.dt end DESC, t1.dt desc;
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