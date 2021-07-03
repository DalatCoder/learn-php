# Cookies and Sessions in PHP

HTTP is stateless protocol.

Sessions and Cookies were created to maintain state between HTTP requests.

![Overview](overview.png)

Cookies and Sessions

- Remember stateful information for stateless HTTP Protocol
- Helpful for personalizing user experiences
- Global storages to store data persistently for a site
- `$_COOKIE` for cookies
- `$_SESSION` for sessions

## Introducing to Cookies

Cookies were introduced before sessions. When cookies were invented, it was used
to store small user preferences.

Properties

- Stored in the client-side
- Size of cookies is limited to 4KB in any browser
- Only domains which create the cookie can access them
- At least 50 cookies per domain
- At least 3000 cookies in total

Cons of using cookies

- Security concern
- Limited storage
- Bigger request size

## Introducing to Sessions

> Session starts when you open an application, continues until you work on it
> and ends when you close the application

![Session Overview](overviewsession.png)

Properties

- Session is maintained by the server
- Session is associated with Session Identifiers, called SID
- Session uses cookie to transfer SID
- If cookie is disabled, URL is used

Benefits of Sessions over Cookies

- Data security
- More storage
- Smaller request size

Cookies vs. Sessions

|                                     Cookies | Sessions                              |
| ------------------------------------------: | :------------------------------------ |
|                       Maintained on browser | Taken care by server                  |
|               Limited amount of data of 4KB | Unlimited amount of data              |
|                    Easy to use, less secure | Not so easily accessible, more secure |
| Cookie is sent to server with every request | Session ID is sent to server          |
|        Uses super global variable $\_COOKIE | Uses super global variable $\_SESSION |

## Working With Cookies

Overview:

- Creating Cookies
- Implementing Cookies
- Deleting Cookies
- Best Practices

### 1. Remainder

- Cookies are set by the server and stored client-side
- It helps preserving the state of the HTTP protocol
- Stored in `$_COOKIE` at key-value pair
- Limited data storage
- Cookies are used to:
  - identify unique visitors
  - personalize the user experience
  - track the pages visited by a user
- Cookies rely on the HTTP protocol

Sample Request - Response with Cookies

![Request Response with Cookie](req-res-with-cookie.png)

For this cookie to exist, there has to be a request-response scenario

- A user sends a request for the page that sets cookies
- The server then sets the cookie on the user's computer
- Other page requests from the user will send the cookie name and value

### Creating Cookies

```php
setcookie(string $name, string $value='', array $options=[]) : bool
```

Required

- `$name`: name of the cookie
- `$value`: value or information to be stored in the cookie

Options

- `$options`: associative array with the following keys
  - `expires`: specifies when the cookie expires, used with `time()`
    - for 1 hour: `setcookie(name, value, time() + 3600)`
    - for 1 day: `setcookie(name, value, time() + 86400)`
    - for 30 day: `setcookie(name, value, time() + 86400 * 30)`
    - empty: the cookies will expire when the session end (when user close the browser)
  - `path`: server path or the path of the domain to which cookie is sent.
    We can specify the directories for valid cookies as well
    - Example: for domain1.com
      - `setcookie(name, value, time()+3600, '/php/')`: the cookie will only valid for `domain1.com/php/` and its subdirectories
      - `setcookie(name, value, time()+3600, '/')`:: valid for every route
  - `domain`: name of the domain, for which the cookie will be active
    - `www.domain1.com`: the cookie only valid for `www`
    - `domain1.com`: any and all subdomains of `domain1.com`
  - `secure`: if cookie should be transmitted only over secure HTTPS connection, default is `FALSE`
  - `httponly`: cookie will only be available through the HTTP protocol, meaning that client side languages such as JS or VBScript can't access the cookie
  - `samesite`: specifies if the cookie should be sent for the cross-site requests
    - `None`: cookies can be used accross sites
    - `Lax`: same-site requests and standard `<a=href=...>` link for target sites
    - `Strict`: only same-site request, no cross-site at all

```php
$options = array(
    'expires' => time() + 60*60*24,
    'path' => '/',
    'domain' => '.domain1.com',
    'secure' => true, // or false
    'httponly' => true, // or false,
    'samesite' => 'None' // or Lax or Strict
);
setcookie('lang', 'french', $options);
```

- Cookies are transferred in HTTP headers
  These HTTP headers are always sent at the top of an HTTP document before any other data.
  Thus, the PHP `setcookie` function
- `setcookie()` should be called before any output to the browser
  - before `<html>`
  - before `echo()` or `print()`
