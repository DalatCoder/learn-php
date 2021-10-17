<?php

class DatabaseTable
{
    public function findAll($pdo, $table)
    {
        $sql = "SELECT * FROM `$table`";
        $result = query($pdo, $sql);

        return $result->fetchAll();
    }

    public function findById($pdo, $table, $primaryKey, $value)
    {
        $sql = "SELECT * FROM `$table` WHERE `$primaryKey` = :value";

        $parameters = [
            'value' => $value
        ];

        $query = query($pdo, $sql, $parameters);

        return $query->fetch();
    }

    public function total($pdo, $table)
    {
        $sql = "SELECT COUNT(*) FROM `$table`";
        $query = query($pdo, $sql);
        $row = $query->fetch();
        return $row[0];
    }

    private function insert($pdo, $table, $fields)
    {
        $sql = 'INSERT INTO `' . $table . '` (';

        foreach ($fields as $key => $value) {
            $sql .= "`$key`, ";
        }

        $sql = rtrim($sql, ', ');

        $sql .= ') VALUES (';

        foreach ($fields as $key => $value) {
            $sql .= ":$key, ";
        }

        $sql = rtrim($sql, ', ');

        $sql .= ')';

        $fields = processDate($fields);

        query($pdo, $sql, $fields);
    }

    private function update($pdo, $table, $primaryKey, $fields)
    {
        $sql = 'UPDATE `' . $table . '` SET ';

        foreach ($fields as $field_name => $updated_value) {
            $sql .= "`$field_name` = :$field_name, ";
        }
        $sql = rtrim($sql, ', ');

        $sql .= ' WHERE `' . $primaryKey . '` = :primaryKey';

        $fields = processDate($fields);

        $fields['primaryKey'] = $fields['id'];

        query($pdo, $sql, $fields);
    }

    public function save($pdo, $table, $primaryKey, $record)
    {
        try {
            if ($record[$primaryKey] == '') {
                $record[$primaryKey] = null;
            }

            insert($pdo, $table, $record);
        } catch (PDOException $e) {
            update($pdo, $table, $primaryKey, $record);
        }
    }

    public function delete($pdo, $table, $primaryKey, $id)
    {
        $sql = "DELETE FROM `$table` WHERE `$primaryKey` = :id";
        $parameters = [
            'id' => $id
        ];

        query($pdo, $sql, $parameters);
    }

    private function query($pdo, $sql, $parameters = [])
    {
        $query = $pdo->prepare($sql);

        foreach ($parameters as $name => $value) {
            $query->bindValue($name, $value);
        }

        $query->execute();
        // $query->execute($parameters);
        return $query;
    }

    private function processDate($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $fields;
    }
}
