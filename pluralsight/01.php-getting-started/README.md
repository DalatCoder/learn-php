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
