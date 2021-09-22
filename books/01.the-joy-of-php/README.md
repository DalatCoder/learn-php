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

