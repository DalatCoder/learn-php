# PHP & MySQL: Novice to Ninja

> Build your own powerful web applications

## 1. Setup Local Development

PHP is a server-side scripting language. You can think of it as a plugin for your web server that enables it to do more than just send exact copies of the files requested by web browsers. With PHP installed, your web server will be able to run little programs (called PHP scripts) that can do tasks like retrieve up-to-the-minute information from a database and use it to generate a web page on the fly, before sending it to the browser that requested it. Much of this book will focus on writing PHP scripts to do exactly that.

MySQL is a `relational database management system`, or `RDBMS`. We'll discuss the exact role it plays and how it works later, but brefly, it's a software program that's able to organize and manage many pieces of information efficiently while keeping track of how all those pieces of information are related to each other. MySQL also makes that information really easy to access with server-side scripting languages such as PHP. And, like PHP, it's completely free for most uses.

When developing static websites, you can simply load your HTML files directly from your hard disk into your browser to see how they look. There's no web server software involved when you do this, which is find, because web browsers can read and understand HTML code all by themselves.

However, when it comes to dynamic websites built using PHP and MySQL, your web browser needs some help. Web browsers are unable to understand PHP scripts. Instead, PHP scripts contain instructions for a PHP-savvy web server to execute in order to generate the HTML code that browsers can understand.

## 2. Introducing PHP

PHP is a server-side language.

A server-side language is similar to JavaScript in that it allows you to embed little programs (scripts) into the HTML code of a web page. When executed, these programs give you greater control over what appears in the browser window than HTML alone can provide. The key difference between PHP and Javascript is the stage of loading the web page at which these embedded programs are executed.

PHP run by the web server, before sending the web page to the browser. The server-side languages let you generate customized pages on the fly before they're even sent to the browser.

Once the web server has executed the PHP code embedded in a web page, the result takes the place of the PHP code in the page. All the browser sees is standard HTML code when it receives the page. hence the name 'server-side language'.

Server advantages of server-side scripting

- `No browser compatibility issues.`: PHP scripts are interpreted by the web server alone, so there's no need to worry about whether the language features you're using are supported by the visitor's browser.

- `Access to server-side resources`
- `Reduced load on the client`

Quotes

PHP supports both single quotes ' and double quotes " to encase strings. For most purposes, they're interchangeable. PHP developers tend to favor single quotes, because we deal with HTML code a lot, which tends to contain a lot of double quotes.

### 2.1. Variables, Operators and Comments

Variables in PHP are identical to variables in most other programming languages. For the uninitiated, a `variable` can be thought of as a name given to an imaginary box into which any value may be placed.

PHP is a `loosely typed` language. This means that a single variable may contain any type of data - be it a number, a string of text, or some other kind of value - and may store different types of values over its lifetime.

### 2.2. PSR-2

PHP doesn't mind how you format your code and whitespace is ignored. The script will execute in the exact same way. Different programmers have different preferred styles, such as using tabs or spaces for indentation, or placing the opening brace on the same line as the statement or after it. Throughout this book I'll be using a convention known as `PSR-2` but use whatever style you feel most comfortable with.

## 3. Arrays

An `array` is a special kind of variable that contains multiple values. If you think of a variable as a box that contains a value, an array can be thought of as a box with compartments where each compartment is able to store an individual value.

To access a value stored in an array, you need to know its `index`. Typically, arrays use numbers as indices to point to the values they contain, starting with zero.

Each value stored in an array is called an `element`. You can use a key in square brackets to add new elements, or assign new values to existing array elements.

## 4. User Interaction and Forms

For most `database-driven` websites these days, you need to do more than dynamically generate pages based on database data. You also need to provide some degree of interactivity, even if it's just a search box.

PHP have a more limited scope when it comes to support for user interaction comparing to JS. As PHP code is only activated when a request is made to the server, user interaction occurs solely in a back-and-forth fashion: the user sends requests to the server, and the server replies with dynamically generated pages.

The key to creating interactivity with PHP is to understand the techniques we can employ to send information about a user's interaction, along with a request for a new web page. As it turns out, PHP makes this quite easy.

### 4.1. Passing Variables in Links

The simplest way to send information along with a page request is to use the URL query string.

```php
<a href="example.php?name=Hieu">Request</a>
```

This is a link to a file called `example.php`, but as well as linking to the file, you're also passing a variable along with the page request. The variable is called `name`, and its value is `Hieu`.

```php
$name = $_GET['name'];
echo 'Welcome to our website, ' . $name . '!';
```

It turns out that `$_GET` is one of a number of variables that PHP automatically creates when it receives a request from a browser. PHP creates `$_GET` as an array variable that contains any values passed in the URL query string. `$_GET` is an associative array, so the value of the `name` variable passed in the query string can be accessed as `$_GET['name']`.

The user can type any `HTML` code into the `URL`, and your PHP script includes it in the code of the generated page without question. The malicious user could include sophisticated JavaScript code that performs some low action like stealing the user's password. All the attacker would have to do is publish the modified link on some other site under the attacker's control, and then entice one of your users to click it. The attacker could even embed the link in an email and send it to your users. If one of your users clicked the link, the attacker's code would be included in your page and the trap would be sprung!

Perform security

```php
$name = $_GET['name'];
echo 'Welcome to our website, ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '!';
```

What `htmlspecialchars` does is convert "special HTML characters" like < and > into `HTML` character entities like `&lt;` and `&gt;`, which prevents them from being interpreted as HTML code by the browser.

Passing a single variable in the query string was nice, but it turns out you can pass more than one value if you want to!

```php
<a href="example.php?firstname=Hieu&lastname=Nguyen">Request</a>
```

This time, our link passes two variables: `firstname` and `lastname`. The variables are separated in the query string by an ampersand (`&`, which should be written as `&amp;`)

### 4.2. Passing Variables in Forms

```html
<form action="name.php" method="post">
  <label for="firstname">FirstName:</label>
  <input type="text" name="firstname" id="firstname" />

  <label for="lastname">LastName:</label>
  <input type="text" name="lastname" id="lastname" />

  <input type="submit" value="Submit" />
</form>
```

The `method` attribute of the form tag is used to tell the browser how to send the variables and their values along with the request.

### 4.3. GET or POST?

As a rule of thumb, you should only use `GET` forms if, when the form is submitted, nothing on the server `changes` - such as when you're requesting a list of search results. Because the search terms are in the URL, the user can bookmark the search results page and get back to it without having to type in the search term again. Buf if, after submitting the form, a file is deleted, or a database is updated, or a record is inserted, you should use `POST`. The primary reason for this is that if a user bookmarks the page (or presses back in their browser) it won't trigger the form submission again and potentially create a duplicate record.

### 4.4. PHP Templates

In the simple examples we've seen so far, inserting PHP code directly into your HTML pages has been a reasonable approach. As the amount of PHP code that goes into generating your average page grows, however, maintaining tis mixture of HTML and PHP code can become unmanageable.

A much more robust approach is to separate out the bulk of your PHP code so that it resides in its own file, leaving the HTML largly unpolluted by PHP code.

the key to doing this is the PHP `include` statement. With an `include` statement, you can insert the contents of another file into your PHP code at the point of the statement.

In `count.php`

```php
<?php

$output = 'Hello World';

include 'count.html.php';
```

The `include` statement instructs PHP to execute the contents of the `count.html.php` file at this location. You can think of the `include` statement as a kind of `copy` and `paste`. You would get the same result by opening up `count.html.php`, copying the contents and pasting them into `count.php`, overwriting the `include` line.

In `count.html.php`

```php
<!DOCTYPE html>
<html lang="en">
 <head>
 </head>
 <body>
  <p><?php echo $output; ?></p>
 </body>
</html>
```

What we've created here is a PHP template: an HTML page with only very small snippets of PHP code that insert dynamically generated values into an otherwise static HTML page. Rather than embediding the complex PHP code that generates those values in the page, we put the code to generate the values in a separate PHP script.

Using PHP templates like this enables you to hand over your templates to HTML-savvy designers without worrying about what they might do to your PHP code. It also lets you focus on your PHP code without being distracted by the surrounding HTML code.

I like to name my PHP template files so that they end with `.html.php`. As far as your web server is concerned, though, these are still `.php` files; the `.html.php` suffix serves aas a useful reminder that these files contain both HTML and PHP code.

### 4.5. Security Converns

One problem with separating out the HTML and PHP code into different files is that someone could potentially run the `.html.php` code without having had it `included` from a corresponding PHP files.

It's better not to let people run code in a manner you're not expecting. Depending on what the page is doing, this might let them bypass security checks you have in place and view content they shouldn't have access to. For example, consider the following code.

```php
if ($_POST['password'] == 'secret') {
 include 'protected.html.php';
}
```

There are other potential security issues introduced by making all your files accessible via a `URL`. Avoiding security problems like these is easy. You can actually include files from a directory other than the `public` directory.

None of the files outside the `public` directory are accessible via a `URL` (by someone typing the file name into their web browser).

So the question is, when the include files is in a `different` directory, how does a PHP script find it? The most obvious method is to specify the location of the include file as an absolute path.

A better method is to use a `relative` path. That is, the location of a file relative to the current file. When you use `include 'count.html.php'` this is actually a relative path, `count.html.php` is being included from the same directory as the script that was executed.

PHP provides a constant called `__DIR__`, which will always contain the path that contains the `current file`.

This approach will work on any server, because `__DIR__` will differ depending on where the file is stored, and it doesn't depend on the changing `current working directory`. I'll be using this approach for including files throughout this book.

From now on, we'll only write files to the `public` directory that we actually want users to be able to access directly from theri web browser. The `public` directory will contain any PHP scripts the user needs to access directly along with any images, JS and CSS files required by the browser. Any files only referenced by an `include` statement will be placed outside the `public` directory so users can't access them directly.

### 4.6. Many Templates, One Controller

A PHP script that responds to a browser request by selecting one of several PHP templates to fill in and send back is commonly called a `controller`. A `controller` contains the logic that controls which template is sent to the browser.

```php
<?php

<form method="POST" action=""></form>
```

The `action` attribute is blank. This tells the browser to submit the form back to the same URL it received it from - in this case, the `URL` of the controller that included this template file.

Example controller

```php
<?php

if (!isset($_POST['firstname'])) {
 include __DIR__ . '/../templates/form.html.php';
}
else {
 $firstname = $_POST['firstname'];
 $firstname = htmlspecialchars($firstname);

 include __DIR__ . '/../templates/welcome.html.php';
}
```

The `index.php` is because it has a special meaning. `Index.php` is known as a `directory index`. If you don't specify a filename when you visit the `URL` in your browser, the server will look for a file named `index.php` and display that.

### 4.7. Bring on the Database

As you may have gegun to suspect, the real powser of PHP is in its hundreds (even thousands) of built-in functions that let you access data in a MySQL database, send email, dynamically generate images, and even create Adobe Acrobat PDF files on the fly.

## 5. Introducing MySQL

## 6. Publishing MySQL data on the Web

![Relation](assets/relation.png)

This is what happens when there's a visitor to a page on your website:

- The visitor's web browser requests the web page form your web server.
- The web server software (typically Apache or NGINX) recognizes that the requested file is a PHP script, so the server fires up the PHP interpreter to execute the code contained in the file.
- Certain PHP commands (which will be the focus of this chapter) connect to the MySQL database and request the content that belongs in the web page.
- The MySQL database responds by sending the requested content to the PHP script
- The PHP script stores the content into one or more PHP variables, then uses `echo` statements to ouput the content as part of the web page.
- The PHP interpreter finishes up by handing a copy of the HTML it has created to the web server.
- The web server sends the HTML to the web browser as it would a plain HTML files, except that instead of coming directly rom an HTML file, the page is the output provided by the PHP interpreter. The browser has no way of knowing this, however. As far as the browser is concerned, it's requesting and receiving a web page like any other.

### 6.1. Connecting to MySQL with PHP

There are three methods of connecting to a MySQL Server from PHP

- The MySQL library
- The MySQLi library
- The PDO library

The MySQL library is the oldest method of connecting to the database and was introduced in PHP 2.0. The features it contains are minial, and it was superseded by MySQLi as of PHP 5.0

`mysql_connect()` and `mysql_query()` have been `deprecated` - meaning they should be avoided - since PHP 5.5, and have been removed from PHP entirely since PHP 7.0

In PHP 5.0, the MySQLi library, standing for `MySQL Improved`, was released to address some of the limitations in the original MySQL library. Use the functions such as `mysqli_connect` and `mysqli_query`.

There are a few differences between PDO and MySQLi, but the main one is that you can use the PDO library to connect to almost any database server.

After that little history lesson, you're probably eager to get back to writing code. here's how you use PDO to establish a connection to a MySQL server

```php
<?php

$pdo = new PDO('mysql:host=hostname;dbname=database', 'username', 'password')
```

It better to catch exception

```php
<?php

try {
 $pdo = new PDO('mysql:host=hostname;dbname=database', 'username', 'password')
 $output = 'Database connection established';
}
catch (PDOException $e) {
 // Handle exception
 $output = 'Unable to connect to the database server';
}

include __DIR__ . '/../templates/output.html.php';
```

### 6.2. A crash course in OOP

So far, we've written our PHP code in a simpler style called `procedural programming`.

We'd like our DPO object to throw a `PDOException` any time it fails to do what we ask. we configure it do to so by calling the PDO object's `setAttribute` method:

```php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

We can instruct PHP to use UTF-8 when querying the database by appending `;charset=utf8` to the connection string.
Setting the charset as part of the connection string is the preferred option.

```php
<?php

try {
 $pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'username', 'password')
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $output = 'Database connection established';
}
catch (PDOException $e) {
 // Handle exception
 $output = 'Unable to connect to the database server';
}

include __DIR__ . '/../templates/output.html.php';
```

### 6.3. What happens after the script has finished?

You might be wondering what happens to the connection with the MySQL server after the script has finished executing. If you really want to, you can force PHP to disconnect from the server by discarding the PDO object that represents your connection. You do this by setting the variable containing the object to `null`.

```php
$pdo = null; // disconnect from the database server
```

That said, PHP will automatically close any open database connections when it finishes running your script, so you can usually just let PHP clean up after you.

### 6.4. Sending SQL Queries with PHP

```php
$pdo->exec($query);
```

Here, `$query` is a string containing whatever SQL query you want to execute.

```php
<?php

try {
 $pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'username', 'password')
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'CREATE TABLE joke (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    joketext TEXT,
    jokedate DATE NOT NULL
   ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

 $pdo->execute($sql);

 $output = 'Database connection established';
}
catch (PDOException $e) {
 // Handle exception
 $output = 'Unable to connect to the database server';
}

include __DIR__ . '/../templates/output.html.php';
```

### 6.5. Handling SELECT Result Sets

The query method looks just like `exec` in that it accepts an `SQL` query as an argument to be sent to the database server. What it returns, however, is a `PDOStatement` object, which represents a `result set` containing a list of all the rows (entries) returned from the query.

```php
<?php

try {
 $pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'username', 'password')
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'SELECT `joketext` FROM `joke`';
 $results = $pdo->query($sql);

 $output = 'Database connection established';
}
catch (PDOException $e) {
 // Handle exception
 $output = 'Unable to connect to the database server';
}

include __DIR__ . '/../templates/output.html.php';
```

We could use a `while` loop here to process the rows in the result set one at a time

```php
while ($row = $result->fetch()) {
 // Process the row
}
```

The `fetch` method of the `PDOStatement` object returns the next row in the result set as an array. When there are no more rows in the result set, `fetch` returns `false` instead.

It's common to use a `foreach` loop in a PHP template to display each item of an array in turn. Here's how this might look for our `$jokes` array

```php
<?php
foreach ($jokes as $joke) {
 ?>
  HTML code to output each $joke
 <?php
}
?>
```

with this blend of PHP code to describe the loop and HTML code to display it, the code looks rather untidy. Because of this, it's common to use an alternative way of writing the `foreach` loop when it's used in a template:

```php
foreach ($array as $item):
 HTML code to output each $item
endforeach;
```

The two pieces of code are functionally identical, but the lattern looks more friendly when mixed with HTML code. Here's how this form of the code looks in a template

```php
<?php foreach ($jokes as $joke): ?>
 HTML code to output each $joke
<?php endforeach; ?>
```

Another neat tool PHP offers is a shorthand way to call the `echo` command - which, as you've already seen, we need to use frequently. Our `echo` statements look like this

```php
<?php echo $variable; ?>
```

Instead, you can use this

```php
<?= $variable; ?>
```

DRY - Don't repeat yourself

```php
<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <title>IJDB - Internet Joke Database</title>
 </head>
 <body>
  <nav>
   <?php include 'nav.html.php'; ?>
  </nav>
  <main>
   <?php if (isset($error)): ?>
   <p>
    <?=$error?>
   </p>
   <?php else: ?>
    Not error
   <?php endif; ?>
  </main>
  <footer>
   <?php include 'footer.html.php'; ?>
  </footer>
 </body>
</html>
```

There's no way to accurately predict all the changes that might be needed over the lifetime of the website, so instead the approach I showed you at the beginning of this chapter is actually better:

```php
<!doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="jokes.css">
  <title><?=$title?></title>
 </head>
 <body>
  <header>
   <h1>Internet Joke Database</h1>
  </header>
  <nav>
   <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="jokes.php">Jokes List</a></li>
   </ul>
  </nav>
  <main>
   <?=$output?>
  </main>
  <footer>
   &copy; IJDB 2017
  </footer>
 </body>
</html>
```

If we always include this template, which we'll call `layout.html.php`, it's possible to set the `$output` variable to some HTML code and have it appear on the page with the navigation and footer.

Any controller can now use `include __DIR__ . '/../templates/layout.html.php'` and provide values for `$output` and `$title`.

Our `jokes.php` using `layout.html.php` looks like this:

```php
<?php

try {
 $pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'username', 'password')
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $sql = 'SELECT `joketext` FROM `joke`';
 $results = $pdo->query($sql);

 $title = 'Joke List';
 $output = 'Database connection established';
}
catch (PDOException $e) {
 // Handle exception
 $title = 'Joke List';
 $output = 'Error while trying to connect to the database';
}

include __DIR__ . '/../templates/output.html.php';
```

We can extract the logic to show list of `jokes` to another `template` file , called `jokes.html.php`

```php
<?php foreach ($jokes as $joke): ?>
 <p><?= htmlspecialchars($joke, ENT_QUOTES, 'UTF-8') ?></p>
<?php endforeach; ?>
```

Importantly, this is only the code for displaying the jokes. It doesn't contain the navigation, footer, head tag or naything we want repeated on every page; it's only the HTML code that's unique to the joke list page.

To use this template, you might try the following:

```php
while ($row = $result->fetch()) {
 $jokes[] = $row['joketext'];
}

$title = 'Joke list';

include 'jokes.html.php';
```

Or if you're very clever

```php
while ($row = $result->fetch()) {
 $jokes[] = $row['joketext'];
}

$title = 'Joke list';

$output = include 'jokes.html.php';
```

With this approach, your logic would be entirely sound. We need to include the `jokes.html.php`. Unfortunately, the `include` statement just executes the code from the included file at the point it's called. If you run the code above, the output will actually be something like this

```php
 <!-- Output from `jokes.html.php` -->
  <p>First joke</p>
  <p>Second joke</p>
 <!-- Output from `jokes.html.php` -->

 <!-- Output from `layout.html.php` -->
 <!doctype html>
 <html>
  <head>
   <meta charset="utf-8">
   <title>Joke List</title>
  </head>
 </html>
```

Because `jokes.html.php` is included first, it's sent to the browser first. What we need to do is load `jokes.html.php`, but instead of sending the output straight to the browser, we need to capture it and store it in the `$output` variable so that it can be used later by `layout.html.php`.

The `include` statement doesn't return a value, so `$output = include 'jokes.html.php'` does not have the desired effect, and PHP doesn't have an alternative statement to do that.

PHP does have a useful feature called "output buffering". It might sound complicated, but the concept is actually very simple: when you use `echo` to print something, or `include` to include a file that contains HTML, usually it's sent directly to the browser. By making use of output buffering, instead of having the output begin sent straight to the browser, the HTML code is stored on the server in a "buffer", which is basically just a string containing everything that's been printed so far.

Even better, PHP lets you turn on the buffer and read its contents at any time.

There are two functions we need:

- `ob_start()`, which starts the output buffer. After calling this function, anything printed via `echo` or HTML printed via `include` will be stored in a buffer rather than sent to the browser.

- `ob_get_clean()`, which returns the contents of the buffer and clears it.

as you've probably guessed, `ob` in the function names stands for `output buffer`

To capture the contents of an included file, we just need to make use of these two functions

```php
while ($row = $result->fetch()) {
 $jokes[] = $row['joketext'];
}

$title = 'Joke list';

// Start the buffer
ob_start();

// Include the template. The PHP code will be executed,
// but the resulting HTML will be stored in the buffer
// rather than sent to the browser

include __DIR__ . '/../templates/jokes.html.php';

// Read the contents of the output buffer and store them
// in the $output variable for use in layout.html.php

$output = ob_get_clean();
```

When this code runs, the `$output` variable will contain the HTML that was generated in the `jokes.html.php` template.

We'll use this approach from now on. Each page will be made up of two templates:

- `layout.html.php`, which contains all of the common HTML needed by every page
- a unique template that contains only the HTML code that's unique to that particular page

### 6.6. Only Connect to the DB where neccessary

> It's good practive to only connect to the database if you need to. Databases are the most common performance
> bottleneck on most websites, so making as few connections as posible is preferred.

Create home page, `index.php`

```php
</php

$title = 'Internet Joke Database';

ob_start();

include __DIR__ . '/../templates/home.html.php';

$output = ob_get_clean();

include __DIR__ . '/../templates/layout.html.php';
```

### 6.7. Inserting Data into the Database

You need a form. The most important part of the `<form>` element is the `action` attribute. The `action` attribute tells the browser where to send the data once the form is submitted.

However, if you leave the attribute empty by setting it to '', the data provided by the user will be sent back to the page you're currently viewing.

A `prepared statement` is a special kind of SQL query that you've sent to your database server ahead of time, giving the server a chance to prepare it for execution - but not actually execute it. Think of it like writing a `.php` script. The code is there, but doesn't actually get run until you visit the page in your web browser. The SQL code in prepared statements can contain placeholders that you'll supply the values or later, when the query is to be executed. When filling in thse placehoders, PDO is smart enough to guard against 'dangerous' characters automatically.

```php
$sql = 'INSERT INTO `joke` SET
 `joketext` = :joketext,
 `jokedate` = "today's date"
';

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':joketext', $_POST['joketext']);
$stmt->execute();
```

Once we've added the new joke to the database, instead of displaying the PHP template as previously, we want to redirect the user's browser back to the list of jokes.

The way to answer the browser's form submission with an HTTP redirect - s special response that tells the browser to navigate to a different page.

The PHP `header` function provides the means of sending special server responses like this one, by letting you insert specific headers into the response sent to the browser. In order to signal a redirect, you must send a `Location` header with the `URL` of the page to which you wish to direct the browser

```php
header('Location: URL')
```

### 6.8. Don't Use Hyperlinks to Perform Action

In short, hyperlinks should never be used to perform actions (such as deleting a joke); they must only be used to provide a link to some related content. The same gose for forms with `method='get'`, which should only be used to perform quires of existing data. Actions must only ever be performed as a result of a form with `method='post'` being submitted.

## 7. Relational Database Design

SQL Queries fall into two categories:

- Data definition language (DDL) queries. These are the queries that describe `how` the data will be stored. Sthese are the `CREATE TABLE` and `CREATE DATABASE` queries...

- Data manipulation language (DML) quires. These are the queries that you use to manipulate the data in the database.

### 7.1. Rule of Thumb: Keep Entities Separate

> Each type of entity (or "thing") about which you want to be able to store information should be given its own table.

### 7.2. Select data on multiple tables

```php
$pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'tronghieu', 'tronghieu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
FROM `joke` INNER JOIN `author`
 ON `authorid` = `author`.`id`';

$jokes = $pdo->query($sql);
$title = 'Joke List';

ob_start();

include __DIR__ . '/../templates/jokes.html.php';

$output = ob_get_clean();
```

### 7.3. Many-to-many

The correct way to represent a many-to-many relationship is by using a `lookup table`. This is a table that contains no actual data, but lists pairs of entries that are related.

## 8. Structured PHP Programming

In this chapter, I'll explore some methods of keeping your PHP code manageable and maintainable.

Programmers are lazy, and we don't want to have to make the same change in multiple locations. By placing code in one place, and using it with the `include` statement, it allows us to avoid repetition. If you ever find yourself copying and pasting code, you're almost certainly better off moving that repeated code into its own file and using it in both locations with an `include` statement.

### 8.1. Include Files

`Include files` (also known just as `includes`) also contain snippets of PHP code that you can load into your other PHP scripts instead of having to retype them.

#### 8.1.2. Including HTML content

In PHP, include files most commonly contain either pure PHP code or a mixture of HTML and PHP code. If you like, an include file can contain strictly static HTML. This is most useful for sharing common design elements across your site, such as a copyright notice at the bottom of every page

```php
<footer>
 The contents of this web page are copyright &copy; 2021
</footer>
```

This file is a `template partial` - an include file to be used by PHP templates. I recommend giving it a name ending with `.html.php`, to differentiate from non-template pages.

#### 8.1.3. Including PHP Code

Instead of repeating the code fragment in every file that needs it, write it just once in a separate file - known as the include file. That file can then be included in any other PHP files that need to use it.

We'll create a directory called `DatabaseConnection.php` and place the database connection code inside it:

```php
$pdo = new PDO('mysql:host=hostname;dbname=database;charset=utf8', 'tronghieu', 'tronghieu');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

Now you can put this `DatabaseConnection.php` file to use in your controllers.

The updated `controller` file looks like this

```php
<?php

try {
 include __DIR__ . '/../includes/DatabaseConnection.php';

 $sql = '';
 $jokes = $pdo->query($sql);

 ob_start();

 include __DIR__ . '/../templates/jokes.html.php';

 $output = ob_get_clean();
}
catch (PDOException $e) {

}

include __DIR__ . '/../templates/layout.html.php';
```

When PHP encounters an include statement, it puts the current script on hold and runs the specified PHP script. When it's finished, it returns to the original script and picks up where it left off.

Include files are the simplest way to structure PHP code. Because of their simplicity, they're also the most widely used method. Even very simple web applications can benefit greatly from using include files.

An `include` statement can be thought of as an automated copy-and-paste. When PHP encounters the line `include __DIR__ . '/../includes/DatabaseConnection.php'`; it effectively reads the code from the file and copies/pastes it into the current code at the position of the `include` statement.

#### 8.1.4. Types of includes

- `include`
- `require`
- `include_once`
- `require_once`

The only difference between them is what happens when the specified file is unable to be included (that is, if it doesn't exist, or if the web server doesn't have permission to read it)

- `include`: a warning is displayed and the script continues to run
- `require`: an error is displayed and the script stops

In general, you should use `require` whenever your application simply wouldn't work without the required code being successfully loaded.

I do recommend using `include` whenever possible, however. Even if the `DatabaseConnection.php` file for your site is unable to load, for example, you might still want to let the script for your front page continue to load. None of the content from the database will display, but the user might be able to use the `Contact Us` link at the bottom of the page to let you know about the problem.

`include_once` and `required_once` work just like `include` and `require`, respectively - but if the specified file has already been included at least once for the current page request (using any of the four statements described here), the statement will be ignored. This is handy for include files performing a task that only needs to be done once, like connecting to the dabase.

`include_once` and `required_once` are also useful for loading function libraries, as we'll see in the following section.

### 8.2. Custom Functions and Function Libraries

Avoid using `include` or `require` to load include files that contain functions.

It's standard practive (but not required) to include your function libraries at the top of the script, so that you can quickly see which include files containing functions are used by any particular script.

### 8.3. Variable Scope

On big difference between custom functions and include files is the concept of `variable scope`.

Any variable that exists in the main script will also be available and can be changed in the include file.
To avoid rewrite the same variable, you need to remember the variable names in the script that you're working on, as well as any that exist in the include files your script uses.

Functions protect you from such problems. Variables created inside a function exist only within that function, and disappear when the function has run its course. In addition, variables created outside the function are completely inaccessible inside it. The only variables a function has access to are the ones provided to it as arguments.

Global variables are a very bad idea and lead to problems that are very difficult to track down and fix. You should avoid global variables at any cost.

Exceptions bubble up.

On big difference between custom functions and include files is the concept of `variable scope`.

Any variable that exists in the main script will also be available and can be changed in the include file.
To avoid rewrite the same variable, you need to remember the variable names in the script that you're working on, as well as any that exist in the include files your script uses.

Functions protect you from such problems. Variables created inside a function exist only within that function, and disappear when the function has run its course. In addition, variables created outside the function are completely inaccessible inside it. The only variables a function has access to are the ones provided to it as arguments.

Global variables are a very bad idea and lead to problems that are very difficult to track down and fix. You should avoid global variables at any cost.

Exceptions bubble up.

### 8.4. Breaking Up Your Code Into Reusable Functions

Whenever you spot repeated code, it's usually a good idea to take the repeated code and place it in its own function. This is commonly referred to as the DRY principle.

Being able to pass arrays into functions is a nice trick when you don't always know how many arguments there will be.

### 8.5. Improving functions

Insert function

```php
function insertJoke($pdo, $fields) {
 $query = 'INSERT INTO `joke` (';

 foreach ($fields as $key => $value) {
  $query .= '`' . $key . '`,';
 }

 $query = rtrim(query, ',');

 $query .= ') VALUES (';

 foreach ($fields as $key => $value) {
  $query .= ':' . $key . ',';
 }

 $query = rtrim($query, ',');

 $query .= ')';

 query($pdo, $query);
}
```

### 8.6. Generic Functions

You may have realized that this method is going to be slower, because more quires are sent to the database. This is a common issue with these kinds of generic functions, and it's called the `N+1 problem`. There are several methods for reducing this performance issue, but for smaller sites, where we're dealing with hundreds of thousands of records rather than millions, it's unlikely cause any real problems. The difference will likely be in the region of milliseconds.

## 9. Objects And Classes

### 9.1. Time for class

You can think of a `class` as a collection of functions and data (variables). Each class will contain a set of functions and some data that the functions can access.

As a first step, move all the database functions into a class wrapper

```php
<?php

class DatabseTable
{
 private function query($pdo, $sql, $parameters = [])
 {
  $query = $pdo->prepare($sql);
  $query->execute($parameters);
  return $query;
 }

 public function total($pdo, $table)
 {
  $query = $this->query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
  $row = $query->fetch();
  return $row[0];
 }

 public function findById($pdo, $table, $primaryKey, $value)
 {
  $query = 'SELECT * FROM `' . $table . '` WHERE `' . primaryKey . '` = :value';

  $parameters = [
   'value' => $value
  ];

  $query = $this->query($pdo, $query, $parameters);

  return $query->fetch();
 }

 private function insert($pdo, $table, $fields)
 {
  $query = 'INSERT INTO `' . $table . '` (';

  foreach ($fields as $key => $value) {
   $query .= '`' . $key . '`,';
  }

  $query = rtrim($query, ',');

  $query .= ') VALUES (';

  foreach ($fields as $key => $value) {
   $query .= ':' . $key . ',';
  }

  $query = rtrim($query, ',');

  $query .= ')';

  $fields = $this->processDates($fields);
  $this->query($pdo, $query, $fields);
 }

 private function update($pdo, $table, $primaryKey, $fields)
 {

 }

 public function delete($pdo, $table, $primaryKey, $id)
 {

 }

 public function findAll($pdo, $table)
 {

 }

 private function processDates($fields)
 {
  foreach ($fields as $key => $value) {
   if ($value instanceof DateTime) {
    $fields[$key] = $value->format('Y-m-d');
   }
  }

  return $fields;
 }

 public function save($pdo, $table, $primaryKey, record)
 {

 }
}
```

Like templates and include files, it's good practive to store classes outside the `public` directory. Create a new directory called `classes` inside your `Project` directory and save the code above as `DatabaseTable.php`

#### 9.1.1. Naming Your Class Files

It's good practice to name your class files exactly the same as your classes. The class `DatabaseTable` would be placed in `DatabaseTable.php`, a class called `User` would be stored in `User.php` and so on. Althought it doesn't matter at the moment, later on I'll introduce something called an `autoloader`, and it will be difficult to use without this convention.

### 9.2. Constructors

As the author of a class, you get to tell anyone who uses it how it works. (If you want to get technical, this is called the `Application Programming Interface` or `API`). You can make sure that ny required variables are set before any functions are run.

### 9.3. Magic Methods

That's two underscores in front of the word `construct`. If you use just one, it won't work!

In PHP, any method prefixed by two undersocres is a `magic method`. These are generally called automatically in different cases. As the language evolves, more of these magic methods may be added, so it's a good idea to avoid giving your own methods names beginning with two underscores.

### 9.4. Type Hinting

PHP is loosely typed, meaning that a variable can be any type - such as a string, a number, an array, or an object.

`Type inting` allows you to specify the type of an argument. The type can be a class name, or one of the basic types, such as stirng, array or integer.

Type hinting for basic types (numbers, strings, arrays - anything that isn't an object) was only introduced in PHP 7. It's possible your web host is still on PHP 5, so be careful when using this feature!

to provide a type hint for an argument, prefix the variable name with the type that the variable should be

```php
public function __construct(PDO $pdo, string $table, string $primaryKey)
{
}
```

This is known as `defensive programming`, and it's a very useful way of preventing bugs. By stopping variables being set to the wrong type, you can rule out the possibility of many potential bugs.

### 9.5. Using the DatabaseTable Class

```php
<?php
class DatabaseTable
{
 private $pdo;
 private $table;
 private $primaryKey;

 public function __construct(PDO $pdo, string $table, string $primaryKey)
 {
  $this->pdo = $pdo;
  $this->table = $table;
  $this->primaryKey = $primaryKey;
 }

 private function query($sql, $parameters = [])
 {
  $query = $this->pdo->prepare($sql);
  $query->execute($parameters);
  return $query;
 }

 public function total()
 {
  $query = $this->query('SELECT COUNT(*) FROM
  `' . $this->table . '`');
  $row = $query->fetch();
  return $row[0];
 }

 public function findById($value)
 {
  $query = 'SELECT * FROM `' . $this->table . '` WHERE `' .
  $this->primaryKey . '` = :value';
  $parameters = [
  'value' => $value
  ];
  $query = $this->query($query, $parameters);
  return $query->fetch();
 }

 private function insert($fields)
 {
  $query = 'INSERT INTO `' . $this->table . '` (';
  foreach ($fields as $key => $value) {
   $query .= '`' . $key . '`,';
  }

  $query = rtrim($query, ',');
  $query .= ') VALUES (';

  foreach ($fields as $key => $value) {
   $query .= ':' . $key . ',';
  }

  $query = rtrim($query, ',');
  $query .= ')';
  $fields = $this->processDates($fields);
  $this->query($query, $fields);
 }

 private function update($fields)
 {
  $query = ' UPDATE `' . $this->table .'` SET ';

  foreach ($fields as $key => $value) {
   $query .= '`' . $key . '` = :' . $key . ',';
  }

  $query = rtrim($query, ',');
  $query .= ' WHERE `' . $this->primaryKey . '` =
  :primaryKey';
  // Set the :primaryKey variable

  $fields['primaryKey'] = $fields['id'];
  $fields = $this->processDates($fields);
  $this->query($query, $fields);
 }

 public function delete($id)
 {
  $parameters = [':id' => $id];
  $this->query('DELETE FROM `' . $this->table . '` WHERE
  `' . $this->primaryKey . '` = :id', $parameters);
 }

 public function findAll()
 {
  $result = $this->query('SELECT * FROM ' .
  $this->table);
  return $result->fetchAll();
 }

 private function processDates($fields)
 {
  foreach ($fields as $key => $value) {
   if ($value instanceof DateTime) {
    $fields[$key] = $value->format('Y-m-d');
   }
  }
 return $fields;
 }

 public function save($record)
 {
  try {
   if ($record[$this->primaryKey] == '') {
    $record[$this->primaryKey] = null;
   }
   $this->insert($record);
  }
  catch (PDOException $e) {
   $this->update($record);
  }
 }
}

```

### 9.6. Omitting the Closing Tag from your files

Whenever you create a PHP file, you need to remember to put the PHP code inside PHP tags. However, the closing tag is optional, and it's actually better to omit it if the file only contains PHP code.

This is because, if there are any whitespace characters (blank lines, tabs or spaces) at the end of the file after the closing PHP tag ?>, they'll be sent to the browser, which isn't what you want to happen. Instead, it's better to prevent this from happening by omitting the ?> tag entirely. By leaving out the closing PHP tag, the whitepsace will be interpreted on the server by PHP, and ignored, rather than being sent as part of the HTML code to the browser.

### 9.7. Updating the Controller to Use the Class

Rather than having different files for each controller, it's possible to write a single controller that handles each `action` as a method. That way, we can have one file that handles all the parts that are common to each page, and methods in a class that handle the individual parts.

```php
<?php

try {

 // Include some required files
 include __DIR__ . '/../includes/DatabaseConnection.php';
 include __DIR__ . '/../classes/DatabaseTable.php';

 // Create one or more database table instances
 $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

 // Do something that's unique to this particular page and create the $title and $output variables
}
catch (PDOException $e) {

 // Handle errors if they occur
 $title = 'An error has occurred';

 $output = 'Database error: ' . $e->getMessage() . 'in ' . $e->getFile() . ': ' . $e->getLine();
}

// Load the template file
include __DIR__ . '/../templates/layout.html.php';
```

Using this approach, if you wanted to rename the `DatabaseConnection.php` file, you'd have to go through each controller to use the new name. Similarly, if you wanted to change the layout file, you'd need to edit each controller separately.

All that really changes for each controller is the middle section that creates the `$output` and `$title` variables for the layout to use.

Rather than having different files for each controller, it's possible to write a single controller that handles each `action` as a method. That way, we can have one file that handles all the parts that are common to each page, and methods in a class that handle the individual parts.

## 10. Creating an Extensible Framework

One controller in `index.php`

```php
<?php

function loadTemplate($templateFileName, $variables = [])
{
 extract($variables);
 ob_start();
 include __DIR__ . '/../templates/' . $templateFileName;
 return ob_get_clean();
}

try {
 include __DIR__ . '/../includes/DatabaseConnection.php';
 include __DIR__ . '/../classes/DatabaseTable.php';
 include __DIR__ . '/../controllers/JokeController.php';

 $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
 $authorsTable = new DatabaseTable($pdo, 'author', 'id');
 $jokeController = new JokeController($jokesTable, $authorsTable);
 $action = $_GET['action'] ?? 'home';
 $page = $jokeController->$action();
 $title = $page['title'];

 if (isset($page['variables'])) {
  $output = loadTemplate($page['template'],
  $page['variables']);
 }
 else {
  $output = loadTemplate($page['template']);
 }
}
catch (PDOException $e) {
 $title = 'An error has occurred';
 $output = 'Database error: ' . $e->getMessage() . ' in '
 354 PHP & MySQL: Novice to Ninja, 6th Edition
 . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
```

## 11. Project the beginner

Project Structure

- `inclues`: for utilility functions
- `public`: for serving
- `templates`: for `.html.php` templates

Run project

```sh
php -S localhost:8000 -t public
```

### 11.1. Connect to Database with PDO

In `includes/DatabaseConnection.php`

```php
<?php
$host = 'localhost';
$dbname = 'jokes';
$charset = 'utf8';
$db_username = 'root';
$db_password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $db_username, $db_password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

### 11.2. Utility functions for making Database query

Vanilla functions for making query

```php
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
```

Extract the duplicated code to the `query` function

```php
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
```

Making use of the `query` function

```php
function getTotalJokes($pdo)
{
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

function getJoke($pdo, $id)
{
    $parameters = [
        ':id' => $id
    ];
    $sql = 'SELECT * FROM `joke` WHERE `id` = :id';

    $query = query($pdo, $sql, $parameters);
    return $query->fetch();
}

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

function deleteJoke($pdo, $id)
{
    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
    $parameters = [
        ':id' => $id
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
```

### 11.3. Controller

Make use of these utility function in `controller`

In `public/jokes.php`

```php
<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
            FROM `joke` INNER JOIN `author`
                ON `authorid` = `author`.`id`';

    $jokes = $pdo->query($sql);

    $title = 'Joke List';

    $totalJokes = getTotalJokes($pdo);

    ob_start();

    include __DIR__ . '/../templates/jokes.html.php';

    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
```

### 11.4. Base template

In `templates/layout.html.php`

```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jokes.css">
    <title><?= $title ?></title>
</head>

<body>
    <nav>
        <header>
            <h1>Internet Joke Database</h1>
        </header>
        <ul>
            <li> <a href="index.php">Home</a> </li>
            <li> <a href="jokes.php">Jokes List</a> </li>
            <li> <a href="addjoke.php">Add a new Joke</a> </li>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; IJDB 2017
    </footer>
</body>

</html>
```

### 11.5. Improving the utility functions

In the last chapter, I showed you how to break the code up into easily reusable functions.
This has several advantages:

- the code where the function is called is easier to read
- you can re-use the same function from anywhere

In this chapter, I'll take this a step further and show you how to make a function
that could be used for any database table, and then show you how object oriented
programming can simplify this task even further

#### 11.5.1. Improving the `update` function

To run the `update` function, we need

- `joke ID`
- `joke text`
- `author ID`

We might want to update the specific fields, not all, so we could improve this like so:

```php
updateJokes($pdo, [
  'id' => 1,
  'joketext' => '...'
])
```

or

```php
updateJokes($pdo, [
  'id' => 1,
  'authorId' => 7
])
```

The improved version

```php
function updateJoke($pdo, $fieldsToBeUpdated)
{
    $sql = 'UPDATE `joke` SET ';

    foreach ($fieldsToBeUpdated as $field_name => $updated_value) {
        $sql .= "`$field_name` = :$field_name, ";
    }
    $sql = rtrim($sql, ', ');

    $sql .= ' WHERE `id` = :primaryKey';

    $fieldsToBeUpdated['primaryKey'] = $fieldsToBeUpdated['id'];

    query($pdo, $sql, $fieldsToBeUpdated);
}
```

After the `foreach` loop, we have

- `$sql`: `UPDATE \`joke\` SET \`id\` = :id, \`joketext\` = :joketext WHERE \`id\` = :primaryKey`;

We must manually set the `primaryKey` because we cannot prepare the query with the same `variable`

> When you write a funciton, it's usually easier to write some examples of how you
> think it should be called before writing the code inside the function itself. This
> gives you a target to work towards, and some code you can run to see whether it's
> working correctly or not.

#### 11.5.1. Improving the `insert` function

Dates and times in MySQL are always stored using the format `YYYY-MM-DD HH:MM:SS`.

Using `insertJoke` function

```php
$date = new DateTime();

insertJoke($pdo, [
  'authorId' => 4,
  'joketext' => '...',
  'jokedate' => $date->format('Y-m-d H:i:s')
])
```

But, we can improve this function further

```php
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

    foreach ($fields as $key => $value) {
        if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d');
        }
    }

    query($pdo, $sql, $fields);
}
```

Now we can use this function

```php
insertJoke($pdo, [
  'authorId' => 4,
  'joketext' => '...',
  'jokedate' => new DateTime()
])
```

We can extract the logic of formatting date to it own function

```php
function processDate($fields)
{
    foreach ($fields as $key => $value) {
        if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d H:i:s');
        }
    }

    return $fields;
}
```

### 11.6. Displaying `jokedate`

Edit `allJokes` function to get the date

```php
function allJokes($pdo)
{
    $sql = 'SELECT `joke`.`id`, `joketext`, `jokedate`, `name`, `email`
            FROM `joke`
            INNER JOIN `author`
                ON `author`.`id` = `authorid`';

    $query = query($pdo, $sql);
    return $query->fetchAll();
}
```

Edit `jokes.html.php` template to display the `jokedate`

```php
<?php
  $date = new DateTime($joke['jokedate']);
  echo $date->format('jS F Y');
?>
```

### 11.7. Making your own tools

By improving the tools to be more precise and easier to use, the blackmsmith can make
product faster, create higher-quality items, produce a wider variety of products, make
other specialist tools, and let lesser-skilled workers such as apprentices products
beyond their skill level.

It does take time to create a tool, but once the tool is created, the blacksmith can use it
to make thousands of products. Over the long term, the time spent making the tool
quickly pays off.

A programming language is just a tool, and you can use it to make your own tools. Every time you write a function, you're creating a new tool. You can either make tools that have many uses, which you can use over and over again, or tolls with limited use that only be used for one very specific job.

### 11.8. Generic Functions

Before we make any large-scale changes, let's expand the wesite and add a function for retrieving all the authors from the database in the same manner we used for the `allJokes` function

```php
function allAuthors($pdo) {
  $authors = query($pdo, 'SELECT * FROM `author`');
  return $authors->fetchAll();
}
```

The `deleteAuthor` and `insertAuthor` functions are almost identical to the corresponding `joke` functions, `deleteJoke` and `insertJoke`. It would be better to create `generic` functions that could be used with any databse table.

That way, we can write the function `once` and use it for any databse table. If we continued down the route of having five different functions for each database table, we'd very quickly end up with a lot of very similar code.

The differences between the functions are just the names of the tables. By replacing the table name with a variable, the function can be used to retrieve all the records from any database table.

```php
function findAll($pdo, $table) {
  $result = query($pdo, "SELECT * FROM `$table`");
  return $result->fetchAll();
}
```

Once the function has been written, this new tool can be used to retrieve all the records from any database table

```php
$allJokes = findAll($pdo, 'joke');
$allAuthors = findAll($pdo, 'author');
```

The same thing can be done with delete

```php
function delete($pdo, $table, $id) {
  $parameters = [
    ':id' => $id
  ];

  query($pdo, "DELETE FROM `$table` WHERE id = :id", $parameters);
}
```

This function works, but it's still a little inflexible; it assumes that the primary key field in the table is called `id`.

In order for our function to work with any database table structure, the primary key can also be replaced with a variable

```php
function delete($pdo, $table, $primaryKey, $id) {
  $parameters = [
    ':id' => $id
  ];

  $sql = "DELETE FROM `$table` WHERE `$primaryKey` = :id";
  query($pdo, $sql, $parameters);
}
```

We can use this approach to refactor all other function

```php
function findAll($pdo, $table) {}
function findById($pdo, $table, $primaryKey, $value) {}
function insert($pdo, $table, $fields) {}
function update($pdo, $table, $primaryKey, $fields) {}
function delete($pdo, $table, $primaryKey, $id) {}
function query($pdo, $sql, $parameters = []) {}
function processDate($fields) {}
function total($pdo, $table) {}
```

Using these new functions

```php
insert($pdo, 'joke', [
    'joketext' => $_POST['joketext'],
    'jokedate' => new DateTime(),
    'authorId' => 1
]);

update($pdo, 'joke', 'id', [
    'id' => $_POST['jokeid'],
    'joketext' => $_POST['joketext'],
    'jokedate' => new DateTime()
]);

$joke = findById($pdo, 'joke', 'id', $_GET['jokeid']);

delete($pdo, 'joke', 'id', $_POST['id']);
```

The next part is the list of jokes. Currently, it uses the `allJokes` function, which also retrieves information about the author of each joke. There's no simple way to write a generic function that retrieves information from two tables.

Instead, we can use the generic `findAll` and `findById` functions to achieve this

```php
$result = findAll($pdo, 'joke');

$jokes = [];
foreach ($result as $joke) {
  $author = findById($pdo, 'author', 'id', $joke['authorId']);

  $jokes[] = [
    'id' => $joke['id'],
    'joketext' => $joke['joketext'],
    'name' => $author['name'],
    'email' => $author['email']
  ]
}
```

This works by fetching the list of jokes (without the author information), then looping over each joke and finding the corresponding author by their `id`, then writing the complete joke with the information from both tables into the `$jokes` array.

This is essentially what an `INNER JOIN` does in `MySQL`

You may have realized that this method is going to be slower, because more queries are sent to the database. This is a common issue with these kind of generic functions, and it's called the `N+1 problem`. There are several methods for reducing this performance issue, but for smaller sites, where we're dealing with hundreds or thousands of records rather than miliions, it's unlikely to cause any real problems.

### 11.9. Repeated Code Is the Enemy

By creating the generic functions `insert, update, delete, findAll and findById`, it's now very quick and easy for us to create a website that deals with any kind of database operation.

But there's still room for improvement. The files `addjoke.php` and `editjoke.php` do very similar jobs: they display a form, and when the form is submitted, they send the submitted data off to the database.

If you ever find yourself in a situation like this, where you havev to make similar changes in multiple files, it's a good sign that you should combine both sets of code into one. Of course, the new code needs to handle both cases.

There are a couple of differences between `addjoke.php` and `editjoke.php`:

- `addjoke.php` issues an `INSERT` query, while `editjoke.php` issues an `UPDATE` query.

- `editjoke.php`'s template file has a hidden input that stores the `ID` of the joke being edited.

But everything else is almost the same.

Visiting `editjoke.php?id=12` will load the joke with the `ID` 12 from the database and allow us to edit it. When the form is submitted, it will issue the relevent `UPDATE` query, while just visiting `editjoke.php` - without an ID specified - will display an empty form and, when submitted, perform an `INSERT` query.

#### 11.9.1. Creating a Page for Adding and Editting

Edit `editjoke.php` controller to get `joke` if only the `$_GET['jokeid']` is specified.

```php
try {
    if (isset($_POST['joketext'])) {
        update($pdo, 'joke', 'id', [
            'id' => $_POST['jokeid'],
            'joketext' => $_POST['joketext'],
            'jokedate' => new DateTime()
        ]);

        header('Location: jokes.php');
        exit();
    } else {
        if (isset($_GET['jokeid'])) {
            $joke = findById($pdo, 'joke', 'id', $_GET['jokeid']);
        }

        $title = 'Edit Joke';

        ob_start();

        include __DIR__ . '/../templates/editjoke.html.php';

        $output = ob_get_clean();
    }
} catch (PDOException $e) {
```

In the `editjoke.html.php`, we edit so it only tries to print the existing data into the textarea and hidden input if the joke variable is set

```php
<form action="" method="POST">
    <input type="hidden" name="jokeid" value="<?= $joke['id'] ?? '' ?>">
    <label for="joketext">Type your joke here: </label>
    <textarea name="joketext" id="joketext" cols="40" rows="3"><?= $joke['joketext'] ?? '' ?></textarea>
    <input type="submit" value="Update">
</form>
```

To complete this page, we need to change what happens when the form is submitted. Either an `update` or `insert` query will need to be run.

```php
<?php

if (isset($_POST['id']) && $_POST['id'] != '') {
  update(...);
}
else {
  insert(...);
}
```

Although this would work, once again there's an oopportunity to make this more generic. This logic for `if the ID is set, update, otherwise insert` is going to be the same for any form.

Instead, we can try to insert a record, and if it's unsuccessful, update instead using a `trycatch` statement.

```php
try {
  insert();
}
catch(PDOException $e) {
  update();
}
```

Now an insert will be sent to the database, but it may cause an error - "Duplicate key" - when a record with the supplied ID is already set. If an error does occur, an `UPDATE` query is issued instead to update the existing record.

```php
function save($pdo, $table, $primaryKey, $record)
{
  try {
    if ($record[$primaryKey] == '') {
      $record[$primaryKey] = null;
    }
    insert($pdo, $table, $primaryKey, $record);
  }
  catch (PDOExcpetion $e) {
    update($pdo, $table, $primaryKey, $record);
  }
}
```

This will work for any record in any table. If there's an error when trying to insert, it will issue the corresponding update query instead.

By replace the empty string in `ID` with `NULL`, it will trigger `MySQL`'s auto_increment feature and generate a new ID.

Using this new function in `editjoke.php`

```php
if (isset($_POST['joketext'])) {
    save($pdo, 'joke', 'id', [
        'id' => $_POST['jokeid'],
        'joketext' => $_POST['joketext'],
        'jokedate' => new DateTime(),
        'authorid' => 1
    ]);

    header('Location: jokes.php');
    exit();
}
```

Finally, you can delete the controller `addjoke.php` and the template `addjoke.html.php`, as they're no longer needed. Both add and edit are now handled by `editjoke.php`.

```html
<li><a href="index.php">Home</a></li>
<li><a href="jokes.php">Jokes List</a></li>
<li><a href="editjoke.php">Add a new Joke</a></li>
```

#### 11.9.2. Further Polishing

There's a little repettion here

```php
[
  'id' => $_POST['jokeid'],
  'authorid' => 1,
  'jokedate' => new DateTime(),
  'joketext' => $_POST['joketext']
]
```

Each field in the `$_POST` array is mapped to a key in the `$joke` array with the same name.

Solution #1

```php
$joke = $_POST;

unset($joke['submit']);

$joke['authorid'] = 1;
$joke['jokedate'] = new DateTime();

save($pdo, 'joke', 'id', $joke);
```

Although this work, the problem with this approach is that you'd have to remove
any form elements you don't want inserted into the database.

Solution #2

```html
<form action="" method="POST">
  <input type="hidden" name="joke[id]" value="<?= $joke['id'] ?? '' ?>" />
  <label for="joketext">Type your joke here: </label>
  <textarea name="joke[joketext]" id="joketext" cols="40" rows="3">
<?= $joke['joketext'] ?? '' ?></textarea
  >
  <input
    type="submit"
    value="<?= isset($joke) && $joke['id'] ? 'Update' : 'Create' ?>"
  />
</form>
```

If submit the form, the $_POST array will store two values: `submit` and `joke`.
`$\_POST['joke']`is itself an array from which you can read the`id`value using `$\_POST['joke']['id']`

In the controller

```php
if (isset($_POST['joke'])) {
  $joke = $_POST['joke'];
  $joke['jokedate'] = new DateTime();
  $joke['authorid'] = 1;

  save($pdo, 'joke', 'id', $joke);
}
```

If we wanted add a field to the `joke` table and alter the form now, it would only
require two changes: adding the field to the database and then editing the HTML
form. A single update to `editjoke.html.php` will let us add a form field that
works for both the `edit` and `add` pages.

### 11.10. Objects and Classes

Each time one of the functions is called, it must be passed the $pdo instance.
With up to four arguments for each function, it can be difficult to remember the
order they need to be provided in.

A good method for avoiding this problem is putting the functions inside a class.

You can think of a class as a collection of functions and data (variables). Each
class will contain a set of functions and some data that the functions can access.
Our DatabaseTable class needs to contain all the functions we created for
interacting with the database, along with any functions that those functions need
to call.

As a first step, move all the database functions into a class wrapper:

```php
<?php

class DatabaseTable
{
  private function query($pdo, $sql, $parameters = []) {}

  public function total($pdo, $table) {}
  public function findById($pdo, $table, $primaryKey, $value) {}

  private function insert($pdo, $table, $fields) {}
  private function update($pdo, $table, $primaryKey, $value) {}

  public function save($pdo, $table, $primaryKey, $value) {}

  public function delete($pdo, $table, $primaryKey, $value) {}
  public function findAll($pdo, $table) {}

  private function processDate($fields) {}
}
```

Like templates and include files, it's good practice to store classes outside the
`public` directory. Create a new directory called `classes` inside your project
directory and save the code above as `DatabaseTable.php`

Add some variables

```php
class DatabaseTable
{
  public $pdo;
  public $table;
  public $primaryKey;
}
```

We can now rewrite those function to `OOP`

```php
class DatabaseTable
{
  public $pdo;
  public $table;
  public $primaryKey;

  private function query($sql, $parameters = [])
  {
      $query = $this->pdo->prepare($sql);

      foreach ($parameters as $name => $value) {
          $query->bindValue($name, $value);
      }

      $query->execute();
      // $query->execute($parameters);
      return $query;
  }

  public function findAll()
  {
      $sql = "SELECT * FROM `{$this->table}`";
      $result = $this->query($sql);

      return $result->fetchAll();
  }
}
```

The variables in the class are accessed the same way as the functions using the
`$this` variable. Now, when the `findAll()` function is called, it doesn’t need any
arguments, because the `$pdo` connection and the name of the table are read from
the class variables:

```php
$jokeTable = new DatabaseTable();
$jokeTable->pdo = $pdo;
$jokeTable->table = 'joke';

$jokes = $jokeTable->findAll();
```

Now, to interact with the database, the common variables only need to be set once:

```php
$jokeTable = new DatabaseTable();
$jokeTable->pdo = $pdo;
$jokeTable->table = 'joke';
$jokeTable->primaryKey = 'id';
```

And then, the methods can be used without repeating all the arguments

```php
$joke123 = $jokeTable->findById(123);

$jokes = $jokeTable->findAll();

$jokeTable->delete(123);

$jokeTable->save([
  'authorid' => 1,
  'joketext' => '...',
  'jokedate' => new DateTime()
]);
```

Add class's `constructor` so that the user is required to provide all neccessary argument before using
the class

```php
class DatabaseTable 
{
  public function __construct($pdo, $table, $primaryKey)
  {
    $this->pdo = $pdo;
    $this->table = $table;
    $this->primaryKey = $primaryKey;
  }
}
```

This kind of check ensures the code is robust. It also helps anyone who uses the
class, because they’ll see an error as soon as they do something wrong.

#### 11.10.1. Type Hinting

If we’re trying to make the class foolproof, there’s still a problem. What happens
if the person using your `DatabaseTable` class gets the order of the arguments
wrong? Consider these two examples:

```php
$jokesTable = new DatabaseTable('jokes', $pdo, 'id');
$jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
```

To help them out, it’s better to ensure that the arguments are the correct `type`. PHP
is `loosely typed`, meaning that a variable can be any type—such as a string, a
number, an array, or an object. 

`Type hinting` allows you to specify the type of an argument. The type can be a
class name, or one of the basic types, such as string, array or integer. This feature 
was introduced in `PHP 7`

```php
public function __construct(PDO $pdo, string $table, string $primaryKey)
{

}
```

This is known as **defensive programming**, and it’s a very useful way of
preventing bugs. By stopping variables being set to the wrong type, you can rule
out the possibility of many potential bugs

Then, we change the `visibility` of properties to `private` to prevent any access from
outside of the class

```php
class DatabaseTable
{
  private PDO $pdo;
  private string $table;
  private string $primaryKey;

  public function __construct(PDO $pdo, string $table, string $primaryKey)
  {
    $this->pdo = $pdo;
    $this->table = $table;
    $this->primaryKey = $primaryKey;
  }
}
```

By combining type hints, constructors and private properties, several conditions 
have been imposed on the class

- It's impossible to create an instance of the `DatabaseTable` class without passing it a `$pdo` instance
- The first argument ust be a valid `PDO` instance
- There's no way to change the `$pdo` variable after it's been set.

This type of defensive programming can take a little more thinking about—for
example, what needs to be public and what needs to be private?—but in all but
the most simple projects, it’s worth it! By eliminating the conditions for a bug to
exist, you can save yourself a lot of bug-tracking time later on.

#### 11.10.2. Using the `DatabaseTable` class

In `jokes.php` controller

```php
<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $jokes = [];

    $result = $jokesTable->findAll();

    foreach ($result as $joke) {
        if (isset($joke['authorid'])) {
            $author = $authorsTable->findById($joke['authorid']);

            $jokes[] = [];
        }
    }

} catch (PDOException $e) {}

include __DIR__ . '/../templates/layout.html.php';
```

In `deletejoke.php` controller

```php
<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $jokesTable->delete($_POST['id']);

    header('Location: jokes.php');
} catch (PDOException $e) {}
```

In `editjoke.php` controller

```php
<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

try {
    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');

    if (isset($_POST['joke'])) {
        $joke = $_POST['joke'];
        $jokesTable->save($joke);

    } else {
        if (isset($_GET['jokeid'])) {
            $joke = $jokesTable->findById($_GET['jokeid']);
        }
    }
} catch (PDOException $e) {}
```

#### 11.10.3. DRY

Each of the controllers follow this basic pattern

```php
<?php 

try {
  // Include some required files

  // Create one or more database table instances

  // Do something that's unique to this particular page and create 
  // the $title and $output variable
}
catch (PDOException $e) {
  // Handle error
}

// Load the template file

```

Rather than having different files for each `controller`, it’s possible to write a single
controller that handles each `action` as a `method`. That way, we can have one file
that handles all the parts that are common to each page, and methods in a class
that handle the individual parts.

### 11.11. Creating a controller class

The first thing we could do is move the code for each `controller` into a method in
a class. Firstly create a class called `JokeController`.

As this is a special type of class, we won’t store it in the `classes` directory.
Instead, create a new directory called `controllers` and save this as
`JokeController`:

```php
class JokeController {

}
```

Before moving the relevant code into methods, let’s consider what variables this
class needs. Any variables required by the various actions will need to be class
variables so that they can be defined once and used in any of the methods.

```php
class JokeController {
  private $authorsTable;
  private $jokesTable;

  public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesTable) {
    $this->authorsTable = $authorsTable;
    $this->jokesTable = $jokesTable;
  }
}
```

Move `action` into the corresponding `method`

```php
class JokeController {
  private $authorsTable;
  private $jokesTable;

  public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesTable) {
    $this->authorsTable = $authorsTable;
    $this->jokesTable = $jokesTable;
  }

  public function home()
  {
    // code from index.php

    // for our template layout
    return [ 'title' => '', 'output' => '' ];
  }

  public function list()
  {
    // code from jokes.php

    return [ 'title' => '', 'output' => '' ];
  }

  public function edit()
  {
    // code from editjoke.php

    return [ 'title' => '', 'output' => '' ];
  }

  public function delete()
  {
    // code from deletejoke.php

    return [ 'title' => '', 'output' => '' ];
  }
}
```

Until now, we've had each different page using its own file: `index.php`,
`jokes.php`, `editjoke.php` and `deletejoke.php`

### 11.12. Single Entry Point

With the `controller` complete, we can now write a **single file** to handle **any page**.
Importantly, this single file can contain all the code that was previously repeated
in each of the files. As a starting point, here’s a very crude way of using the new
class:

```php
<?php 

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../controllers/JokeController.php';

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  $jokeController = new JokeController($jokesTable, $authorsTable);

  if (isset($_GET['edit'])) {
    $page = $jokeController->edit();
  }
  else if (isset($_GET['delete'])) {
    $page = $jokeController->delete();
  }
  else if (isset($_GET['list'])) {
    $page = $jokeController->list();
  }
  else {
    $page = $jokeController->home();
  }

  list($title, $output) = $page;
}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
```

To access our website

- `index page`: `localhost:8000/index.php`
- `list page`: `localhost:8000/index.php?list`
- `edit page`: `localhost:8000/index.php?edit&jokeid=10`
- `create page`: `localhost:8000/index.php?edit`

This is called a **single entry point** or **front controller**

I already called the new `index.php` crude, because it's not very efficient. Every time you want to add a page to the website, you'll need to do two things:

- add the method in `JokeController`
- add the relevant `else if` block in `index.php`

You've probably already noticed that the `GET` variable name maps exactly to the name of the function 

- when `$_GET['edit']` is set, the `edit` function is called
- when `$_GET['list']` is set, the `list` function is called

This seems a bit redundant. PHP allows some cool stuff. For example, you can do this

```php
$function = 'edit';
$jokeController->$function();
```

$this will evaluate `$function` to `edit` and actually call `$jokeController->edit()`. We can utilize this feature to read the `GET` variable and call the method with that name.

Commonly, a function in a controller is called an **action**. We could use the `GET` vaiable `action` to call the relevant function on the controller.

- `index.php?action=edit` would call the edit function
- `index.php?action=delete` would call delete, and so on

The code for this is remarkably simple

```php
<?php

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../controllers/JokeController.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    $jokeController = new JokeController($authorsTable, $jokesTable);

    $action = $_GET['action'] ?? 'home';

    $page = $jokeController->$action();

    $title = $page['title'];
    $output = $page['output'];
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
```

The advantage of this approach is that, to add a **new page** to the website, all we need to do is **add a method** to the `JokeController` class and link to `index.php`, supplying the relevant `action` variable.

Now that the **URL structure** of the website has changed completely, we’ll need to go through each page and update any links, form actions, or redirects.

In `layout.html.php`

```html
<li> <a href="index.php">Home</a> </li>
<li> <a href="jokes.php?action=list">Jokes List</a> </li>
<li> <a href="editjoke.php?action=edit">Add a new Joke</a> </li>
```

In `jokesController.php`

```php
header('Location: index.php?action=list');
```

In `jokes.html.php`

### 11.13. keeping it DRY

You’re nearly done! A large proportion of your PHP code is now neatly organized into `methods` inside classes, and you can quickly add new pages to the website by simply creating a new method inside `JokeController`. Before we continue, let’s quickly remove some of the remaining repeated code.

The duplicated code

In `edit method`

```php
ob_start();
include __DIR__ . '/../templates/editjoke.html.php';
$output = ob_get_clean();
return ['output' => $output, 'title' => $title];
```

In `home method`

```php
ob_start();
include __DIR__ . '/../templates/home.html.php';
$output = ob_get_clean();
return ['output' => $output, 'title' => $title];
```

In `list method`

```php
ob_start();
include __DIR__ . '/../templates/jokes.html.php';
$output = ob_get_clean();
return ['output' => $output, 'title' => $title];
```

Rather than having each action include this block of code, it would be simpler to have the action provide a file name - such as `home.html.php` - and then have it loaded from within `index.php`

To make that change, firstly open up `index.php` and change it to this

```php
<?php
try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../controllers/JokeController.php';

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');
  $jokeController = new JokeController($jokesTable, $authorsTable);

  $action = $_GET['action'] ?? 'home';

  $page = $jokeController->$action();

  $title = $page['title'];

  ob_start();

  include __DIR__ . '/../templates/' . $page['template'];

  $output = ob_get_clean();
}
catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in '. $e->getFile() . ':' . $e->getLine(); 
}

include __DIR__ . '/../templates/layout.html.php';
```

The `controller action` will no longer provide the `$output` variale, but instead just a filename for `index.php` to include

```php
public function home() {
  $title = '..';

  return [
    'template' => 'home.html.php',
    'title' = $title
  ];
}

public function list() {
  return [
    'template' => 'jokes.html.php',
    'title' => '...'
  ];
}

public function edit() {
  return [
    'template' => 'editjoke.html.php',
    'title' => $title
  ];
}
```

Each action now provides the name of a `template` that gets loaded in `index.php`. We’ve saved ourselves from needing to repeat the `output buffer` and `include` lines.

Thus, we need a way to get the `$totalJokes` and `$jokes` variables into `index.php`

On first glance, you might think to do it in the return statement, the same way that we did with the title, output, and later template variables:

```php
public function list() {
  return [
    'template' => 'jokes.html.php',
    'title' => $title, 
    'totalJokes' => $totalJokes,
    'jokes' => $jokes
  ];
}
```

And the recreate the variables in `index.php`

```php
$action = $_GET['action'] ?? 'home';

$page = $jokeController->$action();

$title = $page['title'];
$totalJokes = $page['totalJokes'];
$jokes = $page['jokes'];

ob_start();

include __DIR__ . '/../templates/' . $page['template'];

$output = ob_get_clean();
```

If you try this, the jokes list page will work as expected. However, as soon as you navigate to another page, you’ll get errors.

A very messy solution would be to have each method in the `controller return every single variable that’s needed`, but leave the array values `blank` when they’re not needed.

This is obviously not a viable solution. Each time we add a `template` that requires a variable with a new name, we’d need to amend every single controller method to provide an empty string for that variable and then amend `index.php` to set it!

### 11.14. Template Variables

Instead, we'll solve the problem in the same way we did for the `return` statement. Each method will supply an array of variables

The `list` return statement will now look like this

```php
public function list() {
  return [
    'template' => 'jokes.html.php',
    'title' => $title,
    'variables' => [
      'totalJokes' => $totalJokes,
      'jokes' => $jokes
    ]
  ];
}
```

Although the code is slightly more difficult to read, the advantage of this approach is that each `controller method` can provide a different array in the variables key. The `editJoke` page can use this return statement:

```php
public function edit() {
  return [
    'template' => 'editjoke.html.php',
    'title' => $title,
    'variables' => [
      'joke' => $joke ?? null
    ]
  ];
}

```

We can now use the `variables` array in `index.php`. The simplest way to achieve this would be to create a variable called `$variables` inside `index.php`, in the same way we did with `$title`:

```php
$title = $page['title'];
$variables = $page['variables'];

ob_start();

include __DIR__ . '/../templates/' . $page['template'];

$output = ob_get_clean();
```

Now, we can get access to the return `variable` inside our template.

In `jokes.html.php`

```php
<p>
  <?= $variables['totalJokes'] ?> jokes have been submitted to the Internet Joke Database.
</p>
```

This solution works, but it means opening up and changing every template file. A simpler alternavitve is to create the variables that are required.

Luckily, PHP provides a method of doing exactly that. The `extract` function can be used to create variables from an array:

```php
$array = ['hello' => 'world'];
extract($array);
echo $hello; // prints 'world'
```

A `variable` is created for `any key` in the `array`, and `its value` is set to the `corresponding value`. We can use extract to create the relevant template variables in `index.php`:

```php
$action = $_GET['action'] ?? 'home';

$page = $jokeController->$action();
$title = $page['title'];

if (isset($page['variables'])) {
  extract($page['variables']);
}

ob_start();

include __DIR__ . '/../templates/' . $page['template'];

$output = ob_get_clean();
```

Now, the `JokeController` look like this

```php
<?php

class JokeController
{
    private DatabaseTable $authorsTable;
    private DatabaseTable $jokesTable;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $jokesTable)
    {
        $this->authorsTable = $authorsTable;
        $this->jokesTable = $jokesTable;
    }

    public function home()
    {
        $title = 'Internet Joke Database';

        return [
            'template' => 'home.html.php',
            'title' => $title,
            'variables' => []
        ];
    }

    public function list()
    {
        $result = $this->jokesTable->findAll();

        $jokes = [];
        foreach ($result as $joke) {
            if (isset($joke['authorid'])) {
                $author = $this->authorsTable->findById($joke['authorid']);

                $jokes[] = [
                    'id' => $joke['id'],
                    'joketext' => $joke['joketext'],
                    'jokedate' => $joke['jokedate'],
                    'name' => $author['name'],
                    'email' => $author['email']
                ];
            }
        }

        $title = 'Joke List';

        $totalJokes = $this->jokesTable->total();

        return [
            'template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes
            ]
        ];
    }

    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('Location: index.php?action=list');
        exit();
    }

    public function edit()
    {
        if (isset($_POST['joke'])) {
            $joke = $_POST['joke'];

            $joke['jokedate'] = new DateTime();
            $joke['authorid'] = 1;

            $this->jokesTable->save($joke);

            header('Location: index.php?action=list');
            exit();
        } else {
            $title = 'Create New Joke';

            if (isset($_GET['jokeid'])) {
                $joke = $this->jokesTable->findById($_GET['jokeid']);
                $title = 'Edit Joke';
            }

            return [
                'template' => 'editjoke.html.php',
                'title' => $title,
                'variables' => [
                    'joke' => $joke ?? null
                ]
            ];
        }
    }
}
```

### 11.15. Be careful with `extract`

Everything is working perfectly, and we’ve managed to remove the repeated code
from the controller’s methods. Unfortunately, we’re not quite done yet.

One of the biggest problems with extract is that it creates variables in the
**current scope**.

What would happen if the array `$page['variables']` contained the keys `page`
and `title`? The `$title` and `$page` variables would be **overwritten**! It’s likely the
overwritten $page variable would not be an array with a key called template that
contains the name of a template file.

A very simple solution to this is moving the code that loads the template into `its
own function` (limit the `extract` function `scope`). Amend `index.php` to this:

```php
<?php

function loadTemplate($templateFileName, $variables = [])
{
  extract($variables);

  ob_start();

  include __DIR__ . '/../templates/' . $templateFileName;

  return ob_get_clean();
}

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../controllers/JokeController.php';

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');
  $jokeController = new JokeController($jokesTable, $authorsTable);

  $action = $_GET['action'] ?? 'home';

  $page = $jokeController->$action();

  $title = $page['title'];

  if (isset($page['variables'])) {
    $output = loadTemplate($page['template'], $page['variables']);
  } 
  else {
    $output = loadTemplate($page['template']);
  }

} catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in '. $e->getFile() . ':' . $e->getLine();
}
 
include __DIR__ . '/../templates/layout.html.php';
```

## 12. Creating an Extensible Framework

We're not going to add any new feature. Instead, I'm going to show you how the code can be organized so that
it can be reused on each website you build.

### 12.1. Search Engine

In PHP, functions are not **case sensitive**. `list` is treated exactly the
same way as `LIST`. Due to case insensitivity, visiting `index.php?action=list` will
display the page, but so will `index.php?action=LIST` or
`index.php?action=List`. This may seem like a good thing, as people will be able
to mistype the URL and still see the correct page. However, this feature can also
**cause problems for search engines**.

Search engines generally **dislike “duplicate content”**, either ranking it lower or ignoring it altogether.

A common way to fix this is `forcing all URLs to lowercase`.

We can also use the `header` function to send all `uppercase` URLs to their `lowercase` equivalents:

```php
$action = $_GET['action'] ?? 'home';

if ($action == strtolower($action)) {
    $page = $jokeController->$action();
} else {
    header('Location: index.php?action=' . strtolower($action));
    exit();
}
```

Now anyone who visits `index.php?action=LISTJOKES` or
`index.php?action=listJokes` will be redirected to
`index.php?action=listjokes`. However, there’s one more thing we need to do.

There are two types of redirection:
- temporary 
- permanent. 

To tell search engines not to list the page, you need to tell them the redirection is **permanent**.

This is done with an `“HTTP response code”`.

Each time a page is sent to the browser, a `response code` is sent along with it to tell the
browser and search engines how to treat the page. To tell the browser that a
redirect is `permanent`, you need to send the code `301`.

```php
$action = $_GET['action'] ?? 'home';

if ($action == strtolower($action)) {
    $page = $jokeController->$action();
} else {
    http_response_code(301);
    header('Location: index.php?action=' . strtolower($action));
    exit();
}
```

### 12.2. Make things generic

In PHP and any other programming language, if you can make a piece of code
`generic` and able to cope with different use cases, it's generally considered `better`,
because it's more flexible.

### 12.3. Thinking ahead: User registration

Instead of writing all to `index.php`, we'll create a new controller called `RegisterController` with some methods to handle user registration.

This helps keep the code manageable, by keeping anything to do with jokes in `JokeController` and any page 
related to user registration in `RegisterController`.

We will need to write a file such as `register.php` to handle incomming request, and it looks like this

```php
try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../controllers/RegisterController.php';

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  $registerController = new RegisterController($authorsTable);

  $action = $_GET['action'] ?? 'home';

  if ($action == strtolower($action)) {
    $page = $registerController->$action();
  }
  else {
    http_response_code(301);
    header('Location: index.php?action=' . strtolower($action));
    exit();
  }

  $title = $page['title'];

  if (isset($page['variables'])) {
    $output = loadTemplate($page['template'], $page['variables']);
  }
  else {
    $output = loadTemplate($page['template']);
  }
}
catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
```

Most of this code is identical to `index.php`. The only differences are:

- `include 'JokeController.php'`; becomes `include 'RegisterController.php'`;
- `$jokeController = new JokeController($jokesTable, $authorsTable);` becomes `$registerController = new RegisterController($authorsTable);`
- `$jokeController->$action()` becomes `$registerController->$action()`

It would be better if a `single index.php` could work with **any controller** in the
same way it works with any action, `avoiding` the need for different PHP files for
loading each controller.

The third change is very easy to fix, so let's remove that difference first.

The only reason this needs changing is because of the different variable names
`$jokesController` and `$registerController`. If the **same variable names** were
used throughout—such as `$controller`—then this change wouldn’t be needed.

The **solution to 1**. will be simple to implement. As we saw when loading templates, the `include`
statement can be used to include files using a string stored in a variable. 

Making this change to include the correct file is fairly simple

```php
$controllerName = ucfirst($_GET['controller']) . 'Controller';

include __DIR__ . '/../controllers/' . $controllerName . '.php';
```

Using the same process we used to define `$action`, it’s also
possible to specify a URL parameter for controller, like so:
`index.php?controller=jokes&action=listJokes`. We could use this to load
`JokesController` and call the action `listJokes`.

The complete block of code looks like this 

```php
$action = $_GET['action'] ?? 'home';

$controllerName = $_GET['controller'] ?? 'joke'; 

if ($action == strtolower($action) && $controllerName == strtolower($controllerName))  {
  $className = ucfirst($controllerName) . 'Controller';

  include __DIR__ . '/../controllers/' . $className . '.php';

  $controller = new $className($jokesTable, $authorsTable);
  $page = $controller->$action();
}
else {
  http_response_code(301);
  header('location: index.php?controller=' . strtolower($controllerName) . '&action=' . strtolower($action));
  exit();
}
```

But the `Constructors` is required for 2 parameters. In the other hand, the `RegisterController` class
will only require `$authorTable`.

### 12.4. Dependencies

Different controllers will inevitably require different dependencies.

An object that's required by another object is called a **dependency**. For example, `JokeController` is 
*dependent* on the `$jokesTable` instance, as without it, it won't work correctly.

To identify a dependency in a piece of code, look for a function call on another object. For example, the 
`delete` method in the controller depends on the `jokesTable` variable, and that variable must contain a `DatabaseTable` instance.

Without a `DatabaseTable` instance, the `delete` method below can't work. It's `dependent' on functionality from another class`

```php
public function delete() {
  $this->jokesTable->delete($_POST['id']);
  header('Location: .');
  exit();
}
```

Look at this example,

- Create a new instance of `JokeController`

```php
$controller = new JokeController($authorsTable, $jokesTable);
```

- Create a new instance of `AuthorController`

```php
$controller = new RegisterController($authorsTable);
```

So the hard question is, how do we know what dependencies the required controller needs?

I’ll warn you now, this is the most complicated topic in this book, and something
even very experienced developers struggle with! Different people have come up
with some potential solutions, and there are many approaches you can take.

However, many are considered “bad practice” and should be avoided.

I could
write a book on this subject alone (it’s a large section of my PhD thesis!) so
instead of telling you what not to do (creating the objects in the constructor of the
controller, singletons or service locators), I’m going to stick with best practices
and show you a few options for handling it in the preferred way.

If we’re trying to automate creation of the
controllers, it presents a problem: if the constructors are different, how can the
objects be automatically created?

- #1: Ensure all controllers have the same contructor. They all require access to all the possible `Databaase`
objects. This works, but it's messy. **One major downside to this approach is that, when a new database table is added, all the controolers' constructors must be changed**.

- #2. Passing an array of all the possible dependencies and pciking out the ones we need. This is essentially something known as a **Service Locator**, and it's a common approach, although it's been 
widely considered bad practice over the last few years.

The technical term for waht we're doing is **dependency injection**.
It sounds
complicated, but it’s just a fancy term for passing dependencies into constructors.
You’ve been doing it all along without even knowing!

The simplest way of solving the problem of different constructors needing
different arguments is a series of if statements. This way, each controller can be
created with the correct dependencies:

```php
$action = $_GET['action'] ?? 'home';

$controllerName = $_GET['controller'] ?? 'joke';
if ($controllerName === 'joke') {
  $controller = new JokeController($jokesTable, $authorsTable);
}
else if ($controllerName === 'register') {
  $controller = new RegisterController($authorsTable);
}

$page = $controller->$action()
```

This approach is **very flexible**. It allows us to call **any method** in **any controller** by
specifying the **class name** in the **controller URL variable** and method name in
the action URL variable. Although this adds some flexibility, it also opens up
 **several security** issues. Someone can alter the URL and run any method in any
class. Depending on what our controllers are doing, this may cause a problem.

Instead, it’s more secure, and only a little extra code, to specify a `single URL
variable that triggers a specific controller action`. This single URL variable is
called a **route**.

```php
$route = $_GET['route'] ?? 'joke/home'; // If no route variable is set, use 'home'

if ($route === 'joke/list') 
  include __DIR__ . '/../classes/controllers/JokeController.php';
  $controller = new JokeController($jokesTable, $authorsTable);
  $page = $controller->list();
}

else if ($route === 'joke/home') {
  include __DIR__ . '/../classes/controllers/JokeController.php';
  $controller = new JokeController($jokesTable, $authorsTable);
  $page = $controller->home();
}

else if ($route === 'register') {
  include __DIR__ . '/../classes/controllers/RegisterController.php';
  $controller = new RegisterController($authorsTable);
  $page = $controller->showForm();
}

```

Although thí í slightly mỏe code and we have some repeatition, it's considerably more secure. 
Someone can only instantiate a controller and call a method if it's in this list.
In this case, the repetition is prefereable to the potential security hole of letting anyone call any method.

The complete `index.php` now looks like this:

```php
<?php 

function loadTemplate($templateFileName, $variables = [])
{
  extract($variables);

  ob_start();
  include __DIR__ . '/../templates/' . $templateFileName;

  return ob_get_clean();
}

try {
  include __DIR__ . '/../includes/DatabaseConnection';
  include __DIR__ . '/../classes/DatabaseTable';

  $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  // If no route variable is set, use `joke/home`
  $route = $_GET['route'] ?? 'joke/home';

  if ($route == strtolower($route)) {

    if ($route === 'joke/list') {
      include __DIR__ . '/../classes/controllers/JokeController.php';
      $controller = new JokeController($jokesTable, $authorsTable);
      $page = $controller->list();
    }
    else if ($route === 'joke/home') {
      include __DIR__ . '/../classes/controllers/JokeController';
      $controller = new JokeController($jokesTable, $authorsTable);
      $page = $controller->home();
    }
    else if ($route === 'joke/edit') {
      include __DIR__ . '/../classes/controllers/JokeController.php';
      $controller = new JokeController($jokesTable, $authorsTable);
      $page = $controller->edit();
    }
    else if ($route === 'joke/delete') {
      include __DIR__ '/../classes/controllers/JokeController.php';
      $controller = new JokeController($jokesTable, $authorsTable);
      $page = $controller->delete();
    }
    else if ($route === 'register') {
      include __DIR__ . '/../classes/controllers/RegisterController.php';
      $controller = new RegisterController($authorsTable);
      $page = $controller->showForm();
    }

  }
  else {
    http_response_code(301);
    header('location: index.php?route=' strtolower($route));
    exit();
  }

  $title = $page['title'];

  if (isset($page['variables'])) {
    $output = loadTemplate($page['template'], $page['variables']);
  }
  else {
    $output = loadTemplate($page['template']);
  }
}
```

Ideally, we were looking to be able to use **any controller** without editing
`index.php`. But for simplicity's sake, we'll stick with this approach.

Change the links

```html
  <li> <a href="index.php">Home</a> </li>
  <li> <a href="index.php?route=joke/list">Jokes List</a> </li>
  <li> <a href="index.php?route=joke/edit">Add a new Joke</a> </li>
```

Before we go ahead and change `all the links throughout the website`, I want to
introduce an approach called **URL Rewriting**, `which is another reason for using a
single route variable instead of separate controller and action variables`.

### 12.5. URL Rewriting

A lot of websites are written in PHP, including Facebook and Wikipedia. If you
visit one of these sites, you’ll see that the URLs don’t look like the ones we’ve
been using on the joke website.

The URL for SitePoint’s Wikipedia page is **https://en.wikipedia.org/wiki/SitePoint**, 
and its Facebook page URL is **https://www.facebook.com/sitepoint**.

Using the structure we’ve looked at so far, you’d probably expect to see something like 
**https://www.facebook.com/index.php?controller=page&id=sitepoint** or 
**https://en.wikipedia.org/index.php?route=wiki/sitepoint**

Most PHP websites don't actually show you the PHP filename in the URL.
Many years ago, search engines preferredn this approach. These days, search engines don't care about 
URL structure, and friendly URLs are used more for aesthetic reasons.

As most websites use this approach, it's useful to know how to do it.

> URL Rewriting is a tool for forwarding one URL to another. 

You con configure your web server so that when someone visits `/jokes/list`, it actually runs
`index.php?route=jokes/list`, or even when someone visits `contact.php` it instead it
runs `index.php?route=contact`.

> Importantly, the original URL is still shown in the browser's address bar.

**URL Rewriting** is a long and complex topic. You can set up all kinds of wonderful
and impressive rules. However, almost all modern PHP websites use the same
rule: `if a file requested doesn’t exist, load index.php`.

#### 12.5.1. NGINX URL Rewriting

If you need to configure an `NGNIX` server for `URL rewriting`, the guile on the NGINX website is 
the first place to look for examples.

However, for most setups you'll just need the configuration directive

```sh
location / {
  try_files $uri $uri/ /index.php;
}
```

#### 12.5.2. Apache Server

For Apache servers, the same can be achived by creating a file called `.htaccess` in the `public`
(or, more likely for `Apache`, `public_html` or `httpdocs`) directory with the following contents

```.htaccess
conf
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^.*$ /index.php [NC,L,QSA]
```

How this works is beyond the scope of this book, but it will have the same effect. If 
a file doesn't exist, it will load `index.php` rather than display an error. More
information on configuring `URL` rewriting when using `Apache` can be found in the `SitePoint`
article `Learn Apache mod rewrite: 13 Real-world Examples`

You know just enough about **URL rewriting** to make use of it on the site. Rather
than using a **$_GET** variable to determine the route, you can use the URL that the
person used to connect to the website. PHP supplies this information in the
variable `$_SERVER['REQUEST_URI']`.

Open up `index.php` and replace this

```php
$route = $_GET['route'] ?? 'joke/home';
```

...with this:

```php
$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
```

The ltrim function removes the leading `/`. If you visit `http://192.168.10.10/joke/list`,
 `$_SERVER['REQUEST_URI']` will store the string `/joke/list`. By
trimming any leading slashes, we can match the request URI to our existing
routes.

Because the `$_SERVER['REQUEST_URI']` contains the `complete URL`, if the URL
contains `$_GET variables`, the entire URL string is included in the variable. We
don’t want these in our routes.

The following code will return the entire string up to the first question mark, or
the entire string if there’s no question mark:

```php
strtok($_SERVER['REQUEST_URI'], '?');
```

Replace link

```html
  <li> <a href="/">Home</a> </li>
  <li> <a href="/joke/list">Jokes List</a> </li>
  <li> <a href="/joke/edit">Add a new Joke</a> </li>
```

The edit link and delete form action in `jokes.html.php`

```php
<a href="/joke/edit?jokeid=<?= $joke['id'] ?>">Edit</a>

<form action="/joke/delete" method="POST">
  <input type="hidden" name="id" value="<?= $joke['id'] ?>">
  <input type="submit" value="Delete">
</form>
```

The redirects in `JokeController`

```php
header('location: /joke/list');
```

### 12.6. Tidying Up

You've problably noticed that `index.php` is getting a bit long and unwieldy. Before
we get into creating `RegisterController.php`, let's tidy up `index.php` a little.

### 12.6. Tidying Up

#### 12.6.1. Make it OOP

One of the primary causes of overly complex code is nested `if` statements.
With
any long piece of code, it’s possible to break it up into a single class with a set of
functions.

This can be done by identifying unique tasks within the code. Looking at the
code, we can see the following distinct tasks:

- instantiating the `controller` and `calling` the relevant action based on `$route`
- the `loadTemplate` function
- redirecting to a `lowercase` version of the `URL` if required
- loading the relevant template file and setting its variables

Let’s take each of these and make it a **function** inside a class called `EntryPoint`,
inside the `classes` directory.

This class will take a single variable, `$route`, representating the route to load.
It will then store the route in a class variable so that each function can use it.

```php
class EntryPoint
{
  private $route;

  public function __construct($route)
  {
    $this->route = $route;
  }
}
```  

The next step is checking that the route is the correct case and redirecting to the lowercase
version if it's not

```php
class EntryPoint
{
  private function checkUrl() {
    if ($this->route !== strtolower($this->route)) {
      http_response_code(301);
      header('location: ' . strtolower($this->route));
      exit();
    }
  }
}
```

We will call this `method` on the `constructor` to make sure that the `route` always in valid status.

```php
class EntryPoint
{
  public function __construct($route)
  {
    $this->route = $route;
    $this->checkUrl();
  }
}
```

Copied the `loadTemplate` function 

```php
class EntryPoint
{
  private function loadTemplate($templateFileName, $variables = []) {
    extract($variables);

    ob_start();
    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean();
  }
}
```

Extract all logic for calling the corresponding `Controller` and `Action`

```php
class EntryPoint
{
  private function callAction()
  {

    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');  

    if ($route === 'joke/list') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->list();
    } else if ($route === '') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->home();
    } else if ($route === 'joke/edit') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->edit();
    } else if ($route === 'joke/delete') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->delete();
    } else if ($route === 'register') {
        include __DIR__ . '/../controllers/RegisterController.php';
        $controller = new RegisterController($authorsTable);
        $page = $controller->showForm();
    }
  }
}
```

A single point for firing up

```php
class EntryPoint
{
  public function run()
  {
    $page = $this->callAction();

    $title = $page['title'];

    if (isset($page['variables'])) {
      $output = $this->loadTemplate($page['template'], $page['variables']);
    }
    else {
      $output = $this->loadTemplate($page['template']);
    }

    include __DIR__ . '/../templates/layout.html.php';
  }
}
```

Make use of the `SingleEntrypoint`

```php
<?php

try {
    include __DIR__ . '/../classes/EntryPoint.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route);
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}
```

We just made some very substantial changes. Although none of the code is new,
and it doesn’t produce any different output, the structure is **completely different**.
Take a look through the completed `EntryPoint.php` to see how it works. Each
task is now in its own method, rather than being nested inside a series of if
statements.

Our `index.php` and `EntryPoint.php` can now be used to load `any controller` class, and 
call any method on it, by specifying the appropriate route.

A controller can be easily added by creating a class in the `controllers` directory
and adding the logic for creating the controller and calling the relevant action 
in the `callAction` method.

### 12.7. Reusing Code on Different Webistes

Now that we’ve tidied up index.php, it’s worth considering what we’ve achieved
by doing so. We’ve broken up the code into more easily manageable chunks, and
the code is easier to read.

Even though we haven’t finished our Internet Joke Database website yet, it’s
worth thinking about your next website. You probably didn’t buy this book so
you could make a website for people to post jokes. You likely have a real project
in mind that you’re planning to build using the knowledge you learn from this
book.

How much of the code we’ve written so far can be used without modification on
your next website?

### 12.8. Generic or Project Specific?

Besides the `DatabaseTable` class, how much of the code we’ve written so far
would be useful on another website?

No

- Templates with HTML
- Controllers would be different (`JokeController` is very specific to our website)

Yes

- `EntryPoint` class
  - Load `Controllers`
  - Load `Template files`

There are two types of code files in any given website

- `project-specific`: files containing code that's only relevant to that particular website
- `generic`: reusable files containing code that can be used to build any website.

The more code we can make `generic`, the bigger the foundation we have to work from when we start
a new website.

If we can use a lot of code from our previous website on our next website, we'll save ourselves a lot of time.

This foundation is called a `framework` - a set of `generic code` (usually classes) that can be 
quickly built on to any website. It doesn't contain any code that's specific to one particular project.

It's important to make a distinction between `framework code` and `project-specific code`.

If we can `successfully separate` them, we can `reuse` our `framework` code in
every website we build, saving significant upfront development time. If we have
framework code `mixed` with project-specific code, we’ll find ourselves writing
very similar code for every website we build.

When we first start out, it can be `difficult` to recognize which parts of the code
belong specifically to that project, and which can be used across different
projects.

>> As a rule of thumb, processes are generic but data is specific.

For example, adding a joke to the database is `specific` to the joke site, but adding to the
database is a `generic` process that’s needed on most websites.

In **Chapter 8**, I showed how to separate out the generic add to database process
from the project-specific process of adding a joke. Anything related to `jokes` is in
`JokeController.php`, but all the code related to adding to the database is stored
in `DatabaseTable.php`.

> The first step to making something `generic` is usually placing it inside a class.
> This helps us break up the problem into smaller parts.
> Once we've broken the problem up into individual methods, we can then see which are `generic` and which are `project sepcific`
> A dead giveaway that something is `project specific` is a hardcoded value or variable name 
> that alludes to something for that project only

Let’s apply that to the new `EntryPoint` class. The methods `loadTemplate`,
`checkUrl` and run don’t contain any references to `jokes`, `authors` or anything that’s
specific the `joke website`. Indeed, we’ll need a way of loading `controllers` and
`templates` on future websites; they just won’t be dealing with `jokes and authors`.

However, the `callAction` method contains several references to `jokes` and
`authors`. If we wanted to reuse this class on a different website, we'd need to rewrite the entire method.
It won't have controllers or database tables dealing with `jokes` authors; it will have controllers and 
database tables for `products`, `customers` and `orders`.

Let’s imagine we do have two websites—the joke website and an online shop.
We’ve copy/pasted the file EntryPoint.php and changed callAction to suit each
website. If there’s a bug in the checkUrl or run methods, we’d need to fix the bug
in two places, while being careful not to change any code specific to that website.

Instead, if the file contained only the `generic` framework code, we could overwrite
the old `EntryPoint.php` with the new one everywhere it’s being used, and fix the
bug without worrying about undoing changes that were made specifically for one
project.

### 12.9. Making `EntryPoint` Generic

The answer, then, is to remove all references to `project-specific` concepts from 
otherwise generic classes.

This process is more of an art than a science, and even experienced developers
can struggle to work out where to draw the line between generic and projectspecific code. However, I’m going to show you a fairly simple step-by-step
process that can be used to remove a project-specific method from a class, turning
it into a framework class.

#### 12.9.1. Identify the method you want to remove

In this case, it's the `callAction` method

```php
private function callAction()
{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    if ($this->route === 'joke/list') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->list();
    } else if ($this->route === 'joke/edit') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->edit();
    } else if ($this->route === 'joke/delete') {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->delete();
    } else if ($this->route === 'register') {
        include __DIR__ . '/../controllers/RegisterController.php';
        $controller = new RegisterController($authorsTable);
        $page = $controller->showForm();
    } else {
        include __DIR__ . '/../controllers/JokeController.php';
        $controller = new JokeController($authorsTable, $jokesTable);
        $page = $controller->home();
    }

    return $page;
}
```

#### 12.9.2. Move the method to its own class and make it `public`

Create a class called `IjdbRoutes` in `classes/IjdbRoutes.php`

```php
class IjdbRoutes
{
  public function callAction()
  {
      include __DIR__ . '/../includes/DatabaseConnection.php';
      include __DIR__ . '/DatabaseTable.php';

      $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
      $authorsTable = new DatabaseTable($pdo, 'author', 'id');

      if ($this->route === 'joke/list') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->list();
      } else if ($this->route === 'joke/edit') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->edit();
      } else if ($this->route === 'joke/delete') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->delete();
      } else if ($this->route === 'register') {
          include __DIR__ . '/../controllers/RegisterController.php';
          $controller = new RegisterController($authorsTable);
          $page = $controller->showForm();
      } else {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->home();
      }

      return $page;
  }
}
```

#### 12.9.3. Replace any referenced class variables with arguments

Replace `$this->route` with `$route` and add the `$route` as arguments for the method.

```php
class IjdbRoutes
{
  public function callAction($route)
  {
      include __DIR__ . '/../includes/DatabaseConnection.php';
      include __DIR__ . '/DatabaseTable.php';

      $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
      $authorsTable = new DatabaseTable($pdo, 'author', 'id');

      if ($route === 'joke/list') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->list();
      } else if ($route === 'joke/edit') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->edit();
      } else if ($route === 'joke/delete') {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->delete();
      } else if ($route === 'register') {
          include __DIR__ . '/../controllers/RegisterController.php';
          $controller = new RegisterController($authorsTable);
          $page = $controller->showForm();
      } else {
          include __DIR__ . '/../controllers/JokeController.php';
          $controller = new JokeController($authorsTable, $jokesTable);
          $page = $controller->home();
      }

      return $page;
  }
```

#### 12.9.4. Remove the method from the original class

Remove `callAction` from the `EntryPoint` class

#### 12.9.5. Add a new constructor argument/class variable to the original class.

Add `$controllerArugments` as a constructor argument/class variable to `EntryPoint`

```php
class EntryPoint {
  private $route;
  private $routes;

  public function __construct($route, $routes) {
    $this->route = $route;
    $this->routes = $routes;
    $this->checkUrl();
  }
}
```

We'll use the `$routes` variable to contain an instance of `IjdbRoutes`

Add `$controllerArugments` as a constructor argument/class variable to `EntryPoint`

```php
class EntryPoint {
  private $route;
  private $routes;

  public function __construct($route, $routes) {
    $this->route = $route;
    $this->routes = $routes;
    $this->checkUrl();
  }
}
```

We'll use the `$routes` variable to contain an instance of `IjdbRoutes`

#### 12.9.6. Pass in an instance of the new class when the original class is created

```php
include __DIR__ . '/../classes/EntryPoint.php';
include __DIR__ . '/../classes/IjdbRoutes.php';

$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

$entryPoint = new EntryPoint($route, new IjdbRoutes());
$entryPoint->run();
```

#### 12.9.7. Change the method call to reference the new object and pass in any required variables

```php
class EntryPoint {
  private $route;
  private $routes;

  public function __construct($route, $routes) {
    $this->route = $route;
    $this->routes = $routes;
    $this->checkUrl();
  }

  public function callAction() {
    $this->routes->callAction($this->route);
  }
}
```

With that complete, we now have a `generic` `EntryPoint.php`. There are no longer any
references to `jokes`, `authors` or anything specific to one particular website.

In future, to create a website for an online shop, we can write the relevant `ShopActions`
class with a `callAction` method to handle the arguments for that specific website

```php
class ShopActions {
  public function callAction($route) {

    // load the controller and call the relevant action

    return $controller->$action();
  }
}
```

### 12.10. Autoloading and Namespaces

One line of code we're repeating often is the `include` line to include a relevant class each time a 
class is required.

Any time we use one of the classes we’ve created, it must be `referenced` with an
`include` statement. This can get tricky to manage, as you need to ensure the class
file has been `included before you use the class`. On top of that, if you accidentally
issue the include statement `twice` for the same class, you’ll see an `error`.

A very inefficient but easy-to-organize method of managing loading classes would be to include every 
single class at the top of the `index.php` file, so that any class that might be needed has already been loaded. 

Using this method, we'll never have to write an `include` statement for a class outside `index.php`

A major drawback of this approach is that each time you add a new class to the
project, you’ll have to open up `index.php` and add the relevant `include`
statement. This is time consuming, and will use an `unnecessary amount` of
memory on the server, as all `classes` would be loaded whether they’re needed or
not.

I’ve advised placing `classes` in their `own files` throughout this book, as well as
`naming files` to match identically the name of the classes they contain. The class
`DatabaseTable` is inside the file `DatabaseTable.php`, `JokeController` is stored
in `JokeController.php`, and `EntryPoint` is stored in a file called
`EntryPoint.php`.

One of the reasons I've advised structuring files this way is that it's considered good practice.
It helps someone reading the code to find the classes that are referenced.

One other advantage of a `standardized file structure` is that PHP contains a feature called `autoloading`.
Autoloading is used to `automatically load` PHP files that store classes. As long as your file names are 
`consistent` with the class names, it's easy to write an `autoloader` to load the relevant PHP file.

Once we've written an `autoloader`, we'll never need to write an `include` line for a class anywhere 
in the project.

When we use the statement `new ClassName()`, if the class `ClassName` doesn't exist (because it hasn't been 
included), `PHP` can trigger an `autoloader` that can then load the file `ClassName.php`, and the rest of the 
script will continue as normal without us ever needing to manually write the line `include 'ClassName.php';`

An `autoloader` is a function that takes a class name as an argument and then `includes` the file that
contains the corresponding class. The functioni can be as simple as this

```php
function autoloader($className) {
  $file = __DIR__ . '/../classes/' . $className . '.php';
  include $file;
}
```

It would be possible to use this function manually to save a little time

```php
autoloader('DatabaseTable');
autoloader('EntryPoint');
```

This would `include` both `DatabaseTable.php` and `EntryPoint.php`. However, it's 
possible to `instruct PHP` to call this function `automatically` whenever it can't find a class
that's `referenced`:

```php
spl_autoload_register('autoloader');
```

The function `spl_autoload_register` is built into `PHP` and allows us to tell `PHP` to call
the function the name we've given if it comes across a class that hasn't yet been `included`

The `autoloader` function will be called automatically when a class is used for the `first time`

```php
function autoloader($className) {
  $file = __DIR__ . '/../classes/' . $className . '.php';
  include $file;
}

spl_autoload_register('autoloader');

$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
$controller = new EntryPoint($jokesTable);

```

Now files will automatically be included the first time the class stored in them is
used. `new DatabaseTable` will `trigger` the `autoloader` with `DatabaseTable`, as the
`$className` argument and `DatabaseTable.php` will be included.

### 12.11. Case Sensitivity

> PHP classes are not `case sensitive`, but file names usually are.
> This can cause a problem with autoloaders.

A problem is caused in a situation lie this

```php
$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
$authorsTable = new databasetable($pdo, 'author', 'id');
```

The code above `will work` as intended, because the first time `DatabaseTable` is loaded 
with the correct case, the file is `successfully included` and `PHP's` case 
insensitivity allows both objects to be constructed.

However, if we reverse the order of arguments - because the `autoloader` is triggered with a `lowercase name`, 
we'll get an `error`

```php
$authorsTable = new databasetable($pdo, 'author', 'id');
$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
```
An `alternative` is to make `all file names lowercase` and have the `autoloader`
`convert` the `class name to lowercase` before `loading the file`. Although this is a
more robust approach and arguably a better technical implementation, it goes
against `PHP community conventions`, and will cause problems if we want to
share our code with other people in the future.

### 12.12. Implement an `Autoloader`

Let's implement an `autoloader`. To keep things organized, let's create `autoload.php` and save
it in the `includes` directory.

```php
function autoloader($className)
{
  $file = __DIR__ . "/../classes/$className.php";
  include $file;
}

spl_autoload_register('autoloader');
```

Now, we can amend `index.php` to include the `autoloader`, but remove the `include lines` that 
explicitly include `EntryPoint.php` and `IjdbRoutes.php`

```php
try {
    include __DIR__ . '/../includes/autoload.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route, new IjdbRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}
```

We can also remove the include line for `DatabaseTable` from `IjdbRoutes.php`

```php
class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->list();
        } else if ($route === 'joke/edit') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->edit();
        } else if ($route === 'joke/delete') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->delete();
        } else if ($route === 'register') {
            include __DIR__ . '/../controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        } else {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->home();
        }

        return $page;
    }
}

```

> Autoloaders can only be used to load classes, and that's one of the reasons it's 
> a good idea to structure as much of our code as possible inside classes.

Let's implement an `autoloader`. To keep things organized, let's create `autoload.php` and save
it in the `includes` directory.

```php
function autoloader($className)
{
  $file = __DIR__ . "/../classes/$className.php";
  include $file;
}

spl_autoload_register('autoloader');
```

Now, we can amend `index.php` to include the `autoloader`, but remove the `include lines` that 
explicitly include `EntryPoint.php` and `IjdbRoutes.php`

```php
try {
    include __DIR__ . '/../includes/autoload.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route, new IjdbRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}
```

We can also remove the include line for `DatabaseTable` from `IjdbRoutes.php`

```php
class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->list();
        } else if ($route === 'joke/edit') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->edit();
        } else if ($route === 'joke/delete') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->delete();
        } else if ($route === 'register') {
            include __DIR__ . '/../controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        } else {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($authorsTable, $jokesTable);
            $page = $controller->home();
        }

        return $page;
    }
}

```

> Autoloaders can only be used to load classes, and that's one of the reasons it's 
> a good idea to structure as much of our code as possible inside classes.

### 12.13. Redecorating

If we peruse the rest of the code for `include` statements, we'll see that the `autoloader` works
for all classes that are `framework` classes, but doesn't work for `JokeController` or `RegisterController`.

Because of them is placed inside the `classes/controllers`, not `classes` itself.

It 's a good idea to keep these separated in different directories, so that you can easily copy/paste `framework`
files between websites without copying files that are specific to a single project.

Let's name our framework `Ninja`. Move all the framework code into a directory called `Ninja` inside the
classes directory (`EntryPoint.php`, `DatabaseTable.php`).

Similarly, let's create a new directory inside the classes directory call `Ijdb`.
This is where we'll keep all the code that's specific to the joke site and can't be 
reused on future websites.
We'll move `IjdbRoutes.php` into the `Ijdb` directory and move the `controllers` directory inside as well.

When we're finished, `EntryPoint.php` and `DatabaseTable.php` should be located inside 
`classes/Ninja`, while `JokeController` should be stored inside `classes/Ijdb/Controllers` and 
`IjdbRoutes.php` inside `classes/Ijdb`.

Change the corresponding link 

In `EntryPoint.php`

```php
include __DIR__ . '/../../templates/' . $templateFileName;
include __DIR__ . '/../../templates/layout.html.php';
```

In `IjdbRoutes.php`

```php
include __DIR__ . '/../../includes/DatabaseConnection.php';

```

![Image](assets/reproject.png)

Now, we will fix the `autoloader`, because it currently looking in the wrong place.

To solve this, we could add some logic to the `autoloader` that looks at the name of the class
and loads the file form the `correct location`, or store an array of `class names mapped to file names`.

Instead, we're going to use a new tool: `namespace`.

### 12.14. Namespaces

One feature that has revolutionized PHP and made it much easier to share code online is `namespace`.

Before `namespaces` came along, PHP developers would name their classes with a 
prefix. For examples, we might name our classes `Ninja_EntryPoint`, `Ninja_DatabaseTable` and 
`Ijdb_JokeController`.

That way, when we wanted to use `SuperLibrary_DatabaseTable`, it wouldn't clash with `Ninja_DatabaseTable`,
and we could use both `DatabaseTable` classes on the same website.

> Namespaces provide a simpler method of solving the same problem.
> Every class we write can (and should!) be placed within a namespace

Let's move our framework files into the `Ninja` namespace. At the top of `EntryPoint.php` and 
`DatabaseTable.php`, add the following code

```php
namespace Ninja;
```

Now add the namespace `Ijdb` to `IjdbRoutes.php`

```php
namespace Ijdb;
```

Now that the classes are inside `namespaces`, this won't work. We'll need to specify the `namespace`
when instantiating the class by using a `backslash (\)`, followed by the 
`namespace`, another `backslash`, and then the class.

This line:

```php
$entryPoint = new EntryPoint($route, new IjdbRoutes());
```

... will become this:

```php
$entryPoint = new \Ninja\EntryPoint($routes, new \Ijdb\IjdbRoutes());
```

We'll give the namespace for the controllers: `Ijdb\Controllers`.

The `backslash \` in the namespace represents a `sub-namespaces` - a namespace within a namespace.
This isn't strictly necessary, but it's a good idea to keep related 
code together. In this case, we'll place all controllers inside the `Ijdb\Controllers` namespace 
and the `Ijdb/Controllers` directory.

While we’re changing the `JokeController.php` file to include the namespace,
we’ll rename the class (and file) to `Joke`. That way, the class is `\Ijdb\Controllers\Joke` rather than `\Ijdb\Controllers\JokeController`, and the
word “Controller” isn’t repeated unnecessarily in the full class name.

> This parallel between directory structures and namespaces is important.
> It allows us to write an autoloader than can use both namespaces and class names to locate the file it needs to load.
> The combined namespace and class name now represent the `folder structure`, making 
> it easy to `autoload` the classes.

> This convention is known as **PSR-4**

`PSR` stantds for `PHP Standards Recommendations`, and it's used by almost all modern `PHP projects`

Each class should be contained inside a file that directly `maps` to its `namespace` and `class name`.
The full class name including namespace should exactly match the `directory` and `file name`, including 
`case sensitivity`. 

To read more about `PSR-4` take a look at the `PHP-FIG website`.

### 12.15. Autoloading with `PSR-4`

By using `PSR-4`, it's simple to convert a class name in a `namespace` to a file path.
Let's replace `autoload.php` with this `PSR-4` version.

```php
function autoloader($className) 
{
  $fileName = str_replace('\\', '/', $className) . '.php';

  $file = __DIR__ . '/../classes/' . $fileName;

  include $file;
}

spl_autoload_register('autoloader');
```

When the autoloader is triggered with a class inside the namespace, it's passed
the `entire class name including the namespace`. 
For example, when `EntryPoint` is loaded, the autoloader is given the class name `Ninja\EntryPoint`.

The line `str_replace('\\', '/', $className) . '.php'` replaces `backslashes` with forward slashes
to represent the file in the `file system`.

`Ninja\EntryPoint` becomes `Ninja/EntryPoint.php`, referencing the file.

With the autoloader in place, we can now remove the `include` lines from `IjdbRoutes.php`,
which load `JokeController` and `RegisterController`;

```php
include __DIR__ . '/../classes/controllers/JokeController.php';
```

Then we should change the reference to the `controllers` to use the full classs name

```php
$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
```

Nearly there! we're close to having the site up and running again using the new file 
and namespace structure. However, if we try to load one of the pages, we'll
see this error.

```txt
Uncaught TypeError: Argument 1 passed to 
  Ninja\DatabaseTable::__construct() must be an instance of 
  Ninja\PDO, instance of PDO given
```

To fix it, we can open up `DatabaseTable.php` and change the type hint in the 
constructor from `PDO` to `\PDO`.

> We saw this error because namespaces are `relative`

If you provide a reference to a class name, in a type hint or following the `new` keyword,
`PHP` will look for a class with `that name` in the `current namespace`.

We also need to replace `DateTime` with `\DateTime` and `PDOException` with `\PDOException` in this file.

Because the `DatabaseTable` class is inside the `Ninja` prefix, without the backslash prefix, PHP will to 
load the class `\Ninja\PDO` rather than the inbuilt `PHP class PDO`.

The `PDO` class is in something called the `global` namespace - that is, a class that exists at the very top
level, effectively not inside a namespace.

> To reference a class in the `global namespace`, we must prefix it with a backslash.

We can `import the class DatabaseTable` into the current `namespace` with the `use` keyword.

```php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Joke {
  private $authorsTable;
}
```

We've made a lot of changes here, but only to the structure of the code. Most of 
the code is the same as before; we've just moved it around. To recap, we've done the following

- Split our code up into `classes`, recognizing the code that's specific to the joke
website and the code that can be used on any future website

- Organized all our `classes` in either the `Ijdb` directory, for `project-specific` files, 
or the `Ninja` directory for our `framework` files.

- Given all our `classes namespaces`

- Remove all `include` statements for classes by implementing a `PSR-4` compatible `autoloader`.

### 12.16. A Note on `Composer`

> Most modern PHP applications use a tool called Composer to handle all autoloading.
> It's also used to quickly and easily download and install third-party libraries.

If you follow the `PSR-4` convention, your `classes` are good to go when you want to start using it,
and you can use `composer's autoloader` as a drop-in `replacement` for the `autoload.php` we just wrote.

When you do start using `Composer`, just add this code to your `composer.json` file

```json
{
  "autoload": {
    "psr-4": {
      "Ninja\\": "classes/Ninja",
      "Ijdb\\": "classes/Ijdb"
    }
  }
}
```

## 13. And the REST

The current iteration of our router uses a very simplistic approach. Each route is a string from the URL that maps to a controller
and calls a specific action.

If we continue using this approach, we'll quickly find ourselves repeating logic in the 
controllers.

For examples, our edit joke form contains the following logic: `if the form is submitted, process 
the submission, otherwise display the form`

When the edit joke form is submitted, it uses the `POST` method. Any other request to pages
on the website will use the `GET` method.

The variable `$_SERVER['REQUEST_METHOD']` is created by PHP and will contain either the string `GET`
or the string `POST`, depending on how the page was requested by the browser.

We can use this to determine if the form was submitted, and call a different controller action if the form
was submitted

```php
if ($route === 'joke/edit') {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
    $page = $controller->edit();
  }
  else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
    $page = $controller->editSubmit();
  }
}
```

This approach works, but it's rather long-winded. Instead, we can use nested arrays to create a `data structure`
that represents all of the routes in the application

```php
$routes = [
  'joke/edit' => [
    'POST' => [
      'controller' => $jokeController,
      'action' => 'saveEdit'
    ],
    'GET' => [
      'controller' => $jokeController,
      'action' => 'edit'
    ]
  ],
  'home' => [
    'GET' => [
      'controller' => $jokeController,
      'action' => 'home'
    ]
  ]
]
```

Looking at the code for the `$routes` array, the downside of this approach is obvious: it requires
writing out exactly which controller and action to call for every single page on the website. 
There are ways around this by using `wildcards`, but I'll leave that as an exercise for the reader.

The `$routes` variable is a standard array. It's possible to extract the nested arrays.
If we wanted to get the `controller` and `action` for the `POST` method for the route
`joke/edit`, we could do it like this

```php
$route = $routes['joke/edit'];

$postRoute = $route['POST'];

$controller = $postRoute['controller'];
$action = $postRoute['action'];
```

We are effectively "diggin down" into the array, choosing which branch of the `data structure` to follow - 
a bit like the file/folder structure on your computer.

This can also be expressed in a much shorter way by chaining the square brackets for
looking up each value in the arrays

```php
$controller = $routes['joke/edit']['POST']['controller'];
$action = $routes['joke/edit']['POST']['action'];
```

By using variables in place of strings, it's possible to subsitute the hardcoded values
with values form the `$_SERVER` variables `REQUEST_URI` and `REQUEST_METHOD`

```php
$route = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];

$controller = $routes[$route][$method]['controller'];
$action = $routes[$route][$method]['action'];

$controller->$action();
```

> This approach of having the same `URL` perform different actions 
> depending on the request method is loosely know as 
> **Representational State Transfer (REST)**

Although REST typically supports the methods `PUT` and `DELETE` along with `GET` and `POST`,
because web browsers only support `GET` and `POST`, `PHP developers` tend to use `POST`
in place of both `PUT` and `DELETE` requrests. As such, it's not worth examining the differences in this book.

Some PHP developers have found superficial ways of mimicking `PUT` and `DELETE`,
but most developers just stick to using `POST` for writing data and `GET` for reading.

Let's go ahead and implement a router using the `REST` approach on our site.

```php
namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;

class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        $jokeController = new Joke($jokesTable, $authorsTable);

        $routes = [
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ]
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ]
        ];

        $method = $_SERVER['REQUEST_METHOD'];

        $controller = $routes[$route][$method]['controller'];
        $action = $routes[$route][$method]['action'];

        return $controller->$action();
    }
}
```

Now split the `edit` method in `Controllers/Joke.php` into a method for displaying the form and another for the handling the submission

```php
public function saveEdit()
{
    $joke = $_POST['joke'];

    $joke['jokedate'] = new \DateTime();
    $joke['authorid'] = 1;

    $this->jokesTable->save($joke);

    header('Location: /joke/list');
    exit();
}

public function edit()
{
    $title = 'Create New Joke';

    if (isset($_GET['jokeid'])) {
        $joke = $this->jokesTable->findById($_GET['jokeid']);
        $title = 'Edit Joke';
    }

    return [
        'template' => 'editjoke.html.php',
        'title' => $title,
        'variables' => [
            'joke' => $joke ?? null
        ]
    ];
}
```

Next, we'll just use the `IjdbRoute` class to provide the `$routes` array. We'll
rename the `callAction` method `getRoutes`, remove the argument, and have it
return the array rather than accessing it.

```php
namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;

class IjdbRoutes
{
    public function getRoutes()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        $jokeController = new Joke($jokesTable, $authorsTable);

        $routes = [
            'joke/edit' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'edit'
                ]
            ],
            'joke/delete' => [
                'POST' => [
                    'controller' => $jokeController,
                    'action' => 'delete'
                ]
            ],
            'joke/list' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'list'
                ]
            ],
            '' => [
                'GET' => [
                    'controller' => $jokeController,
                    'action' => 'home'
                ]
            ]
        ];

        return $routes;
    }
}
```

Now we'll amend `EntryPoint` to use both `$method` and `$route`. We could hard code the `$route` and 
`$method` variables in the `run` method by reading from the server here.

```php
public function run() {
  $method = $_SERVER['REQUEST_METHOD'];
  $route = $_SERVER['REQUEST_URI'];
}
```

The problem with this approach is that it's `not very flexible`.

If we ever want to use the `EntryPoint` class in an applicatioin that ins't web based, it won't work,
because these server variables won't be set.

Instead, let's create a class variable and amend the constructor to take the method along with the route

```php
class EntryPoint {
  private $route;
  private $method;
  private $routes;
  
  public function __construct($route, $method, $routes) {
    $this->route = $route;
    $this->method = $method;
    $this->routes = $routes;
    $this->checkUrl();
  }
}
```

Next, we amend the `run` method to make use of both class variables

```php
public function run()
{
    $routes = $this->routes->getRoutes();

    $controller = $routes[$this->route][$this->method]['controller'];
    $action = $routes[$this->route][$this->method]['action'];

    $page = $controller->$action();

    $title = $page['title'];
    $templateFileName = $page['template'];
    $variables = $page['variables'] ?? [];

    $output = $this->loadTemplate($templateFileName, $variables);

    include __DIR__ . '/../../templates/layout.html.php';
}
```

Then we supply the method in `index.php`

```php
try {
    include __DIR__ . '/../includes/autoload.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $method = $_SERVER['REQUEST_METHOD'];
    $routes = new \Ijdb\IjdbRoutes();

    $entryPoint = new \Ninja\EntryPoint($route, $method, $routes);
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ': ' . $e->getLine();
}
```

Avoiding hardcoding like this is a very good habit to get into. The trend in PHP (and 
software developmenet in general) is towards `test-driven development (TDD)`,
and hardcoded values like `$_SERVER['REQUEST_METHOD']` make testing difficult.
Although TDD is well beyond the scope of this book, I do want to teach you 
practices that will make you eventual move to `TDD` as easy as possible.

## 14. Enforcing Dependency Structure with Interfaces

In chapter 8, when we created the `DatabaseTable` class, we wrote the constructor so that it would check the types of its arguments

```php
public function __construct(PDO $pdo, string $table, string $primaryKey)
```

Using this approach, it's impossible to construct an instance of the `DatabaseTable`
class without supplying an instance of `PDO` as the first argument

The `EntryPoint` class has a dependency on `IjdbRoutes`, and it calles the `getRoutes` method on it

```php
$routes = $this->.routes->getRoutes();
```

However, what happens if the `$this->routes` variables is not an instance of `IjdbJokes`, or
it's an object that doesn't have a `getRoutes` method?

We can use the type hints like so

```php
public function __construct(string $route, string $method, \Ijdb\IjdbRoutes $routes)
```

But this breaks our flexibility.

This can be solved by using something called an `interface`. An interface can be used to describe 
what methods a class should contain, but doesn't contain any actual logic.

> Classes can then `implement` the interface

An interface can be used to describe what methods a class should contain, but doesn't contain
any actual logic. Classes can then `implement` the `interface`.

An `interface` for the routes would look like this

```php
namespace Ninja;

interface Routes 
{
  public function getRoutes();
}
```

Let's save the `interface` in the `Ninja` directory as `Routes.php`. Like classes,
`interface` files can be loaded by the `autoloader`.

We can now type hint the `interface` in `EntryPoint`.

```php
public function __construct(string $route, string $method, \Ninja\Routes $routes)
```

Then, we can make `IjdbRoutes` implement the interface

```php
namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes
```

This has two effects

- The class `IjdbRoutes` `must` contain the methods described in the `interface`.
If not, an error is displayed.

- The `IjdbRoutes` class can now be type hinted using the interface.

Now, when we build the online shop or any other website, we can make a new versioiin of the routes
class by implementing the `interface`

```php
namespace Shop;

class Routes implements \Ninja\Routes {
  public function getRoutes() {
    // Return routes for the online shop
  }
}
```

> Interfaces are very useful for the kind of generic framework we've built. By
> providing a set of interfaces, each website can provide classes that implement
> the interfaces, guaranteeing that the framework code and project-specific code fit together

Intefaces, when used correctly, are very powerful tool for bridging framework 
and project-specific code.

## 15. Your Own Framework

Writing a framework is a rite of passage for a `PHP developer`. Everyone does it, 
and we've just written one! Through this book, I hope I've helped you avoid some
of the common traps developrs fall into.

In this chapter you learned

- The difference between framework code and project-specific code
- How to differentiate them by use of directory structures and namespaces
- How to write an autoloader
- The basics of interfaces and REST
- Routing and URL Rewriting

## 16. Allowing Users to Register Accounts

First, add another column for password

```mysql
ALTER TABLE author ADD COLUMN password VARCHAR(255)
```

The first thing that's needed is the controller code. Create the file `Register.php` in 
the `Ijdb\Controllers` directory, then create the class with the following variables, constructor 
and a method for loading the registration form.

For registering users, the only dependency needed is the `DatabaseTable` object that represents the `authors`
table.

```php
namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Register
{
    private DatabaseTable $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm()
    {
        return [
            'template' => 'register.html.php',
            'title' => 'Register an account',
            'variables' => []
        ];
    }

    public function success()
    {
        return [
            'template' => 'registersuccess.html.php',
            'title' => 'Registration Successful',
            'variables' => []
        ];
    }

    public function registerUser()
    {
        $author = $_POST['author'];

        $this->authorsTable->save($author);

        header('Location: /author/success');
        exit();
    }
}
```

Create new `routes`

```php
namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;
use Ijdb\Controllers\Register;

use Ninja\Routes;

class IjdbRoutes implements Routes
{
    public function getRoutes()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorsTable = new DatabaseTable($pdo, 'author', 'id');

        $jokeController = new Joke($authorsTable, $jokesTable);
        $authorController = new Register($authorsTable);

        $routes = [
            'author/register' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $authorController,
                    'action' => 'registerUser'
                ]
            ],
            'author/success' => [
                'GET' => [
                    'controller' => $authorController,
                    'action' => 'success'
                ]
            ]
        ];

        return $routes;
    }
}
```

We need some control over what's allowed in the database. 
There are some rules we probably want to enforce on the data before allowing the 
record to be inserted

- All fields should actually contain some data, so `no blank` email or name
- The email address should be a real email address
- The email address entered `must not already belong to an account`

We'll use `if` statements for each check and set a boolean variable `$valid` to keep track of
whether the data is valid or not.

```php
public function registerUser()
{
    $author = $_POST['author'];

    $valid = true;

    if (empty($author['name'])) {
        $valid = false;
    }

    if (empty($author['email'])) {
        $valid = false;
    }

    if (empty($author['password'])) {
        $valid = false;
    }

    if ($valid) {
        $this->authorsTable->save($author);
        header('Location: /author/success');
        exit();
    } else {
        return [
            'template' => 'register.html.php',
            'title' => 'Register an account'
        ];
    }
}
```

I've used `empty` instead of `$author['name'] == ''` here, because this will also catch invalid
form submissions without causing an error.

To show the user their error, we will create a second array to keep a list of error messages to show to the user

```php
    public function registerUser()
    {
        $author = $_POST['author'];

        $valid = true;
        $errors = [];

        if (empty($author['name'])) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }

        if (empty($author['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        }

        if (empty($author['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }

        if ($valid) {
            $this->authorsTable->save($author);
            header('Location: /author/success');
            exit();
        } else {
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                ]
            ];
        }
    }
```

To make things even easier, we'll re-fill the form with the data from `$_POST`

```php
  return [
      'template' => 'register.html.php',
      'title' => 'Register an account',
      'variables' => [
          'author' => $author
      ]
  ];
```

In template

```php
<?php if (!empty($errors)) : ?>
    <div class="errors">
        <p>Your account could not be created, please check the following:</p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="post">
    <label for="email">Your email address</label>
    <input name="author[email]" id="email" type="text" value="<?= $author['email'] ?? '' ?>">

    <label for="name">Your name</label>
    <input name="author[name]" id="name" type="text" value="<?= $author['name'] ?? '' ?>">

    <label for="password">Password</label>
    <input name="author[password]" id="password" type="password" value="<?= $author['password'] ?? '' ?>">

    <input type="submit" name="submit" value="Register account">
</form>
```

### 16.1. Validating Email Address

As for most common problems, PHP includes a method of validating email addresses that's far more 
accurate and simpler to use than building your own.
There's no need to reinvent the wheel.

To check an email address in PHP, you can use the `filter_var` function like so

```php
$email = 'tom@example.org';

if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
  echo 'Valid email address';
}
else {
  echo 'Invalid email address';
}
```

### 16.2. Preventing the same person from registering twice

It’s very good practice to prevent the same person from registering twice with the
same email address. This can be enforced in the database, but it’s more consistent
to use PHP to check this. We already have the $authorsTable object for searching
for records in the author database table. We can make use of it to check if an
email address already exists.

Let's add another method called `find` that takes two arguments

- The column to search in 
- The value to search for

```php
$results = $authorsTable->find('email', 'tom@example.org');
```

Implement the `find` method

```php
public function find($column, $value)
{
    $sql = "SELECT * FROM `{$this->table}` WHERE `$column` = :value";

    $parameters = [
        'value' => $value
    ];

    $query = $this->query($sql, $parameters);

    return $query->fetchAll();
}
```

### 16.3. Securely Storing Passwords

The most common method of encrypting a password is using a "one way hashing function"

> A hashing function taks a string like `mypassword123` and converts it to an 
> encrypted version of the string, known as a `hash`. For example, `mypassword123` would
> be hashed and produce a seemingly random string of numbers and letters such as 
> 9c87baa223f464954940f859bcf2e233

We can using the function `md5` and `sha1`, using these functions is simple

```php
echo `md5('mypassword123')`;
```

However, it's not perfect. What do you know about Kevin and Tom's passwords? Lookking at the list you can 
see that they're the same! If you can work out Kenvin's password, you'll also know Tom's

And, what’s worse, we actually know what the password is, because we already
discovered that 9c87baa223f464954940f859bcf2e233 is the hash for
mypassword123. Because people all use the same common passwords, hackers
will generate the hashes for common passwords in order to quickly work out
which users are using them. 

There are several methods for solving this problem with duplicated hashes, but there's a lot
to consider, and making a truly secure password hash is more difficult than it seems.

Luckily for us, PHP includes a very secure way of storing passwords. It’s at least
as good as any solution developers will come up with, and avoids developers like
us needing to fully understand the security problems that can occur. For this
reason, it’s strongly recommended to use the inbuilt PHP algorithm for hashing
passwords rather than to create your own.

PHP contains two functions, `password_hash` and `password_verify`. For now,
we’re only interested in `password_hash`. We’ll use `password_verify` in the next
chapter when we’re checking to see whether someone entered the correct
username and password when logging in

```php
$hash = password_hash($password, PASSWORD_DEFAULT);
```

`PASSWORD_DEFAULT` is the algorithm to use. At the time of writing, this is an algorithm known as `bcrypt`,
but it may change overtime

Each time you run the function, you'll get a different result. If two people have the same password, 
different hashes will be stored in the database.

Let's implement the `password_hash` function in the registration form. It's surprisingly easy.

```php
if ($valid) {
    $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

    $this->authorsTable->save($author);
    header('Location: /author/success');

    exit();
} 
```

## 17. Cookies, Sessions, and Access Control

By its nature, HTTP is `stateless`. You connect to a website, the server gives you a file.

As you’ve already seen, you can send data from the browser to the server
using `GET` variables and `HTML forms`. However, `the information` is provided to a
`single page`, and is `only available` when the browser provides `GET` (or `POST`)
variables.

For a `login system`, the user will need to send their `username` and `password` to the
server `once`, and then `maintain` a “logged-in” `state` on `every subsequent page
request`.

Two technologies, `cookies` and `sessions`, can be used to store information about a particular user between pages.

### 17.1. Cookies

A `cookie` is a `name-value` pair, an array of sorts, associated with a given website, and 
stored on the computer that runs the client (browser). Once a cookie is set by a 
website, all future page requests to that same site will send the information 
stored in the cookie back to the website until it `expires`.

Other websites are unable to access the cookies set by your site, and vice versa.

The life cycle of a PHP-generated cookie is as follows:

1. First, a web browser requests a URL that corresponds to a PHP script. Within that script is a 
call to the `setcookie` function that's built into PHP

2. The page produced by the PHP script is sent back to the browser, along with an `HTTP set-cookie`
header that contains the name (for example, `mycookie`) and the value of the cookie to be set.

3. When it receives this HTTP header, the browser creates and stores the specified value as a cookie named
`mycookie`

4. Subsequent page requests to that website contain an `HTTP cookie` header that sends the `name-value`
pair (`mycookie = value`) to the script requested.

5. Upon receipt of a page request with a `cookie` header, PHP automatically creates an entry in the 
`$_COOKIE` array with the name of the cookie `($_COOKIE['mycookie'])` and its value.

Like the `header` function, the `setcookie` function adds HTTP headers to the page, and thus 
`must be called before any of the actual page content is sent`.

Any attempt to call `setcookie` after page content has been sent to the browser will produce a `PHP`
error message. Typically, therefore, we'll use these functions in our controller script before any actual output is sent (by `included PHP template`, for example).

By default, cookies will remain stored by the browser, and thus will continue to be sent with page requests until the browser is closed by the user. If you want the cookie to persist beyond the current browser session, you must set the `expiryTime` parameter, the value of its is known as a `unix timestamp`.

For example, for a cookie set to expire in one hour: `time() + 3600`

> To delete a cookie that has a preset expiry time, change this expiry time 
> to represent a point in the past

```php
// Set a cookie to expire in 1 year
setcookie('mycookie', 'somevalue', time() + 3600 * 24 * 365);

// Delete it
setcookie('mycookie', '', time() - 3600 * 24 * 365);
```

The secure parameter, when set to `1`, indicates that the cookie should be sent only with page requests that happen over a secure (SSL) connection (that is, with a URL that starts with `https://`)

The `httpOnly` parameter, when set to `1`, tells the browser to prevent Javascript code on our site from
seeing the cookie that we're setting.

Example to count the number of times a user has been to our site.

```php
if (!isset($_COOKIE['visits'])) {
  $_COOKIE['visits'] = 0;
}

$visits = $_COOKIE['visits'] + 1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);

if ($visits > 1) {
  echo 'This is visit number ' . $visits;
}
else {
  echo 'Welcome to our website! Click here for a tour';
}
```

Cookies can also be read by anyone who gains access to the computer they're stored on, so cookies are only 
as secure as the computer being used to view the website.

For these reasons, we should do our best to keep the number and size of the cookies our site creates to a minimum.

### 17.2. Sessions

Because of the limitations I’ve just described, cookies are inappropriate for
storing large amounts of information. If we run an ecommerce website that uses
cookies to store items in shopping carts as users make their way through our site,
it can be a huge problem. The bigger a customer’s order, the more likely it will
run afoul of a browser’s cookie restrictions.

`Session` were developed in PHP as the solution to this issue. Instead of storing all data 
as cookies in our visitor's web browser, sessions let us store the data on our web server.

The only value that's stored in the browser is a single cookie containing the user's `session ID` - a long 
string of letters and numbers that serves to identify that user uniquely for the duration of their visit to our site.

It’s a variable for which PHP watches on subsequent page requests, and
uses to load the stored data that’s associated with that session.

Unless configured otherwise, a PHP session automatically sets a cookie in the
user’s browser that contains the session ID. 

The browser then sends that cookie,
along with every request for a page from our site, so that PHP can determine
which of the potentially many current sessions the request belongs to. Using a set
of temporary files that are stored on the web server, PHP keeps track of the
variables that have been registered in each session, along with their values.

Before you can go ahead and use the spiffy `session-management` features in PHP,
we should ensure that the relevant section of our `php.ini` file has been set up
properly.

```php.ini
session.save_handler    = files
session.save_path       = "/tmp"
session.use_cookies     = 1
```

The `php.ini` configuration applies globally to our PHP scripts, and can be stored
on the server in various locations.

To find out the location of the configuration file that’s in use, run this PHP script:

```php
echo phpinfo();
```

To tell PHP to look for a `session ID`, or start a new session if none is found,
we simply call `session_start`. If an existing `session ID` is found when this
function is called, PHP restores the variables that belong to that `session`. Since
this function attempts to create a `cookie`, it must come before any page content is
sent to the browser, just as we saw for `setcookie` above:

```php
session_start();
```

It’s useful to have an understanding of how sessions work behind the scenes.
Once we call `session_start()`, it actually `creates` a `cookie` with a `unique ID` to
represent each `individual` user. For example, the first person on the web page may
be user 1, the second 2, and so on.

Then, when they visit the next page, their ID is sent back to the website, and
when the session is started, all the information stored for that user is retrieved.
For example, all the information stored for ID 1 represents user 1, and the
information for session ID 2 represents user 2.

This allows sessions to keep track of different information for each user of the
website. In practice, IDs aren’t simple sequential numbers like 1, 2 or 3. They’re
complex, difficult to guess strings of seemingly random numbers and letters. If
sessions were easy to guess, hackers could easily pretend to be each user of the
website by changing the ID stored in their session cookie!

After the session has been started, we can treat the `$_SESSION` variable like a
normal array, reading and writing values to it:

```php
$_SESSION['password'] = 'mypassword';
```

To remove a variable from the current session, we can use PHP's `unset` functioni 

```php
unset($_SESSION['password']);
```

Finally, if we want to end the current session and delete all registered variables in
the process, clear all the stored values and use `session_destroy`.

```php
$_SESSION = [];
session_destroy();
```

Count visits with Sessions

```php
session_start();

if (!isset($_SESSION['visits'])) {
  $_SESSION['visits'] = 0;
}

$_SESSION['visits'] = $_SESSION['visits'] + 1;

if ($_SESSION['visits'] > 1) {
  echo 'This is visit number ' . $_SESSION['visits'];
} else {
  // First visit
  echo 'Welcome to my website! Click here for a tour!';
}
```

For the cookie, we needed to calculate the `lifetime` and set an `expiration time`.
`Sessions` are `simpler`: no expiration time is required, but any data stored in the
session is `lost` when the browser is closed.

### 17.3. Access Control

One of the most common reasons for building a database-driven website is that it
allows users to interact with a site from any web browser, anywhere! But in a
world where roaming bands of jubilant hackers will fill our site with viruses and
pornography, we need to stop and think about the security of our website.

In this section, we’ll enhance our joke database site to protect sensitive features
with `username/password-based authentication`. In order to control which users
can do what, we’ll build a sophisticated ` role-based access control` system.

#### 17.3.1. Logging In 

What exactly does `log in the user` mean? There are two approaches to this, both of which involve using PHP `sessions`

- We can log in the uesr by setting a `session variable` as a `flag`. On future requests, we can just 
check if this variable is set and use it to read the `ID` of the `logged-in` user.

- We can store the supplied email address and password in the session, and then on future requests, we can
check if these variables are set. If they are, we can check the values in the `session` against the values in 
the database.

The `first option` will give `better performance`, since the `user's` credentials are only checked once - when the 
login form is submitted.

The second option offers greater security, since the user's credentials are checked against the database 
every time a sensitive page is requested.

In general, the more secure option is preferable, since it allows us to remove
authors from the site even while they’re logged in. Otherwise, once a user is
logged in, they’ll stay logged in for as long as their `PHP session` remains active.
That’s a steep price to pay for a little extra performance

After checking the password was correct using `password_verify`, it’s time to
write some data to the `session`. There are various options here. We could just
store the `user ID` or the `email address` of the person who’s been logged in.

However, it’s good practice to store both the `login name` and `password` in the
`session` and check them both on each page view. That way, if the user is logged in
on two different computers and the password is changed, they’ll be `logged out`
and `required to log back in`.

This is a useful security feature for users, since if one of those logged in locations
were not really the user, someone having managed to get unauthorized access to
their account, the attacker would be logged out as soon as the password was
changed. Without storing the password in the session, the attacker could log in
once, and as long as the browser was left open, they’d maintain access to the
user’s account.

```php
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
```

Then, on each page view, we'd check the information in the session against the database

```php
$author = $authorsTable->find('email', strtolower($_SESSION['email']))[0];

if (!empty($author) && password_verify($_SESSION['password'], $author['password'])) {
  // Display password protected content
}
else {
  // Display an error message and clear the sessioin
  // logging the user out
}
```

This is theoretically what we want to do. With this approach, if the password is
changed in the database, or the author is removed from the database, the user will
be logged out.

Instead of storing the plain text password in the session, it’s better to store the
password hash from the database in the session. If someone is able to read the
`session` data from the server, they’ll only see the `hash`, not the real password

```php
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $author['password'];
```

With the email address and hash stored, we can check the values from the
database, and if either the email address or password stored in the database have
changed, the user can be logged out.

On each page, we’ll need to run this code:

```php
$author = $authorsTable->find(..);

if (!empty($author) && $author[0]['password'] === $_SESSION['password']) {
  ...
}
```

As this check will need to be done on every page we want to password protect,
let’s move it into a class for easy reuse. We’ll need two methods for now:

- One that's called when the user tries to log in with an email address and password
- One that's called on each page to check whether the uesr is logged in or not

Since this is something that’s going to be useful on any website we build, we’ll
place it in the `Ninja` framework namespace:

```php
namespace Ninja;

class Authentication
{
    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn)
    {
        session_start();

        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if (empty($user))
            return false;

        if (!password_verify($password, $user[0][$this->passwordColumn]))
            return false;

        session_regenerate_id();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $user[0][$this->passwordColumn];

        return true;
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (empty($user)) {
            return false;
        }

        if ($user[0][$this->passwordColumn] !== $_SESSION['password']) {
            return false;
        }

        return true;
    }
}
```

When the `Authentication` class is created, it starts the `session`. This avoids us
needing to manually call `session_start` on each page. As long as the
`Authentication` class has been instantiated, a `session` will have been started.
When login or `isLoggedIn` are called, the `session` must have been started.

Both login and `isLoggedIn` return true or false, which we can later call to
determine whether the user has entered valid credentials or is already logged in.

One final security measure that’s worth implementing is changing the `session ID`
after a `successful login`. Earlier I mentioned that session IDs should not easily be
`guessable`. Otherwise, hackers could pretend to be someone else, an attack
commonly known as `session fixation`. All the hacker needs to steal someone else’s
session is the session ID.

It’s good practice to change the `session ID` after a successful login just in case
someone managed to get hold of the `session ID` before the user logged in

If you follow the logic through, you may have realized that `frequently changing
the session ID can increase security`. In fact, it would be very secure to change the
user’s session ID on every page load.

However, doing so causes several practical problems. If someone has different
pages open in different tabs, or the website uses a technology called Ajax, they
effectively get logged out of one tab when they open another! These problems are
worse than the minor security benefit of changing the session ID on every page.

### 17.4. Protected Pages

Currently, we only have the `Joke controller`. The `listJokes` method should be
visible without logging in, but the facility to add, edit or delete a joke should only
be available to users who are logged in.

In this case, a better approach is adjusting the router to perform the login check
and either use the requested route or display an error page.

- Open up `IjdbRoutes.php` and add `'login' => true` to each of the routes that we 
want to secure, `joke/edit` and `joke/delete`.

```php
$routes = [
    'joke/edit' => [
        'POST' => [
            'controller' => $jokeController,
            'action' => 'saveEdit'
        ],
        'GET' => [
            'controller' => $jokeController,
            'action' => 'edit'
        ],
        'login' => true
    ],
    'joke/delete' => [
        'POST' => [
            'controller' => $jokeController,
            'action' => 'delete',
        ],
        'login' => true
    ],
  ]
```

Next, we’ll add a new method, `getAuthentication`. This method will return the
`Authentication` object used by this website. By placing this method here, it
allows us to configure the `Authentication` class differently on different websites.

This object needs to be used in the `EntryPoint` class, but we need to avoid
constructing it there, as the table and column names will be different on each
website we build.

```php
public function getAuthentication() {
  $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

  return new \Ninja\Authentication($authorsTable, 'email', 'password');
}
```

As the `Authentication` class requires an instance of `DatabaseTable` representating the table 
that stores the logins, I've copied the line that creates the `$authorsTable` project.

It's better to have a single instance representing the `$authors` table. To achieve that, move the construction
of the `database` table into the constructor and store it in a class variable

```php
class IjdbRoutes implements Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $this->authentication = new Authentication($this->authorsTable, 'email', 'password');
    }

    public function getAuthentication()
    {
        return $this->authentication;
    }
}
```

### 17.5. Interfaces and Return Types

> An interface like this is very useful if we're writing code we want others to build
> on. The interface can act as documentation and give other developers instructions to follow.
> By writing their code to fit our interface, it will work correctly with our class

```php
namespace Ninja;

interface Routes
{
    public function getRoutes(): array;
    public function getAuthentication(): \Ninja\Authentication;
}
```

Interfaces are a very powerful but `under-utilized` tool that act as bridge between `framework` code and 
`project-specific` code.

An `interface` describes some gaps in the framework code that need to be `filled` by 
the project-specific code. Each project can then fill those gaps with code that's 
specific to the individual website being built.

### 17.6. Making use of the `Authentication` class

In `EntryPoint.php`, add a check that looks for the `login` key in the route array. 
If it's set, and it's set to true, and the user is not logged in, redirect to a login page. 
Otherwise, display the page as normal.

```php
if (isset($routes[$this->route]['login']) && !$authentication->isLoggedIn()) {
  header('Location: /login/error');
}
else {
  //
}
```

### 17.7. Login Error Message

Create new `template file` in `templates` folder 

```html
<h2>You are not logged in</h2>

<p>You must be logged in to view this page.
    <a href="/login">Click here to log in</a>
    or
    <a href="/author/register">Click here to register an account</a>
</p>
```

Create new controller `Login.php` in the `Ijdb\Controllers` directory

```php
namespace Ijdb\Controllers;

class Login
{
    public function error()
    {
        return [
            'template' => 'logginerror.html.php',
            'title' => 'You are not logged in'
        ];
    }
}
```

Add new route to `IjdbRoutes.php`

```php
namespace Ijdb;

use Ninja\DatabaseTable;
use Ijdb\Controllers\Joke;
use Ijdb\Controllers\Login;
use Ijdb\Controllers\Register;
use Ninja\Authentication;
use Ninja\Routes;

class IjdbRoutes implements Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $this->authentication = new Authentication($this->authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokeController = new Joke($this->authorsTable, $this->jokesTable);
        $authorController = new Register($this->authorsTable);
        $loginController = new Login();

        $routes = [
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
            ]
        ];

        return $routes;
    }
}
```

If we visit any page where `login` is set to `true` in the `$routes` array, we'll see the 
`error page`. By adding `'login' => true` to a route, we now have a quick and easy method
of `restricting` access to page, and we don't need to perform this check in `every controller action`.

### 17.8. Creating a Login Form

We already created the `Login` controller, and we'll need to add two methods - one for displaying
the form, and one for handling the submission.

As the login form will need to call the `Login` method we created in the `Authentication`
class, it will need the `Authentication` class as a constructor argument and class variable

```php
namespace Ijdb\Controllers;

class Login
{
    private $authentication;

    public function __construct(\Ninja\Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function loginForm()
    {
        return [
            'template' => 'login.html.php',
            'title' => 'Log In'
        ];
    }

    public function error()
    {
        return [
            'template' => 'loginerror.html.php',
            'title' => 'You are not logged in'
        ];
    }

    public function processLogin()
    {
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            header('location: /login/success');
            exit();
        }

        return [
            'template' => 'login.html.php',
            'title' => 'Log In',
            'variables' => [
                'error' => 'Invalid username/password'
            ]
        ];
    }

    public function success()
    {
        return [
            'template' => 'loginsuccess.html.php',
            'title' => 'Login Successful'
        ];
    }
}
```

Add new routes 

```php
class IjdbRoutes implements Routes
{
    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $this->authorsTable = new DatabaseTable($pdo, 'author', 'id');
        $this->authentication = new Authentication($this->authorsTable, 'email', 'password');
    }

    public function getRoutes(): array
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokeController = new Joke($this->authorsTable, $this->jokesTable);
        $authorController = new Register($this->authorsTable);
        $loginController = new Login($this->authentication);

        $routes = [
            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
            ],
            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
            ],
            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
                ],
                'login' => true
            ]
        ];

        return $routes;
    }
}
```
### 17.9. Logging Out

Display `login` and `logout` status on `Navbar`. So, we will need to `pass` status to `layout.html.php`

```php
echo $this->loadTemplate('layout.html.php', [
  'loggedIn' => $authentication->isLoggedIn(),
  'output' => $output,
  'title' => $title
]);
```

Open up `layout.html.php` and display the navbar based on status

```php
<ul>
  <?php if ($loggedIn): ?>
    <li><a href="/logout">Log Out</a></li>
  <?php else: ?>
    <li><a href="/login">Log In</a></li>
</ul>
```

Create `logout action`

```php
public function logout() {
  unset($_SESSION);
  session_destroy();

  return [
    'template' => 'logout.html.php',
    'title' => 'You have been logged out'
  ];
}
```

`unset($_SESSION)` will remove any data from the current `session`, logging the user out.

Add new `route`

```php
'logout' => [
  'GET' => [
    'controller' => $loginController,
    'action' => 'logout'
  ]
]
```

And `logout template`

```html
<h2>Logged Out</h2>

<p>You have been logged out</p>
```

### 17.10. Assigning Added Jokes to the Logged-in User

Add the `getUser` method to `Authentication` class

```php
public function getUser() {
  if ($this->isLoggedIn()) {
    return $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
  }
  else {
    return false;
  }
}
```

Edit `JokeController` and to `use` the `Authentication` class

```php
use \Ninja\Authentication;

public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, Authentication $authentication)
{
  $this->authentication = $authentication;
}
```

Add the `saveEdit` method in the `Joke` controller currently contains this code

```php
public function saveEdit() {
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();
  $joke['authorid'] = $author['id'];

  $this->jokesTable->save($joke);

  header('location: /joke/list');
}
```

### 17.11. User Permissions

Let's add some checks to the site that prevent users from being able to add or edit 
each other's jokes.

The first thing to do is hide the `edit` and `delete` buttons from the joke list for jokes
that don't belong to the logged-in user.

Edit `list action` in `Joke controller`

```php
public function list()
{

  $author = $this->authentication->getUser()

  return [
    'template' => 'jokes.html.php',
    'title' => $title,
    'variables' => [
      'totalJokes' => $totalJokes,
      'jokes' => $jokes,
      'userId' => $author['id'] ?? null
    ]
  ];
}
```

In `jokes` template, we add condition for rendering

```php
<?php if ($userId == $joke['authorId']): ?>
  // Display edit and delete button 

<?php else: ?>

<?php endif; ?>
```

### 17.12. Check User - Secured

Check if user have the right in `edit` action

```php
public function edit()
{
    $author = $this->authentication->getUser();

    $title = 'Create New Joke';

    if (isset($_GET['jokeid'])) {
        $joke = $this->jokesTable->findById($_GET['jokeid']);
        $title = 'Edit Joke';
    }

    return [
        'template' => 'editjoke.html.php',
        'title' => $title,
        'variables' => [
            'joke' => $joke ?? null,
            'userid' => $author['id'] ?? null
        ]
    ];
}
```

Conditional rendering in `edit template`

```php
<?php if ($userid == $joke['authorid']) : ?>
    <form action="" method="POST">
        <input type="hidden" name="joke[id]" value="<?= $joke['id'] ?? '' ?>">
        <label for="joketext">Type your joke here: </label>
        <textarea name="joke[joketext]" id="joketext" cols="40" rows="3"><?= $joke['joketext'] ?? '' ?></textarea>
        <input type="submit" value="<?= isset($joke) && $joke['id'] ? 'Update' : 'Create' ?>">
    </form>
<?php else : ?>
    <p>You may only edit jokes that you posted.</p>
<?php endif; ?>
```

## 18. Reltionships

`SQL JOIN` is one of mny solutions to this problem of finding relevant information from `2` tables.
Although there are performance advantages to using `JOIN`, unfortunately `JOIN`s don't work well
with object-oriented programming. The `relational` approach used by databases is generally incompatible 
with the nested structure of `object-oriented programming`.

In `object-oriented` programming, objects are stored in a `hierarchical structure`. An
author `contains` - or, in the correct OOP terminology, `encapsulates` a list of their
jokes, and a category also encapsulates a list of the jokes within the category

In `SQL`

```sql
SELECT atuhor.name, joke.id, joke.joketext
FROM author 
INNER JOIN joke on joke.authorId = author.id
WHERE authorId = 123
```

In `OOP`

```php
// Find the author with the id of `123`
$author = $authors->findById(123);

// Get all the jokes by this author
$jokes = $author->getJokes();

// Print the text of the first joke by that author
echo $jokes[0]->joketext;
```

Notice that there’s no SQL here. The data is coming from the database, but it all
happens `behind the scenes`.

We could fetch all the information by using the SQL query I provided above, but
this `doesn’t work well` with the `DatabaseTable` class we’ve used so far. It would
be very difficult to design the class in such a way that it would account for every
possible set of relationships we may want.

- `relational` way of dealth with the `relationship` between `jokes` and `authors`

```php
// Find the author with the ID 123
$author = $this->authors->findById(123)

// Now find all the jokes posted by the author with that ID
$jokesByAuthor = $this->jokes->find('authorId', $authorId);
```

This run `two seperate` `SELECT` queries, and the two `DatabaseTable` instances are entirely separate.

> Whoever writes this code `must know` about the underlying structure of the `database` and
> that the `authors` and `jokes` are stored in a `relatioinal` way.

In `object-oriented` programming, it's preferable to `hide` the `underlying` implementation, and the 
code above would be expressed like this

- `oop` way of dealth with the `relationship` between `jokes` and `authors`

```php
public function saveEdit()
{
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $author->addJoke($joke);

  header('location: /joke/list');
}
```

> The person who writes this code `doesn't` have to know anything about what hapens behind the scenes,
> or how the `relationship` is modeled in the `database`.

Instead of `modeling the relationships in a relational way`, object-oriented
programming takes a `hierarchical approach`, using data structures. Just as the
routes in the `IjdbRoutes` class is a `multi-dimensional array`, OOP has `multidimensional` data structures stored within `objects`.

In the example above, the `$author->addJoke($joke)` method call might be
writing the joke data to a `database`. Alternatively, it might be saving the data to a
`file`. And that file could be in `JSON format`, `XML format` or an `Excel spreadsheet`.
The developer who writes this `saveEdit` method `doesn’t need to know` anything
about the underlying storage `mechanism—how data is being stored—but` only
that the data is being stored somehow, and that it’s being stored inside the author
instance.

In `object-oriented programming` terminology, this is known as **implementation
hiding**, and it has several `advantages`. Different people can work on different
sections of the code. The developer who writes the `saveEdit` doesn’t have to be
familiar with how `addJoke` actually works. They only need to know that it saves
data, and that the data can be retrieved later.

You only need to know what the
method returns and what arguments it requires. We can imagine what the
following lines of code do, knowing how each of them works:

```php
$jokes = $author->getJokes();

$joke->getAuthor()->name;

$joke = $_POST['joke'];
$joke['jokedate'] = new \DateTime();

$author->addJoke($joke);
```

> This approach to splitting up the logic is loosely known as `separation of concerns`.
> The process of saving a joke is different from the process of writing data to the database
> Each of these is a different concern.
> By splitting out the two concerns, you have a lot more flexibility.

> This added flexibility is incredibly useful for an increasingly popular 
> development methodology called `test-driven development (TDD)`

### 18.1. Object Relational Mappers

The `DatabaseTable` class we've built step by step so far is a type of library called an `object relational mapper`
or (`ORM`). 

There are a lot of ORM implementations avaiable
- Doctrine
- Propel
- ReadBeanPHP

Thease all do essentially the same job as the `DatabaseTable` class we've been building:
- Providing an `OOP` interface for a `relational database`
- Bridge the gap between `SQL` and `PHP` code

> Generally, `ORM`s deal with `Objects`.

```php
$author = $authors->findById(123);
echo $author['name'];
```

Here, the `$author` variable is an array with keys for each of the columns in the database. 
`Arrays` can't contain functions, so implementing an `addJoke` method on the `$author` instance 
isn't possible. So we need an `Entity class`

```php
namespace Ijdb\Entity;

class Author {
  public $id;
  public $name;
  public $email;
  public $password;
}
```

A class like this, which is designed to `map directly` to a record in the database, is commonly 
known as an `Entity Class`, which is why I've used the name `Entity` in the `namespace`.

Create the directory `Entity` inside the `Ijdb` folder and save the class inside it with the name `Author.php`

> There's some repetition here: every time you add a column to the `database table`, 
> you'll need to add it to this entity class. 
> Because of this, many `ORM`s provide a method of generating these entity classes from the 
> database schema, or even creating the database table from the `object`!

Nine times out of ten—in fact, ninety-nine times out of a hundred—public
properties are the wrong solution to any given problem. However, if the
responsibility of the class is to represent a `data structure`, and it’s `interchangeable`
with an `array`, then `public` properties are fine.

### 18.2. Methods in Entity Classes

A class is used to store the data about `authors` instead of an `array`, because the class can contain `methods`,
and we can do things like this

```php
// Find the author with the id 1234
$author = $this->authorsTable->findById('1234');

// Find all the jokes by that author
$author->getJokes();

// Add a new joke and associate it with the author
// represented by `$author`
$author->addJoke($joke);
```

Let's take a moment to think about waht the `getJokes` method might look like. 
Assuming the `id` property in the `$author` class is set, it would be possible to do this 

```php
public function getJokes() {
  return $this->jokesTable->find('authorid', $this->id);
}
```

The `author` class needs access to the `jokesTable` instance of the `DatabaseTable` class.

```php
namespace Ijdb\Entity;

use Ninja\DatabaseTable;

class Author
{
    public $id;
    public $name;
    public $email;
    public $password;

    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable)
    {
        $this->jokesTable = $jokesTable;
    }

    public function getJokes()
    {
        return $this->jokesTable->find('authorid', $this->id);
    }
}
```

We're going to amend the `DatabaseTable` class to return an instance of this class instead of 
an array. But before we do that, let's take a look at how the `Author` class can be used on its own

```php
$jokesTable = new DatabaseTable($pdo, 'joke', 'id');

$author = new Author($jokesTable);

$author->id = 123;

$jokes = $author->getJokes();
```

Next, the `addJoke` method

```php
public function addJoke($joke)
{
    $joke['authorid'] = $this->id;
    $this->jokesTable->save($joke);
}
```

### 18.3. Using `Entity` classes from the `DatabaseTable` class

Currently `saveEdit` method

```php
public function saveEdit() {
  $authorsObject = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $authorsObject->addJoke($joke);

  header('location: /joke/list');
}
```

This currently don't work `because` the `getUser` is returned an `array` instead of `an object`.

The first thing we need to do is `edit the getUser` method so that it returns the `Author Entity`.

```php
public function getUser()
{
    if (!$this->isLoggedIn()) {
        return false;
    }

    $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
    return $user;
}
```

And the `find` method in `DatabaseTable ORM` is currently return an `array`

```php
public function find($column, $value)
{
    $sql = "SELECT * FROM `{$this->table}` WHERE `$column` = :value";

    $parameters = [
        'value' => $value
    ];

    $query = $this->query($sql, $parameters);

    return $query->fetchAll();
}
```

Here, `$query->fetchAll()`, and `$query->fetch()` return an `array`. Luckily for us, there's also
`fetchObject` method, which returns an instance of a specified class - in our case, `Author`.

This will instruct `PDO` to create `an instance` of the `Author` class and set the properties on that, 
rather than returning a simple array.

```php
return $query->fetchObject('Author', [$jokesTable]);
```

There are `two` arguments here

- `The name` of the class to instantiate
- `An array` of arguments to `provide` to the `constructor` when the object is created. Because 
there's only a single element in the array, `[$jokesTable]` looks a little strange. However, as `constructors`
can have multiple arguments, `an array` is required so you can `provide` each constructor argument

```php
$pdo->query('SELECT * FROM `author` WHERE id = 123');

$author = $pdo->fetchObject('Author', [$jokesTable]);
```

We can't amend the `DatabaseTable` class to use the `return` line above

- It doesn't have access to the `$jokesTable` variable
- `DatabaseTable` is a `framework class`

Instead of hardcoding the `class name` and `constructor argument`, we can amend the `constructor` of 
the `DatabaseTable` class to take `two` optional argumets

- `The name` of the class to create
- `Arguments` list provide to the `class`

```php
class DatabaseTable {
  private $pdo;
  private $table;
  private $primaryKey;
  private $className;
  private $constructorArgs;

  public function __construct(
    \PDO $pdo,
    string $table,
    string $primaryKey,
    string $className = '\stdClass',
    array $constructorArgs = []
  ) {
    $this->pdo = $pdo;
    $this->table = $table;
    $this->primaryKey = $primaryKey;
    $this->className = $className;
    $this->constructorArgs = $constructorArgs;
  }
}
```

- `stdClass` class is `an inbuilt` PHP empty class that can be used for simple `data storage`.

Change the `findById method`

```php
public function findById($value) {
  $query = "SELECT * FROM `{$this->table}` WHERE `{$this->primaryKey}` = :value";

  $parameters = [
    'value' => $value
  ];

  $query = $this->query($query, $parameters);
  return $query->fetchObject($this->className, $this->constructorArgs);
}
```

The `fetchAll` method can also be `instructed` to return `an object` by providing `\PDO::FETCH_CLASS` as 
the first argument, the `class name` as the second, and the `constructor arguments` as the third

```php
return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
```

Now, we cah change the way `DatabaseTable` class is instantiated

```php
$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');

$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [$this->jokesTable]);
```

Now, we can get the `saveEdit method` working like this

```php
public function saveEdit()
{
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $author->addJoke($joke);

  header('location: /joke/list');
}
```

Then, we must to fix the `Authentication` class to use `an object` rather than `an arrray`

```php
$passwordColumn = $this->passwordColumn;

if (!empty($user) && $user[0]->$passwordColumn === $_SESSION['password']) {
  // User logged in
}
```

Using `braces`

> As an alternative to creating a new variable, you can also use braces to tell PHP
> to evaluate the `$this->passwordColumn` lookup first

```php
$user[0]->{$this->passwordColumn};
```

Then, we can do the same thing with `login method`

```php
public function login($username, $password) 
{
  $user = $this->users->find($this->usernameColumn, strtolower($username));

  if (emtpy($user)) 
    return false;

  $saved_password = $user[0]->{$this->passwordColumn};
  if (!password_verify($password, $saved_password))
    return false;

  session_regenerate_id();
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $user[0]->{$this->passwordColumn};

  return true;
}
```

### 18.4. `Joke` Objects

Fix the code in `list method`

```php
$author = $this->authorsTable->findById($joke->authorId);

$jokes[] = [
  'id' => $joke->id,
  'joketext' => $joke->joketext,
  'jokedate' => $joke->jokedate,
  'name' => $author->name,
  'email' => $author->email
]

return [
  'template' => 'jokes.html.php',
  'title' => $title,
  'variables' => [
    'totalJokes' => $totalJokes,
    'jokes' => $jokes,
    'userId' => $author->id ?? null
    ]
  ];
```

Although this `solution works`, now that we're using an `object-oriented approach`, it can be
solved in a much nicer way. Currently, each value from either the `author` or `joke` table is
stored under an `equivalent` key in the `$jokes` array

The code for generating the `$jokes` array looks like this

```php
public function list()
{
  $result = $this->jokesTable->findAll();

  $jokes = [];
  foreach ($result as $joke) {
    $author = $this->authorsTable->findById($joke->authorid);

    $jokes[] = [
      'id' => $joke->id,
      'joketext' => $joke->joketext,
      'jokedate' => $joke->jokedate,
      'name' => $author->name,
      'email' => $author->email
    ];
  }
}
```

The process currently looks like this

- `query` the database and `select all the jokes`
- `loop over` each `joke`
  - select the `related author`
  - create a new aray containing all the information about the `joke` and the `author`
- pass this `constructed array` to the template for `display`

This is a `very long-winded process` for something we can make a lot simpler using `OOP`

At the moment, we can `fetch all` the `jokes` by a specific `author` using `$author->getJokes()`.
However, we can also `model` the `inverse relationship` and do something like this

```php
echo $joke->getAuthor()->name;
```

Firstly, let's create the `Joke` entity class in `Ijdb/Entity/Joke.php`

```php
namespace Ijdb\Entity;

class Joke
{
  public $id;
  public $authorId;
  public $jokedate;
  public $joketext;

  private $authorsTable;

  public function __construct(\Ninja\DatabaseTable $authorsTable)
  {
    $this->authorsTable = $authorsTable;
  }

  public function getAuthor()
  {
    return $this->authorsTable->findById($this->authorId);
  }
}
```

### 18.5. Using the `Joke` class

First, we need to update the `IjdbRoutes`

```php
$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [$this->authorsTable]);
$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [$this->jokesTable]);
```

> Think about that for a second. It poses a problem that's not immediately obvious

If the `authorsTable` instance constructor requires an instance of `jokesTable`, and 
the `jokesTable` constructor requires an `authorsTable` instance, we have a `catch-22`

- To create the `jokesTable` instance, you need an existing `authorsTable` instance
- To create the `authorsTable` instance, you need an existing `jokesTable` instance

> Both instances require the other instance to exist before they do!

> This `catch-22` occurs sometimes in `object-oriented programming`. Luckily, in this case
> it can be fairly easily solved using something called a `reference`

### 18.6. References (Pointer)

To create a reference, you prefix the variable you want to create a reference to with an `ampersand &`

```php
$originalVariable = 1;
$reference = &$originalVariable;
$originalVariable = 2;
echo $reference;
```

It allows us to solve the `catch-22` we encoutered ealier. By providing references as the constructor arguments
for the `Joke` and `Author` classes, by the time the `authorsTable` and `jokesTable` instances are needed,
they'll have been created

```php
$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id', '\Ijdb\Entity\Joke', [&$this->authorsTable]);
$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id', '\Ijdb\Entity\Author', [&$this->jokesTable]);
```

Now, when the `DatabaseTable` class creates a `Joke` or `Author` object and has to provide it the `authorsTable`
or `jokesTable` instance, it will read what's stored in the `authorsTable` or `jokesTable` class variables
at the tiime any `Author` or `Joke` entity is instantiated.

### 18.7. Simplifying the `List Controller Action`

```php
public function list() 
{
  $jokes = $this->jokesTable->findAll();

  return [
    'variables' => [
      'jokes' => $jokes
    ]
  ];
}
```

Rather than fetching the `author` in the `controller`, we can now do it in the template `jokes.html.php`

```php
$joke->getAuthor()->name;
$joke->getAuthor()->email;
```

Now, the controller just provides a `list of jokes`. The `template` can now read any of the values
it needs, including information about the `author`. If we added a `new column` in the `database`, we 
could amend the `template` to show this value without needing to change the controller.

### 18.8. Tidying Up

Fixing the `Edit Joke` page.

```php
if (empty($joke->id) || $userid == $joke->authorId) {}
```

We've now go an almost entirely object-oriented website! All the entities have their own class, and we can 
add any methods we like to each entity class.

### 18.9. Caching

```php
echo $joke->getAuthor()->name;
echo $joke->getAuthor()->email;
echo $joke->getAuthor()->password;
```


> Querying the database is considerably slower than just reading a value from a variable.
> Each time a query is sent to the database, it will slow down the page's speed slightly. 
> Although each query adds onl a tiny overhead, if this is done insde a loop on a page, it 
> can cause a noticeable slowdown.

To avoid this problem, you can fetch the author object once, then use the existing instance

```php
$author = $joke->getAuthor();
echo $author->name;
echo $author->email;
echo $author->password;
```

Instead, it's better to implement a technique called `transparent caching`. 

> The term `caching` refers to storing some data for quicker access later on, and the technique I'm
> about to show you is called `transparent caching` because the person using class doesn't even need 
> to know it's happening!

To implement caching, add a property to the `Joke` entity class to store the `author` between 
`method` calls

```php
class Joke {
  public $joketext;
  private $authorsTable;
  private $author;
}

public function getAuthor()
{
  if (empty($this->author)) {
    $this->author = $this->authorsTable->findById($this->authorid);
  }

  return $this->author;
}
```

Now, the following code will only send a single query to the database

```php
echo $joke->getAuthor()->name;
echo $joke->getAuthor()->email;
echo $joke->getAuthor()->password;
```

### 18.10. Joke Categories

Let's add a new relationship.

Firstly, let's create the table to store the categories

```sql
CREATE TABLE `category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
);
```

Create a new controller called `Category` in `Ijdb/Controllers/Category.php`

```php
namespace Ijdb\Controllers;

class Category
{
    private $categoriesTable;

    public function __construct(DatabaseTable $categoriesTable)
    {
        $this->categoriesTable = $categoriesTable;
    }

    public function edit()
    {
        $title = 'Create new category';

        if (isset($_GET['id'])) {
            $category = $this->categoriesTable->findById($_GET['id']);
            $title = 'Edit category';
        }

        return [
            'template' => 'editcategory.html.php',
            'title' => $title,
            'variables' => [
                'category' => $category ?? null
            ]
        ];
    }

    public function saveEdit()
    {
        $category = $_POST['category'];

        $this->categoriesTable->save($category);

        header('location: /category/list');
        exit();
    }

    public function list()
    {
        $categories = $this->categoriesTable->findAll();

        $title = 'Joke Categories';

        return [
            'template' => 'categories.html.php',
            'title' => $title,
            'variables' => [
                'categories' => $categories
            ]
        ];
    }

    public function delete()
    {
        $this->categoriesTable->delete($_POST['id']);

        header('location: /category/list');
        exit();
    }
}
```

Add `routes` in `IjdbRoutes`

```php

public function __construct()
{
 $this->categoriesTable = new DatabaseTable($pdo, 'category', 'id'); 
}

public function getRoutes()
{
  $categoryController = new Category($this->categoriesTable);

  $routes = [
    'category/edit' => [
        'POST' => [
            'controller' => $categoryController,
            'action' => 'saveEdit'
        ],
        'GET' => [
            'controller' => $categoryController,
            'action' => 'edit'
        ],
        'login' => true
    ],
    'category/list' => [
        'GET' => [
            'controller' => $categoryController,
            'action' => 'list'
        ],
        'login' => true
    ],
    'category/delete' => [
        'POST' => [
            'controller' => $categoryController,
            'action' => 'delete'
        ],
        'login' => true
    ]
  ];
}
```

### 18.11. Assigning `Jokes` to `Categories`

Create `lookup table`

```SQL
CREATE TABLE `joke_category` (
  `jokeid` INT NOT NULL,
  `categoryid` INT NOT NULL,
  PRIMARY KEY (`jokeid`, `categoryid`)
);
```

Create `Category Controller`

```php
namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Category
{
    private $categoriesTable;

    public function __construct(DatabaseTable $categoriesTable)
    {
        $this->categoriesTable = $categoriesTable;
    }

    public function edit()
    {
        $title = 'Create new category';

        if (isset($_GET['id'])) {
            $category = $this->categoriesTable->findById($_GET['id']);
            $title = 'Edit category';
        }

        return [
            'template' => 'editcategory.html.php',
            'title' => $title,
            'variables' => [
                'category' => $category ?? null
            ]
        ];
    }

    public function saveEdit()
    {
        $category = $_POST['category'];

        $this->categoriesTable->save($category);

        header('location: /category/list');
        exit();
    }

    public function list()
    {
        $categories = $this->categoriesTable->findAll();

        $title = 'Joke Categories';

        return [
            'template' => 'categories.html.php',
            'title' => $title,
            'variables' => [
                'categories' => $categories
            ]
        ];
    }

    public function delete()
    {
        $this->categoriesTable->delete($_POST['id']);

        header('location: /category/list');
        exit();
    }
}
```

Create new `routes`

```php
public function __construct()
{
  $this->categoriesTable = new DatabaseTable($pdo, 'category', 'id');
}

public function getRoutes()
{
 $categoryController = new Category($this->categoriesTable);

 $routes = [
  'category/edit' => [
      'POST' => [
          'controller' => $categoryController,
          'action' => 'saveEdit'
      ],
      'GET' => [
          'controller' => $categoryController,
          'action' => 'edit'
      ],
      'login' => true
  ],
  'category/list' => [
      'GET' => [
          'controller' => $categoryController,
          'action' => 'list'
      ],
      'login' => true
  ],
  'category/delete' => [
      'POST' => [
          'controller' => $categoryController,
          'action' => 'delete'
      ],
      'login' => true
  ]
 ];
}
```

Display list of `categories checkbox` in `edit joke form`

```php
public function __construct()
{
  $jokeController = new Joke(
      $this->authorsTable,
      $this->jokesTable, 
      $this->categoriesTable, 
      $this->authentication
    );
}

public function edit()
{
  $categories = $this->categoriesTable->findAll();

  return [
    'variables' => [
      'categories' => $categories
    ]
  ];
}
```

In `editjoke.html.php`

```php
  <?php foreach ($categories as $category) : ?>
      <input type="checkbox" name="category[]" id="<?= $category->id ?>" value="<?= $category->id ?>">
      <label for="<?= $category->id ?>"><?= $category->name ?></label>
  <?php endforeach; ?>
```


Add new `instance of JokeCategory` table

```php
   $this->jokeCategoriesTable = new DatabaseTable($pdo, 'joke_category', 'categoryid');
```

Now we need to change the `saveEdit` method to handle new data from the form submission.

We could pass the `jokeCategoriesTable` instance to the `Joke` controller.
However, it's better to implement this using an `object-oriented approach`, where a joke is added to a 
category using this code

```php
$joke->addCategory($categoryId);
```

To do this, we'll need a `Joke` entity instance in the `saveEdit` method in the `JokeController`. 
The code for updated `saveEdit` method will look like this

```php
public function saveEdit()
{
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $jokeEntity = $author->addJoke($joke);

  foreach ($_POST['category'] as $categoryId) {
    $jokeEntity->addCategory($categoryId);
  }

  header('Location: /joke/list');
}
```

We need to modify the `addJoke method` so that it return a `Joke entity` instead of `void`.

As a first thought, a simple approach would be to fetch the joke from the `jokesTable`
instance after it's been created, using the following process

- Take the data for the new joke from `$_POST`
- Pass it to the `addJoke` method in the `Author` entity class
- Retrieve the newly added `joke` from the database using a `SELECT` query (or the `findById` method)

Example

```php
public function addJoke($joke)
{
  $joke['authorid'] = $this->id;

  $this->jokesTable->save($joke);

  return $this->jokesTable->findById($id);
}
```

There are `two problems` with this

- We `don't know what the newly created jokes'id is`
- It adds additional overhead. We're actually making two trips to the databse
  - once to run an `INSERT` query to send the data about the new `joke`
  - then a `SELECT` query to fetch that vry same information back out of the database immediately afterwards

Instead, we can move this logic to the `save` method in `DatabaseTable` class.
The first thing we need to do is create an instance of the relevant `entity`

```php
$entity = new $this->className(...$this->constructorArgs);
```

For example

```php
$joke = new \Ijdb\Entity\Joke($authorsTable);
```

The `className`, `\Ijdb\Entity\Joke` is stored in the `$this->className` variable, so the above could be 
expressed like this

```php
$joke = new $this->className($authorsTable);
```

However, each entity class has different `arguments` and, potentially, a different `number of arguments`.
The `... operator` , known as the `argument unpacking operator` or `splat operator`, allows specifying `an 
array` in place of `several arguments.`

For example, consider this code

```php
$array = [1, 2];

someFunction(...$array);
```

It's the same as this

```php
someFunction(1, 2);
```

Now, the `save` method will look like this

```php
public function save($record)
{
  $entity = new $this->className(...$this->constructorArgs);

  try {
    if ($record[$this->primaryKey] == '') {
      $record[$this->primaryKey] = null;
    }

    $this->insert($record);
  }
  catch (\PDOException $e) {
    $this->update($record);
  }

  foreach ($record as $key => $value) {
    if (!empty($value)) {
      $entity->$key = $value;
    }
  }

  return $entity;
}
```

> Converting Arrays to Object
> This approach is a common method of converting an array to an object

This will work fine for `records being updated`.

A newly created record, however, will now have the `primary key set`. In fact, we couldn't pass the `id`
even if we wanted to, as we don't know what it will be before the record has been created in the `database`.

The `id` primary key is actually created by `MYSQL` inside the database. Luckily, the `PDO` library provides
a very simple method of doing this. After an `INSERT` query has been sent to the database, you can call
the `lastInsertId` method on the `PDO` instance to read the `ID` of the last record inserted.

So, we need to modify the `insert` method to `retrieve` the `newly created id`

```php
public function insert($fields)
{
  $query = '';
  $this->query($query, $fields);

  return $this->pdo->lastInsertId();
}
```

Now, the `save method` can read this value and set the `primary key` on the `created entity object`

```php
public function save($record)
{
  $entity = new $this->className(...$this->constructorArgs);

  try {
    if ($record[$this->primaryKey] == '') {
      $record[$this->primaryKey] = null;
    }

    $insertId = $this->insert($record);
    $entity->{$this->primaryKey} = $insertId;
  }
  catch (\PDOException $e) {
    $this->update($record);
  }

  foreach ($record as $key => $value) {
    if (!empty($value)) {
      $entity->$key = $value;
    }
  }

  return $entity;
}
```

The `save` method is now complete. Any time the `save` method is called, it will return 
an `entity instance` representing the record that's just been saved.

Then, the code for `addJoke` look like this

```php
public function addJoke($joke)
{
  $joke['authorid'] = $this->id;

  return $this->jokesTable->save($joke);
}
```

### 18.12. Assigning Categories to Jokes

We can amend the `saveEdit` method in the `Joke controller` to look like this

```php
public function saveEdit()
{
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $jokeEntity = $author->addJoke($joke);

  foreach ($_POST['category'] as $categoryId) {
    $jokeEntity->addCategory($categoryId);
  }

  header('location: /joke/list');
}
```

So, we need to make some changes to the `Joke` entity class

As the `addCategory` method will write a record to the new `joke_category` table, it
will need a reference to the `jokeCategories DatabaseTable` instance.
You know the drill here: `add a class variable and constuctor argument`

```php
namespace Ijdb\Entity;

class Joke {
  public $id;
  public $authorId;
  public $jokedate;
  public $joketext;

  private $authorsTable;
  private $author;
  private $jokeCategoriesTable;

  public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $jojkeCategoriesTable) {
    $this->authorsTable = $authorsTable;
    $this->jokeCategoriesTable = $jokeCategoriesTable;
  }
}
```

Then amend `IjdbRoutes` to provide the instance as `an argument` to the `constructor` of the `$jokesTable` instance

```php
$this->jokesTable = new \Ninja\DatabaseTable(
  $pdo,
  'joke',
  'id',
  '\Ijdb\Entity\Joke',
  [
    &$this->authorsTable,
    &$this->jokeCategoriesTable
  ]
);
```

Next, add the `addCategory` method to the `Joke` entity class

```php
public function addCategory($categoryId)
{
  $jokeCat = [
    'jokeid' => $this->id,
    'categoryId' => $categoryId
  ];

  $this->jokeCategoriesTable->save($jokeCat);
}
```

### 18.13. Displaying Jokes by Category

Now that we have jokes in the database that are assigned to a category, let's add a page that allows
selecting jokes by category.

On the `Joke list` page, let's add a list of categories to allow filtering of the `jokes`

The first part is fairly simpe: we need a list of categories as links on the `Joke List` page. This 
involves two fairly simple steps

1. Amend the `lsit` action to pass a list of categories to the template

```php
public function list()
{
  $jokes = $this->jokesTable->findAll();
  $author = $this->authentication->getUser();
  $categories = $this->categoriesTable->findAll();

  return [
    'variables' => [
      'jokes' => $jokes,
      'userId' => $author->id ?? null,
      'categories' => $categories
    ]
  ];
}
```

2. Loop through the categories in the `jokes.html.php` template and create a list with links for each one

```php
<ul class="categories">
  <?php foreach ($categories as $category): ?>
    <li><a href="/joke/list?category=<?= $category->id ?>"><?= $category->name ?></a></li>
  <?php endforeach; ?>
</ul>
```

That's the list done, but the links currently don't do anything. Each link sets a `$_GET` variable called
`category` to the `ID` of the category we want to view. 
If you click on one of the new category links, you'll see the page you visit is `/jokes/list?category=1` or similar.

we have a `many-to-many` relationship, it's not quite so simple. One option is to pass the `jokeCategoriesTable`
to the controller and do something like this

```php
if (isset($_GET['category'])) {
  $jokeCategories = $this->jokeCategoriesTable->find('categoryid', $_GET['category']);

  $jokes = [];

  foreach ($jokeCategories as $jokecategory) {
    $jokes[] = $this->jokesTable->findById($jokecategory->jokeid);
  }
}
else {
  $jokes = $this->jokesTable->findAll();
}
```

I haven't give you the code for this because it's not a `greate solution`. One of the most difficulut
parts of programming is placing code in the right place. The logic above is `correct`. It works,
and it was fairly simple to work out. However, it would be better if we could get a list of `jokes`
from a `category` like this.

```php
$category = $this->categoriesTable->findById($_GET['category']);

$jokes = $category->getJokes();
```

Doing so would allow us to get a `list of jokes` from a category anywhere in the program, not just the 
`list` method.

So, the first thing we will need is a `Category` entity class that has access to the `jokesTable` instance,
the `jokeCategoriesTable` instance, and has a method called `getJokes`

```php
namespace Ijdb\Entity;

use Ninja\DatabaseTable;

class Category
{
    public $id;
    public $name;

    private $jokesTable;
    private $jokeCategoriesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $jokeCategoriesTable)
    {
        $this->jokesTable = $jokesTable;
        $this->jokeCategoriesTable = $jokeCategoriesTable;
    }

    public function getJokes()
    {
        $jokeCategories = $this->jokeCategoriesTable->find('categoryid', $this->id);

        $jokes = [];

        foreach ($jokeCategories as $jokeCategory) {
            $joke = $this->jokesTable->findById($jokeCategory->jokeid);

            if ($joke) {
                $jokes[] = $joke;
            }
        }

        return $jokes;
    }
}
```

Amend `IjdbRoutes` to set the `categoriesTable` instance to use the new `Category` entity class provide
the two `constructor` arguments

```php
$this->categoriesTable = new \Ninja\DatabaseTable(
  $pdo,
  'category',
  'id',
  '\Ijdb\Entity\Category',
  [
    &$this->jokesTable,
    &$this->jokeCategoriesTable
  ]
);
```

Finally, use the new `getJokes` method to retrive the `jokes` in the `list` controller `action`

```php
if (isset($_GET['category'])) {
  $cateogy = $this->categoriesTable->findById($_GET['category']);
  $jokes = $category->getJokes();
}
else {
  $jokes = $this->jokesTable->findAll();
}
```

Using this approach, any time you need a `list of jokes` that exist in a `category`, you can find the `category`
and then use `$category->getJokes()`

### 18.14. Editing Jokes

Add a `method` to check whether the `joke` has the `category`

```php
if ($joke->hasCategory($category->id)) {   }

public function hasCategory($categoryId) {
  $jokeCategories = $this->jokeCategoriesTable->find('jokeid', $this->id);

  foreach ($jokeCategories as $jokecategory) {
    if ($jokecategory->categoryId == $categoryId) {
      return true;
    }
  }
}
```

With that in place, we can use it in the `editjoke.html.php` template

```php
<?php foreach ($categories as $category) : ?>

    <?php if ($joke && $joke->hasCategory($category->id)) : ?>
        <input type="checkbox" checked name="category[]" id="<?= $category->id ?>" value="<?= $category->id ?>">
    <?php else : ?>
        <input type="checkbox" name="category[]" id="<?= $category->id ?>" value="<?= $category->id ?>">
    <?php endif; ?>

    <label for="<?= $category->id ?>"><?= $category->name ?></label>
<?php endforeach; ?>
```

Although we have some logic that says, "If the box is checked, add a record to the `joke_category` table",
we don't have anything to remove that record after it's been added and the checkbox has been unticked.

We could use this process

- `Loop` through every single category
- `Check` to see if the corresponding checkbook box wasn't checked
- If the box wasn't checked and there's a corresponding record, delete the record

We'd need do this check for every category, and it would take a fairly large amount of code to achieve.

Instead, a much simpler approach is to delete all the records from the `joke_category` table that are
related to the joke we're editing, then apply the same logic as before: `loop through the checked boxes 
and insert records for each category that was checked`

Admittedly, this isn't entirely efficient. If the joke is edited and the category checkboxes aren't changed,
this will cause unnecessary deletion and reinsertion of ideantical data. However, it's still the simplest approach.

Our `DatabaseTable` class has a `delete` method that allows deleting a record by its
`primary key`. However, our table has `two primary keys` — `jokeId` and
`categoryId` — so we can’t use it as it currently is.

Instead, let's add a `deleteWhere` method to the `DatabaseTable` class that works like the existing `find` method

```php
public function deleteWhere($column, $value)
{
    $query = "DELETE FROM `{$this->table}` WHERE `$column` = :value";

    $parameters = [
        'value' => $value
    ];

    $query = $this->query($query, $parameters);
}
```

Add a `clearCategories` method to the `Joke` entity class that removes all the related
records from the `jokeCategories` table for a given joke

```php
public function clearCategories()
{
  $this->jokeCategoriesTable->deleteWhere('jokeId', $this->id);
}
```

Then, we edit the `saveEdit` method

```php
public function saveEdit()
{
  $author = $this->authentication->getUser();

  $joke = $_POST['joke'];
  $joke['jokedate'] = new \DateTime();

  $jokeEntity = $author->addJoke($joke);

  $jokeEntity->clearCategories();

  foreach ($_POST['category'] as $categoryId) {
    $jokeEntity->addCategory($categoryId);
  }

  header('location: /joke/list');
}
```

## 19. User Roles

On our website, we would need at minimum the following access levels

1. `standard users`: can post new jokes, and edit/delete jokes they've posted
2. `administrators`: can add/edit/remove categories, post jokes, and edit/delete jokes
anyone has posted. They should also be able to turn other users into `administrators`

The `simplest way` to do this is to have a column in the `author` table that represents the `author's access level`.

- `1` in the column could represent a normal user
- `2` could represent an administrator

This method very simple to understand, and we could even very easily abstract it to `isAdmin()` to 
improve the readablitity

```php
$author = $this->authentication->getUser();

if ($author->isAdmin()) {
  // They're an administrator
}
else {

}
```

A more `flexible` approach is to give each user individual permissioins for each `acction`.

For this website, we've already considered these `permissions`

- Edit other people's jokes
- Delete other people's jokes
- Add categories
- Edit categories
- Remove categories
- Edit user access levels

Before we model this in the database, let's think about how we'd check these in the existing code

```php
namespace Ijdb\Entity;

class Author
{
  const EDIT_JOKES = 1;
  const DELETE_JOKES = 2;
  const LIST_CATEGORIES = 3;
  const EDIT_CATEGORIES = 4;
  const REMOVE_CATEGORIES = 5;
  const EDIT_USER_ACCESS = 6;

  public function hasPermission($permission)
  {

  }
}
```

And we use it like this

```php
$author = $this->authentication->getUser();

if ($author->hasPermission(Author::LIST_CATEGORIES)) {  }
```

There are two different places we'll need to implement this. The first is page-level access. As we did
with the login check, a check can be done in the `router` to stop people even viewing a page if 
they don't have the correct permissions

This will need to be done in `EntryPoint`, but because each website you build might have
a different way of handling these checkes, we'll add a new method to `IjdbRouets` called `checkPermissions`

```php
public function checkPermission($permission) : bool {
  $user = $this->authentication->getUser();

  if ($user && $user->hasPermission($permission)) {
    return true;
  }
  else {
    return false;
  }
}
```

This fetches the current logged-in user and checks to see if they have a specific permission.

Next, we changes the `interface` to include the `checkPermission` method

```php
namespace Ninja;

interface Routes 
{
  public function getRoutes() : array;
  public function getAuthentication() : \Ninja\Authentication;
  public function checkPermission($permission) : bool;
}
```

To implement this in the `EntryPoint` class, we'll add an extra entry to the `$rouets`
array to specify which permissions are required for accessing each page.

Let's start with the category permissions

```php
$routes = [
  'category/edit' => [
    'POST' => [],
    'GET' => [],
    'login' => true,
    'permissions' => \Ijdb\Entity\Author::EDIT_CATEGORIES
  ],
  'category/delete' => [
    'POST' => [],
    'login' => true,
    'permissions' => \Ijdb\Entity\Author::REMOVE_CATEGORIES
  ],
  'category/list' => [
    'GET' => [],
    'login' => true,
    'permissions' => \Ijdb\Entity\Author::LIST_CATEGORIES
  ]
]
```

The process here is fairly straightforward. When you visit a page, the `EntryPoint` class
will read the value stored in the `permissions` key for that route, then call the new 
`checkPermission` method to determine whether ther user who is logged in and viewing the page has that 
permission.

This will work in the same way as the login check

```php
if (
  isset($routes[$this->route]['login']) && 
  !authentication->isLoggedIn()
) {
  header('location: /login/error');
}
else if (
  isset($routes[$this->route]['permissions']) &&
  !$this->routes->checkPermission($routes[$this->route]['permissions'])
) {
  header('location: /login/error');
}
else {
  //
}
```

Now, if we visit `/categories/list`, we will see there `error page`.

### 19.1. Creating a Form to Assign Permissions

Before we can implement the `hasPermission` method, the website needs a page that allows assigning permissions
to any given user.

We'll need two pages - one that lists all the authors, so we can select the one we want to give 
permissions to, and a second that contains a form with checkboxes for each permission.

```php
$routes = [
 'author/permissions' => [
      'GET' => [
          'controller' => $authorController,
          'action' => 'permissions'
      ],
      'POST' => [
          'controller' => $authorController,
          'action' => 'savePermissions'
      ],
      'login' => true
  ],
  'author/list' => [
      'GET' => [
          'controller' => $authorController,
          'action' => 'list'
      ],
      'login' => true
  ] 
];
```

Rather than adding a `new controller`, we'll use the `Register` controller that already 
`exists` and is used for handling changes to users' accounts.

### 19.2. Author List

Add a method in the `Register` controller called `list` that fetches a list of all registered users and passes
them to the template

```php
public function list()
{
    $authors = $this->authorsTable->findAll();

    return [
        'template' => 'authorlist.html.php',
        'title' => 'Author List',
        'variables' => [
            'authors' => $authors
        ]
    ];
}
```

`authorlist.html.php`

```php
<h2>User List</h2>

<table>
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Edit</th>
    </thead>
    <tbody>
        <?php foreach ($authors as $author) : ?>
            <tr>
                <td><?= $author->name ?></td>
                <td><?= $author->email ?></td>
                <td>
                    <a href="/author/permissions?id=<?= $author->id ?>">Edit Permissions</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

### 19.3. Edit Author Permissions

The template could look like this

```php
<input type="checkbox" value="1" <?php if ($author->hasPermission(EDIT_JOKES)) { echo 'checked' } ?>> Edit Jokes
```

This would work, but it requires storing the information about the permission in `two different places`

- The `constants` in the `Author` entity class
- The `template`

Like most cases when we find repetition like this, there's a much easier way!

> It's actually possible to read information about the variables, methods and constants
> that are contained inside a class using a tool called `Reflection`

We can actually get a list of contants, and their values, from the class!

PHP makes this fairly simple. To `reflect` the `Author` entity class and read all its properties, you can
use the following code

```php
$reflected = new \ReflectionClass('\Ijdb\Entity\Author');

$constants = $reflected->getConstants();
```

> `Reflection` can be a very powerful tool, and I've only scratched the surface of what
> you can do. For more information on `Reflection`, see the `PHP manual page`.

By passing this array to the template, we can actually generate the list of checkboxes for 
permissions from the cnostants inside the template

### 19.4. Setting Permissions

The next stage is storing the user's permissions once you press `save`. Each user will have a set of 
permissions, and there are many different ways to represent this in the database.

We could do it in the same way we did with categories: 

- create a `user_permission` table with two columns `authorid` and `permission`
- then, we could write a record for each permissioin

| authorid | permission |
| 4        | 1          |
| 4        | 3          |
| 4        | 5          |

### 19.5. Setting Permissions | A different approach

Imagine if we set up the `author` table with a column for each permission

```sql
CREATE TABLE `author` (
  `id` INT (11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `editJoke` TINYINT(1) NOT NULL DEFAULT 0,
  `deleteJokes` TINYINT(1) NOT NULL DEFAULT 0,
  `addCategories` TINYINT(1) NOT NULL DEFAULT 0,
  `removeCategories` TINYINT(1) NOT NULL DEFAULT 0,
  `editUserAccess` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)
```

The downside to this approach is that every time we add a permission to the website, we'd need
to add a column to the table.

If you examined a user's record in `MySQL`, you might see something like `0 1 0 0 1 0 0` in the `permissions columns`

### 19.6. Be Bit-wise

You're probably wondering why any of this matters and what is has to do with user permissions.

In short, binary has nothing to do with permissions. But neither do `if` statements or `checkboxes`.
All three are tools we can use to solve the problem of permissions.

What's useful is that you can use PHP to inquire whether any given integer has a 1 o 0 set for any of the bits that make up the number.

### 19.7. Bitwise Permissions

Rather than using a different database column to store each one or zero, we could
use a single binary number to store those ones and zeros in a single column.

By assigning a column to a permission, a binary number can represent which permissions any user has

- `EDIT_USER_ACCESS` - `32`
- `REMOVE_CATEGORIES` - `16`
- `EDIT_CATEGORIES` - `8`
- `LIST_CATEGORIES` - `4`
- `DELETE_JOKES` - `2`
- `EDIT_JOKES` - `1`

The binary number `000001`, which has a 1 in the `EDIT_JOKES` column, would represent
a user with `EDIT_JOKES` permissions.

`111111` would represent a user that had all the permissions

`011111` would represent a user that had every permission apart from being able to edit the 
`permissions` of other users (`EDIT_USER_ACCESS`)

This process is identical to using multiple columns in a database, each with a one or zero.
We're just using a binary number to represent the same data. Rather than one column
per bit, we can store multiple bits in a single `INT` column.

Let's convert the binary numbers to decimal: `000001` becomes `1`, `111111` becomes `63` and
`011111` becomes `31`. We can easily store these numbers as integers in a database!

If someone has the permissions value `63`, we know they have all the permissions
that are available.

### 19.8. Back to PHP

The difficult part is extracting the individual permissions.

What if we want to know whether the user has the `EDIT_CATEGORIES` permission? One the chart
above, I've assigned the `8 bit` to mean `EDIT_CATEGORIES`. If a user has the `permissions`
value `13`, it's not clear whether the `8 bit` is set.

Most programming languages, including PHP and MySQL, support something called `bitwise` operations.

These allow you to inquire whether a specific bit is set in any `integer`. Using a single `permissions` column,
the query above can be expressed as follows

```php
SELECT * FROM author WHERE id = 4 AND 8 & permissions
```

The clever part here is the part `AND 8 & permissions`. This uses the bitwise and (`&`) operator
to inquire whether the `8 bit` is set in the number stored in the `permissions` column for that record.

PHP also provides the bitwise `and` operator. You've already seen that the number `6` is represented
as `0110`, which means that the bits `4` and `2` are set.

```php
if (6 & 2) {

}
```

This says, "Is the bit 2 set in the number 6", and it will evaluate to true.

```php
if (6 & 1) {

}
```

It would return `false`, because the `1` bit is not set in the binary representation of `6` (`0110`)

Binary operations like this are actually fairly common in PHP

Imagine the `author` table had a column called `permissions`: it's possible to determine
whether an `author` has the permission `EDIT_CATEGORIES` by using this code

```php
if ($author->permissions & 8) {

}
```

This code has the same problem I mentioned earlier: it's not clear exactly what's happening here to anyone 
looking at the code. Again, we could represent the bits as constants

```php
const EDIT_JOKES = 1;
const DELETE_JOKES = 2;
const LIST_CATEGORIES = 4;
const EDIT_CATEGORIES = 8;
const REMOVE_CATEGORIES = 16;
const EDIT_USER_ACCESS = 32;
```

And we could write the permissions check like so

```php
// Does the author have the `EDIT_CATEGORIES` permissions
if ($author->permissions & EDIT_CATEGORIES) {

}

// Does the author have the `DELETE_JOKES` permissions
if ($author->permissions & DELETE_JOKES) {

}
```

You don't even need to understand the underlying binary to understand what's happeing here, and 
individual numbers don't even matter!

### 19.9. Storing Bitwise Permissions in the Database

Let's implement this on the website. Amend the `author` table by adding a column called `permissions`,
and set it to `INT(64)` so we can store a maximum of `64` different permissions.

Let's imagine that the boxes for `EDIT_JOKES`, `DELETE_JOKES`, `LIST_CATEGORIES` and `EDIT_USER_ACCESS`
are ticked. When the form is submitted, we'd get the array `[1, 2, 4, 32]`.

The binary representation of those permissions is `100111`. If you work out what that is in decimal, 
you'll get `39`. Add together the values from the array `1 + 2 + 4 + 32` and you'll also get `39`!

The `savePermissions` method in the `Register` controller can be written like this

```php
public function savePermissions()
{
    $author = [
        'id' => $_GET['id'],
        'permissions' => array_sum($_POST['permissions'] ?? [])
    ];

    $this->authorsTable->save($author);

    header('location: /author/list');
}
```

That's it! The `savePermissions` method is converting the checked boxes into a `number`, and 
that `number's library representation` is how we're modeling the permissions of each user.

### 19.10. Cleaning Up

Firstly, we need to add the permissions to the routes

Make sure you have granted your user account the permission `EDIT_USER_ACCESS` before making these changes,
or you won't be able to change anyone's permissions!

```php
'author/permissions' => [
    'GET' => [
        'controller' => $authorController,
        'action' => 'permissions'
    ],
    'POST' => [
        'controller' => $authorController,
        'action' => 'savePermissions'
    ],
    'login' => true,
    'permissions' => Author::EDIT_USER_ACCESS
],
'author/list' => [
    'GET' => [
        'controller' => $authorController,
        'action' => 'list'
    ],
    'login' => true,
    'permissions' => Author::EDIT_USER_ACCESS
]
```

### 19.11. Editing Others' Jokes

The final two permissions are `EDIT_JOKES` and `DELETE_JOKES`, which determine whether the `logged-in`
user can edit or delete a joke someone else has posted.

We can't do this with the `$routes array`, because the check isn't done there. The `edit` link 
and `delete` button are hidden in the template, and there are checks inside the `joke` controller.

Firstly,, let's make the `edit` link and `delete` button appear on the list page for all jokes
if you have the `EDIT_JOKES` or `DELETE_JOKES` permissions.

Change the `list` method to return the `entire $author object` that represents the `logged-in` user

```php
return [
  'user' => $author
]
```

The check in the template can now be amended so that the button and link are only visible
to the person who posted the joke, or someone with the relevant permission

```php
<?php if ($user && ($user->id == $joke->authorid) || $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)) : ?>
    <a href="/joke/edit?jokeid=<?= $joke->id ?>">Edit</a>
<?php endif; ?>

<?php if ($user && ($user->id == $joke->authorid) || $user->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)) : ?>
    <form action="/joke/delete" method="POST">
        <input type="hidden" name="id" value="<?= $joke->id ?>">
        <input type="submit" value="Delete">
    </form>
<?php endif; ?>
```

Change the `delete method` to include the permissions check

```php
public function delete()
{
    $author = $this->authentication->getUser();
    $joke = $this->jokesTable->findById($_POST['id']);

    if ($joke->authorid != $author->id && !$author->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)) {
        return;
    }

    $this->jokesTable->delete($_POST['id']);

    header('Location: /joke/list');
    exit();
}
```

That's it! All the permission checks are now in place.

## 20. Sorting, Limiting and Offsets

### 20.1. Sorting

MySQL supports asking for retrieved records in a specific order. At the moment, the `Joke List` page displays
jokes in the order they were posted. It would be better if it showed the newest first.

A `SELECT` query can contain an `ORDER BY` clause that specifies the column that the data is sorted by.

```sql
SELECT * FROM `joke` ORDER BY `jokedate` DESC
```

Instead, we can do the sort in `PHP itself`, using the `usort` function. The `usort` function takes two arguments:

- `An array` to be sorted
- `The name` of a function that compares two values

```php
function cmp($a, $b)
{
  if ($a == $b) {
    return 0;
  }

  return ($a < $b) ? -1 : 1;
}

$a = [3, 2, 4, 6, 1];

usort($a, 'cmp');
```

The array has been sorted `smallest` to `largest`. The `cmp` function is called with two values
from the array, and returns 

- ` 1`: The first should be placed `after` the second
- `-1`: The first should be place `before` the second

The comparison function can take argumets that are objects, and we can build a comparison
function into our `Category` class like so

```php
public function getJokes()
{
    $jokeCategories = $this->jokeCategoriesTable->find('categoryid', $this->id);

    $jokes = [];

    foreach ($jokeCategories as $jokeCategory) {
        $joke = $this->jokesTable->findById($jokeCategory->jokeid);

        if ($joke) {
            $jokes[] = $joke;
        }
    }

    usort($jokes, [$this, 'sortJokes']);

    return $jokes;
}

private function sortJokes($a, $b)
{
    $aDate = new \DateTime($a->jokedate);
    $bDate = new \DateTime($b->jokedate);

    if ($aDate->getTimestamp() == $bDate->getTimestamp())
        return 0;

    return $aDate->getTimestamp() > $bDate->getTimestamp() ? -1 : 1;
}
```
### 20.2. Pagination with `LIMIT` and `OFFSET`

A common approach is using `pagination` to display a sensible number - for example, ten jokes per page - 
and allow clicking a link to move between pages.

Our first take is to display just the first ten jokes. Using SQL, this is increadibly easy.
The `LIMIT` caluse can be appended to any `SELECT` query to restrict the number of records returned

```sql
SELECT * FROM `joke` ORDER BY `jokedate` DESC LIMIT 10
```

We'll need to build this into `findAll` and `find` methods of the `DatabaseTable` class
as optioinal parameters, as we did with the `$orderBy` variable

```php
public function findAll($limit = null)
{
    $sql = "SELECT * FROM `{$this->table}`";

    if ($limit != null) {
        $sql .= " LIMIT {$limit}";
    }

    $result = $this->query($sql);

    return $result->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
}

public function find($column, $value, $limit = null)
{
    $sql = "SELECT * FROM `{$this->table}` WHERE `$column` = :value";

    if ($limit != null) {
        $sql .= " LIMIT {$limit}";
    }

    $parameters = [
        'value' => $value
    ];

    $query = $this->query($sql, $parameters);

    return $query->fetchAll(\PDO::FETCH_CLASS, $this->className, $this->constructorArgs);
}
```

With that in place, you'll see only ten jokes on the `Joke List` page. The problem now is how we'll view the rest 
of the jokes!

The solution is to have different pages that can be accessed by a `$_GET` variable:
`/joke/list?page=1` or `/joke/list?page=2` to select which page to show.

Page `1` will show jokes `1-10`, page `2` will how jokes `11-20`, and so on.

The template already has access to the `$totalJokes` variable, so we can display the
pages at the end of `jokes.html.php`


```php
public function list()
{
  $totalJokes = count($jokes);
  $post_per_page = 1;

  $number_of_pages = ceil($totalJokes / $post_per_page);

  return [
      'template' => 'jokes.html.php',
      'title' => $title,
      'variables' => [
          'totalJokes' => $totalJokes,
          'jokes' => $jokes,
          'user' => $author ?? null,
          'categories' => $categories,
          'numberOfPages' => $number_of_pages
      ]
  ];
}
```

In template

```php
Select page:

<?php for ($i = 1; $i <= $numberOfPages; $i++) : ?>
    <a href="/joke/list?page=<?= $i ?>"><?= $i ?></a>
<?php endfor; ?>
```

If you click the links, the `$_GET` variable will be set. It's now just a matter of using it 
to display different sets of jokes

The `SQL` clause `OFFSET` can be used with `LIMIT` to do exactly what we want

```sql
SELECT * FROM `joke` ORDER BY `jokedate` LIMIT 10 OFFSET 10
```

This query will return 10 jokes, but instead of returning the `first` ten jokes, it
will display ten jokes starting from joke 10.

the simple calculationi to get `$offset`

```php
$offset = ($_GET['page'] - 1) * 10;
```

Then, edit then `list method` to this

```php
public function list()
{
    $post_per_page = 2;
    $page = $_GET['page'] ?? 1;
    $offset = ($page - 1) * $post_per_page;

    if (isset($_GET['category'])) {
        $category = $this->categoriesTable->findById($_GET['category']);
        $jokes = $category->getJokes();
    } else {
        $jokes = $this->jokesTable->findAll(null, null, $post_per_page, $offset);
    }

    $categories = $this->categoriesTable->findAll();

    $author = $this->authentication->getUser();
    $title = 'Joke List';

    $totalJokes = $this->jokesTable->total();

    $number_of_pages = ceil($totalJokes / $post_per_page);

    return [
        'template' => 'jokes.html.php',
        'title' => $title,
        'variables' => [
            'totalJokes' => $totalJokes,
            'jokes' => $jokes,
            'user' => $author ?? null,
            'categories' => $categories,
            'numberOfPages' => $number_of_pages,
            'currentPage' => $page
        ]
    ];
}
```

In template

```php
<?php for ($i = 1; $i <= $numberOfPages; $i++) : ?>
    <?php if ($i == $currentpage) : ?>
        <a class="currentpage" href="/joke/list?page=<?= $i ?>"><?= $i ?></a>
    <?php else : ?>
        <a href="/joke/list?page=<?= $i ?>"><?= $i ?></a>
    <?php endif; ?>
<?php endfor; ?>
```

### 20.3. Paginate Jokes Categories

```php
public function list()
{
    $post_per_page = 1;
    $page = $_GET['page'] ?? 1;
    $offset = ($page - 1) * $post_per_page;

    $totalJokes = $this->jokesTable->total();

    if (isset($_GET['category'])) {
        $category = $this->categoriesTable->findById($_GET['category']);
        $jokes = $category->getJokes();

        $totalJokes = count($jokes);
        echo $totalJokes . '|' . $offset . '|' . $post_per_page;
        $jokes = array_slice($jokes, $offset, $post_per_page);
    } else {
        $jokes = $this->jokesTable->findAll(null, null, $post_per_page, $offset);
    }

    $categories = $this->categoriesTable->findAll();

    $author = $this->authentication->getUser();
    $title = 'Joke List';

    $number_of_pages = ceil($totalJokes / $post_per_page);

    return [
        'template' => 'jokes.html.php',
        'title' => $title,
        'variables' => [
            'totalJokes' => $totalJokes,
            'jokes' => $jokes,
            'user' => $author ?? null,
            'categories' => $categories,
            'numberOfPages' => $number_of_pages,
            'currentpage' => $page,
            'category_id' => $_GET['category'] ?? null
        ]
    ];
}
```

In template

```php
<?php for ($i = 1; $i <= $numberOfPages; $i++) : ?>

    <?php
    $params = 'page=' . $i;

    if (isset($category_id)) {
        $params .= '&category=' . $category_id;
    }
    ?>

    <?php if ($i == $currentpage) : ?>
        <a class="currentpage" href="/joke/list?<?= $params ?>"><?= $i ?></a>
    <?php else : ?>
        <a href="/joke/list?<?= $params ?>"><?= $i ?></a>
    <?php endif; ?>
<?php endfor; ?>
```
