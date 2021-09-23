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
