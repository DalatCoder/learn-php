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
