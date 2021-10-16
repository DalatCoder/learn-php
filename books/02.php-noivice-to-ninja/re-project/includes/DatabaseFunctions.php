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
        ':id' => $id
    ];
    $sql = 'SELECT * FROM `joke` WHERE `id` = :id';

    $query = query($pdo, $sql, $parameters);
    return $query->fetch();
}

/**
 * Insert New Joke
 *
 * @param [type] $pdo
 * @param [type] $joketext Joke content
 * @param [type] $authorId Joke's author
 * @return void
 */
function insertJoke($pdo, $joketext, $authorId)
{
    $sql = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`)
            VALUES (:joketext, CURDATE(), :authorId)';

    $parameters = [
        ':joketext' => $joketext,
        ':authorId' => $authorId
    ];

    query($pdo, $sql, $parameters);
}

/**
 * Update a joke
 *
 * @param [type] $pdo
 * @param [type] $jokeId Joke ID to be updated
 * @param [type] $joketext New joke content
 * @param [type] $authorId The author
 * @return void
 */
function updateJoke($pdo, $jokeId, $joketext, $authorId)
{
    $sql = 'UPDATE `joke` 
            SET `authorId` = :authorId, `joketext` = :joketext
            WHERE `id` = :id';

    $parameters = [
        ':joketext' => $joketext,
        ':authorId' => $authorId,
        ':id' => $jokeId
    ];

    query($pdo, $sql, $parameters);
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
        ':id' => $id
    ];

    query($pdo, $sql, $parameters);
}
