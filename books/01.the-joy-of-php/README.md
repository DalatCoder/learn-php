## 2. Introducing PHP 

- A `static web page` never changes, unless a person specifically edits the page.

- A `dynamic web page` can be different every time it is viewed by a browser, because the `server` edits the page `prior` to sending it to the browser, according to what instructions the programmer has coded into that specific page.

- A `PHP file` is just an HTML file saved using a `.php` extensioninstead of an `.html` or `.htm` extension, which tells the server to look in the page for code.

- PHP is a language that can be used to create dynamic web pages. In fact, that is the `point` of PHP.

- Text on a PHP page is normally static. The `PHP` server will dynamically convert the text that appears in between `<?php ?>` tags into static text, after evaluating what the code means.

- The `PHP echo` statement sends whatever text follows the statement to the browser.

### 2.1. A Countdown Counter 

The `mktime` function is used to get the `timestamp` for a specified date. It is phrased as `mktime(hour, minute, second, month, day, year, is_dst)` 

```php
$target = mktime(0, 0, 0, 9, 30, 2012);
$today = time();

$difference = ($target - $today);

$days = (int)($difference / 86400);
$hours = (int)($difference / 3600);
```

## 3. Variables

### 3.1. Numbers

- `abs()` returns the absolute value of a number.
- `pi()` returns the value of pi.
- `round()` rounds a number to the nearest integer.
- `sqrt()` returns the square root of a number

### 3.2. Strings

- `htmlentities()` converts a string to its `HTML` equivalent.
- `html_entity_decode()` converts `HTML` code back to a string.
- `str_pad()` pads a string to a new length.
- `str_repeat()` repeats a string a specified number of times.
- `str_replace()` replaces some characters in a string (case-sensitive).
- `strtoupper()` converts a string to all upper case.

## 4. How to interpret `PHP.NET` documentation

```html
<code>substr</code>
<p>(PHP 4, PHP 5)</p>
<p>substr - Return part of a string</p>

<code>string substr(string $string, int $start, [, int $length])</code>

<p>Returns the portion of string specified by the start and length parameters</p>
```

## 5. Variable Scope

The scope of a variable defines where the value can be accessed. If a variable is declared on its own line on a page, it is available anywhere on that page. If a variable is declared within a function, it will only be available within that function.

If you want a particular variable to be available everywhere, declare it using the global keyword, such as 

```php
global $a = 'Global string';
```

There is a special kind of variable that can be accessed on `every page` that makes up your web application. This topic is covered in `Session Variables`.

## 6. How to use a database, such as MySQL

Databases help to organize and track things. Databases allow you to use creativity to group things together in meaningful ways, and to present the same set of information in different ways to different audiences.

> "Databases" are simiply an organized collection of data stored in a computer.

Databases are composed of one or more `tables`. Tables are composed of parts called `rows` and `columns` similar to what you would see in a spreadsheet. The columns section of each table declares the characteristics of each table while each row contains unique data for each element in the table.

Here is a quick review of what we have learned. 

- `Tables` are just a collection of things that you want to keep track of.
- `Tables` consist of rows and columns.
- `Columns` hold the different attributes of each element in that table. Rows in a table hold different instances uniquely defined by the table's columns. 
- `Databases` are a collection of tables.

### 6.1. Introduce to SQL 

SQL (pronounced "sequel") or Structured Query Language is a language all its own. SQL is a special-purpose programming language designed for managing data in relational database management systems, such as mySQL. SQL can be used to create databases, create tables, and insert, update, and delete data into tables.

## 7. Using MySQL and PHP together

```php

$mysqli = new mysqli('localhost', 'root', 'root_password');

if (!$mysqli) {
	die('Could not connect: ' . mysqli_error($mysqli));
}

echo 'Connected successfully!';

$create_success = $mysqli->query('CREATE DATABASE Cars');
if ($create_success) {
	die('Database Cars Created');
}

echo 'Database Cars Created';

$mysqli->select_db('Cars');

echo 'Selected the Cars database';

$mysqli->close();
```

## 8. Session Variables

### 8.1. Introduction

Variable in PHP typically have a specific and limited scope - generally, a variable is only available on the page on which it was declared. The prime exception to this rule is when you declare a variable inside a function, it only works in that function.

But what if you want access to the `same` variable across multiple pages in your application? For instance, I'm regular shopper on `Amazon.com`. If you are too, you may have noticed that once you're logged in, `every page` has your name on the top of it.

### 8.2. Sessions 

A session variable is a special kind of variable that, once set, is available to all the pages in an application for as long as the user has their browser open, or until the session is explicitly terminated by the developer (you).

The great thing about session variables is that PHP will magically keep track of which particular session variable goes with each particular user. So while my `Amazon.com` experience will always say "Hieu's Amazon", yours will say something different (unless your name also happens to be Alan, of course). Sessions work by creating a unique id (UID) for each visitor and storing variables based on this UID. The UID is typically stored in a cookie. 

> A cookie, also known as an HTTP cookie, web cookie, or browser cookie, is a small piece of data sent from a website and stored in a user's web browser while a user is browsing a website. 

Once a user closes their browser, the cookie will be erased and the session will end. So sessions are not a good place to store data you intend to keep for long. The right place to store long-term data is in a database. Of course, sessions and databases can work together. For instance, you can store a user's preferences in a database, and retrieve them from the database when the user "logs in" or types in their email address or does whatever it is that you coded for them to identify themselve. Once the data is retrieved, assign the preferences to the session variables and they will be avaiables and they will be available from then on.

### 8.3. Starting a PHP Session 

Before you can store user information in your PHP session, you must first start up the session using the `session_start()` function. The `session_start()` function `must` appear before the `<html>` tag, or it won't work.

```php
<?php session_start(); ?>

<html>
	<body>
	</body>
</html>
```

### 8.4. Using Session Variables

Using the PHP `$_SESSION` variable.

- Store a variable

```php
<?php session_start(); ?>

<html>
	<body>
		</php $_SESSION['FirstName'] = 'Hieu'; ?>
	</body>
</html>
```

- Retrieve a variable

```php
<?php session_start(); ?>

<html>
	<body>
		</php echo $_SESSION['FirstName']; ?>
	</body>
</html>
```

- Checking for a variable

```php
if (isset($_SESSION['token'])) {
	// Get token
}
```

- Destroying a Session

	- `unset()`: delete some session data 
	- `session_destroy()`: delete it all

### 8.5. PHP File Uploads

#### 8.5.1. Create an Upload File form

```html
<html>
	<body>

		<form method="POST" action="upload_file.php" enctype="multipart/form-data">
			<labe for="file">Filename: </labe>
			<input type="file" name="file" id="file">
			<input type="submit" name="submit" value="Upload">
		</form>

	</body>
</html>
```

- `action='upload_file.php'` means that when you click the submit button, the result of the form post will be passed to the `upload_file.php` script for further processing.
- `enctype='multipart/form-data'` is the encoding type to be used by the form. You have to specify that it is `multipart/form-data` if you are including a file upload control on a form, so the browser knows to pass the file as a file, and not as just another big block of text.

#### 8.5.2. Process the Uploaded File 

```php
<?php 

if ($_FILES['file']['error'] > 0) {
	echo 'Error: ' . $_FILES['file']['error'];
	return null;
}

$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];
$filesize = $_FILES['file']['size'] / 1024;
$temppath = $_FILES['file']['tmp_name'];

$current_folder = getcwd();
$upload_folder =$current_folder . "/uploads/";
$target_path = $upload_folder . basename($_FILES['file']['name']);

$save_success = move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
if ($save_success) {
	echo 'The file ' . basename($_FILES['file']['name']) . ' has been uploaded';
}
```

```php
<?php 

if ($_FILES['file']['error'] > 0) {
	echo 'Error: ' . $_FILES['file']['error'];
	return null;
}

$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];
$filesize = $_FILES['file']['size'] / 1024;
$temppath = $_FILES['file']['tmp_name'];

$current_folder = getcwd();
$upload_folder =$current_folder . "/uploads/";
$target_path = $upload_folder . basename($_FILES['file']['name']);

$save_success = move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
if ($save_success) {
	echo 'The file ' . basename($_FILES['file']['name']) . ' has been uploaded';
}
```

## 9. PHP Quirks and Tips 

### 9.1. Comparison Operators

- `$a == $b`: Equal 
- `$a === $b`: Identical 
- `$a != $b`: Not equal 
- `$a <> $b`: Not equal 
- `$a !== $b`: Not identical
- `$a < $b`: Less than 
- `$a > $b`: Greater than 
- `$a <= $b`: Less than or equal to 
- `$a >= $b`: Greater than or equal to 


