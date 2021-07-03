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
