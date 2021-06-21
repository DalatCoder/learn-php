# Authentication and Authorization in PHP

## What is authentication?

Overview:

- A rapid introduction to authentication
- Learn about two common types:
  - HTTP authentication
  - Form-based authentication

The process of verifying the identity of a user, process or device, often as a
prerequisite to allowing access to resources in an information system.

There are multiple authentication types:

- Single-factor authentication
- Multi-factor authentication

### Single-factor Authentication

- Form: filling out username and password
- Biometric data: fingerprint
- An additional item: smart card

### The difference between Authentication and Authorization

- In authentication: you're determining if a user is valid
- In authorization: a user has already been validated

The benefits:

- Only valid users have access
- Access is appropriately authorized

### About HTTP Authentication

Authentication framework, which can be used by a server to challenge a
client request, and by a client to provide authentication information, as
defined by RFC 7235

- Doesn't use login pages
- Uses HTTP headers
- There are 6 types
  - Basic
  - Digest
  - Bearer
  - ...

### Form-based Authentication

- Has no formal specification
- Uses HTTP and HTML elements (input, hidden, password field)
- It very flexible
- Can be very creative

Please be aware for session cookies:

- Set the HttpOnly and Secure flags to avoid XSS attacks

## HTTP Authentication

Overview:

- What is HTTP authentication?
- Common HTTP authentication methods
- Relevant HTTP headers
- Advantages and disadvantages
- Why HTTPS is essential
- How to implement it in PHP

### What is?

> An authentication framework, which can be used by a server to challenge a client
> request, and by a client to provide authentication information, as defined by
> RFC 7235. It doesn't use login pages, cookies, or session identifiers, rather
> (it uses) standard fields in the HTTP header

### How does HTTP Authentication work?

![Authentication Overview](http_authentication_overview.png)
