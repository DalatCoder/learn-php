<?php

#region Original Function
/**
function getTotalJokes($database)
{
    $sql = 'SELECT COUNT(*) FROM `joke`';

    $stmt = $database->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetch();

    return $row[0];
}

function getJoke($database, $joke_id)
{
    $sql = 'SELECT * FROM `joke` WHERE `id` = :id';

    $stmt = $database->prepare($sql);
    $stmt->bindValue(':id', $joke_id);
    $stmt->execute();

    return $stmt->fetch();
}
 */
#endregion

#region Extract Query function for DRY

/**
 * Query function for making PDO query
 *
 * @param [type] $pdo PDO Object
 * @param [type] $sql Raw SQL Statement
 * @param array $parameters Parameters for binding
 * @return object PDO Query
 */
function query($pdo, $sql, $parameters = [])
{
    $query = $pdo->prepare($sql);

    foreach ($parameters as $name => $value) {
        $query->bindValue($name, $value);
    }

    $query->execute();
    // $query->execute($parameters);
    return $query;
}

/**
 * Get Number Of Jokes In Database
 *
 * @param [type] $pdo
 * @return int
 */
function getTotalJokes($pdo)
{
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

/**
 * Get Specific Joke Based On $id
 *
 * @param [type] $pdo
 * @param [type] $id
 * @return Joke
 */
function getJoke($pdo, $id)
{
    $parameters = [
        'id' => $id
    ];
    $sql = 'SELECT * FROM `joke` WHERE `id` = :id';

    $query = query($pdo, $sql, $parameters);
    return $query->fetch();
}

/**
 * Insert New Joke
 *
 * @param [type] $pdo
 * @param [type] $fields
 * @return void
 */
function insertJoke($pdo, $fields)
{
    $sql = 'INSERT INTO `joke` (';

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

/**
 * Update a joke
 *
 * @param [type] $pdo
 * @param [type] $fieldsToBeUpdated
 * @return void
 */
function updateJoke($pdo, $fieldsToBeUpdated)
{
    $sql = 'UPDATE `joke` SET ';

    foreach ($fieldsToBeUpdated as $field_name => $updated_value) {
        $sql .= "`$field_name` = :$field_name, ";
    }
    $sql = rtrim($sql, ', ');

    $sql .= ' WHERE `id` = :primaryKey';

    $fieldsToBeUpdated = processDate($fieldsToBeUpdated);

    $fieldsToBeUpdated['primaryKey'] = $fieldsToBeUpdated['id'];

    query($pdo, $sql, $fieldsToBeUpdated);
}

/**
 * Delete a specific joke
 *
 * @param [type] $pdo
 * @param [type] $id
 * @return void
 */
function deleteJoke($pdo, $id)
{
    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
    $parameters = [
        'id' => $id
    ];

    query($pdo, $sql, $parameters);
}

function allJokes($pdo)
{
    $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
            FROM `joke`
            INNER JOIN `author`
                ON `author`.`id` = `authorid`';

    $query = query($pdo, $sql);
    return $query->fetchAll();
}

function processDate($fields)
{
    foreach ($fields as $key => $value) {
        if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d H:i:s');
        }
    }

    return $fields;
}
