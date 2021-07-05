# Working with Date And Time in PHP

Course outline

- Handling the date and time
- Dealing with the timezone
- Using DatePeriod and DateInterval
- Finding sunrie and sunset timings

## Getting Started

PHP

- Stores date and time as timestamp
- Number of seconds from January 1, 1970 to the current time

Range of time

- 290 billion years in the past and in future
- Stores timestamps as 64 bit integer, for 64 bit system, only if PHP is compiled on 64 bit architecture
- PHP has `DateTime` class for 32 bit system and 64 bit system
- Stores timestamps in UTC, Universal Coordinated Time
- Uses PHP configuration for time zone and calculating offset
- Applies daylight savings automatically
- Can set time zones independently for date-related objects

Learn more about timezone at: [PHP manual](https://www.php.net/manual/en/timezones.php)

Configure timezone in `php.ini`

```php
date.timezone = 'Asia/Kolkata'
```

Update timezone in `.htaccess` file

```php
php_value date.timezone 'Asia/Kolkata'
```

Using PHP code

```php
ini_set('date.timezone', 'Asia/Kolkata');
// OR
date_default_timezone_set('Asia/Kolkata');
```
