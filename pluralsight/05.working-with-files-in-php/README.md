# Working With Files In PHP

Overview

- How to manage files
- Interact with the file system
- Securely send and receive files

Course Demo: eBook reader

- Read a book
- Scanning a library
- Send and receive books via web service

## Managing Files

### 1. Read the whole file

- `file_get_contents`: Read contents of file into a string
- `file`: Read contents of file into an array (one line per entry)
- `readfile`: Read file and send directly to output buffer

Demo

```php
  $filename = './books/Charles Dickens/A Tale of Two Cities.txt';

  print(file_get_contents($filename));
  print_r(file($filename));
  readfile($filename);
```

### 2. Read partial file

- Open a file with `fopen` and store in `$f` (File handler)
- `$filename`: Path to file, can be a URL
- `$mode`: Required access mode (e.g. read or write)
- `$use_include_path`: Use include path to search for file in `php.ini`
- `$context`: Context that the resulting file stream should be opened with

```php
  $f = fopen(
    string $filename,
    string $mode,
    [
      bool $use_include_path = FALSE,
      resource $context
    ]
  )
```

File access modes

- `r/r+`: Read (+ write), start at beginning
- `w/w+`: Write (+ read), start at beginning
- `a/a+`: Write (+ read), start at end
- `x/x+`: Create and write (+ read). `Fail` if file exists
- `c/c+`: Open for write (+ read). Without truncating content (override)

```php
$f = fopen('path/to/file', 'r');
```

Read partial of the file

- `fread`: Read part of file into a string
- `feof`: Test for end of file
- `rewind`: Reset file pointer to beginning of file
- fget
  - `fgetc`: Get a single character
  - `fgets`: Get a line of text
  - `fgetcsv`: Get a line and parse as CSV

Close a file

```php
  $flag = fclose($f);
  echo $flag; // true or false
```

Demo

```php
  $filename = './books/Charles Dickens/A Tale of Two Cities.txt';

  $f = fopen($filename, 'r');

  while (!feof($f)) {
      echo fread($f, 512);
      fgets(STDIN);
  }

  fclose($f);
```

Learn more at [https://www.php.net/manual/en/ref.filesystem.php](https://www.php.net/manual/en/ref.filesystem.php)

### 3. Creating files

- Temporary files

  - `tmpfile()`: Return a temporary resource to work with
  - `tempnam()`: Return a filename, including full path for a temporary file

- Permanent files
  - `fopen()`: `w` mode
  - `touch()`

### 4. Writing to files

- `file_put_contents()`
- `fopen` -> `fwrite` -> `fclose`
- `fputs`: Put on string of text into a file
- `fputcsv`

### 5. Deleting files

`unlink` attempts to delete a file

```php
$flag = unlink('path/to/file');
echo $flag; // true or false
```

### 6. File metadata

- `fileatime()`: File access time
- `filemtime()`: File modify time
- `filesize()`: File size
- `filetype()`: File type
  - It not going to return `MIME` type
  - Check whether a `file` or a `directory`
- `is_readable()`
- `is_writeable()`
- `is_executable()`

### 7. File permissions

- Owner

  - `fileowner()`: who?
  - `chown()`: change owner

- Group

  - `filegroup()`: who?
  - `chgrp()`: change group

- General
  - `fileperms()`: who?
  - `chmod`: change file permission

## Working with the Filesystem

### 1. Querying the Filesystem

- `getcwd`: Get current working directory
- `disk_free_space`: Get available bytes in directory's current volume
- `disk_total_space`: Get total size in bytes of directory's current volume
- `is_file`: Check if $filename points to a file
- `is_dir`: Check if $filename points to a directory
- `file_exists`: Check if $filename points to a file or a directory

### 2. Reading directories

- `opendir()`
- `readdir()` / `rewinddir()`
- `closedir()`

- `scandir()`: open - readding - close

### 3. Manipulating directories

- `chdir`: Change directory (Navigation)
- `mkdir`: Create a directory
- `rmdir`: Remove a directory (Not going to remove recursively)
