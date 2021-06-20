# BẮT ĐẦU VỚI NGÔN NGỮ PHP

## HTTP Verbs

### GET

- Data appended to URL
- Size limit (~500 - 2000 characters)
- `$_GET`

### POST

- Data in body of HTTP Request
- No size limit, file uploads possible
- `$_POST` (`$_FILES` for uploads)

## Escaping Form Ouput

```php
if (isset($_POST['search'])) {
    // $_POST['search'] exists
}
```

Use `htmlspecialchars(html, ENT_QUOTE)` to escape special characters

`PHP Web Application course` on Pluralsight

## Validating Form Data

- check for non-empty values for text fields, radio buttons, and checkboxes
- Special treatment for lists
- Consider using JavaScript validation as an additional feature

## Using MySQL with PHP

- Install PHPMyAdmin
- Enable `mysqli` extension in `php.ini`

## Using `mysqli` extension

### Connection

```php
$db = new mysqli(
  'localhost',
  'user',
  'password',
  'database_name'
)
```

### Close connection

```php
$db->close();
```

### Insert data

```php
$db->query(
  "INSERT INTO table (col1, col2)
    VALUES ('1', '2')"
);
```

### SQL Injection

- `printf()`: Print the result string
- `sprintf()`: Return the result string

```php
$sql = sprintf(
  "INSERT INTO table (col1, col2)
    VALUES ('%s', '%s')",
    $db->real_escape_string('value1'),
    $db->real_escape_string('value2')
);

$db->query($sql);
```

### Prepared Statements

```php
$statement = $db->prepare(
  "INSERT INTO table (col1, col2) VALUES (?, ?)"
);

$statement->bind_param('ss', $value1, $value2);
$statement->execute();
```

### Reading data

```php
$result = $db->query('SELECT * FROM table');

$foreach($result as $row) {
  $value1 = $row['col1'];
  $value2 = $row['col2'];
}
```

### Delete data

```php
$sql = sprintf(
  "DELETE FROM table WHERE col1='%s'",
    $db->real_escape_string('value1'),
);

$db->query($sql);
```

### Update data

```php
$sql = sprintf(
  "UPDATE table SET col1='%s', col2='%s' WHERE col3='%s'",
    $db->real_escape_string('value1'),
    $db->real_escape_string('value2'),
    $db->real_escape_string('value3')
);

$db->query($sql);
```

## Include files

- `include`: Copy file content into the position of the `include` call, give a `warning` if the file is not found
- `include_once`: Make sure to include one time
- `require`: Stop execution when there is no file
- `require_once`: Stop execution when there is no file

## Include HTML files

- `readfile()`

## Secure password storage

Go to [php.net/password](php.net/password)

```php
$hash = password_hash($password, PASSWORD_DEFAULT);
```

- `PASSWORD_DEFAULT`: for the best available algorithm
