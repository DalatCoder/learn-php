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

## Getting Familiar with Basic Date and Time Function in PHP

Overview

- Procedural functions of date and time
- `time()`: return current Unix timestamp
- `strtotime($time_string)`: parse string to timestamp
- `mktime($h, $m, $s, $mo, $d, $y)`: get Unix timestamp for a date

```php
  $timestamp_now = time();
  echo "Timestamp for now: {$timestamp_now} <br>";

  $timestamp_tomorrow = $timestamp_now + (60 * 60 * 24);
  echo "Timestamp for tomorrow: {$timestamp_tomorrow} <br>";

  $timestamp_tomorrow = strtotime("+1 day");
  echo "Timestamp for tomorrow: {$timestamp_tomorrow} <br>";

  $timestamp_newyear = strtotime("first day of January 2021");
  echo "Timestamp for newyear: {$timestamp_newyear} <br>";

  $timestamp_newyear = mktime(0, 0, 0, 1, 1, 2021);
  echo "Timestamp for newyear: {$timestamp_newyear} <br>";
```

`Date` functions

Learn more about date format at: [PHP Manual](https://www.php.net/manual/en/datetime.format.php)

- `date($format, $timestamp)`: Format a local time/date
- `checkdate($month, $day, $year)`: Validate a date

```php
  echo "Today is " . date('g:i:s a \o\n l, F j, Y') . '<br>';
  echo "Tomorrow is " . date('g:i:s a \o\n l, F j, Y', $timestamp_tomorrow) . '<br>';
  echo "New Year 2021 is " . date('g:i:s a \o\n l, F j, Y', $timestamp_newyear) . '<br>';

  echo "<br><br>";

  $year = 2021;

  if (checkdate(2, 29, $year)) {
      echo "{$year} is a leap year";
  } else {
      echo "{$year} is not a leap year";
  }
```

Demo

- Keep track for database operation
- Setting time limit for cookies and sessions

## Understanding DateTime class in PHP

Overview

- Object Oriented date and time functions
- Timestamp in DateTime class
- Play around with DateTime object
- Create a demo app to find our sunrise and sunset timings

### DateTime class

- Object Oriented
- Stores information about date, time and timezones
- Timezone information is independent of server settings
- Dedicated methods for date and time calculations: `modify`, `add`, `sub` and `diff`

```php
  $date_now = new DateTime();
  $date = new DateTime('January 14, 2020');

  echo $date_now->format('l, F j, Y g:i a');

  $time_now = $date_now->getTimeStamp();
  // $time_now = $date_now->format('U');

  $date->setTimestamp($time_now);
```

### Finding Sunrise and Sunset Timing

- `date_sun_info($time, $lat, $long) : array`: Returns array with information about sunset/sunrise and twilight begin/end
- Finding latitude and longitue at: [https://www.latlong.net](https://www.latlong.net)

Look at `datetime-oop/sun_week.php`

### `Modify()`: DateTime vs DateTimeImmutable

- `DateTime::modify()`: Alters the object and returns modified object

  ```php
  $date1 = new DateTime();
  $date2 = $date1->modify('+1 day 9:30 pm');

  // $date1 and $date2 will be the same
  ```

- `DateTimeImmutable::modify()`: Alters the object and returns new object

  ```php
  $date1 = new DateTimeImmutable();
  $date2 = $date1->modify('+1 day 9:30 pm');

  // $date1 and $date2 will not be the same
  ```

### Change Date and Time independently

- `DateTime::setDate($year, $month, $day)`: Sets the date
- `DateTime::setTime($hour, $min, $sec)`: Sets the time

### Using DateTime::createFromFormat

Learn more at [PHP Manual](https://www.php.net/manual/en/datetime.createfromformat.php)

```php
  $date = new DateTime('09/05/2020');
  echo $date->format('F j, Y');

  $date = DateTime::createFromFormat('d/m/Y', '09/05/2020');
  echo $date->format('F j, Y');
```
