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
