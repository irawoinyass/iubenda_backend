# IUBENDA - BACKEND

Sr Fullstack (Vue.js & PHP) Developer | Take-Home Challenge

## Installation

Download project repository (
iubenda_backend) to your local server:

```
https://github.com/irawoinyass/iubenda_backend.git
```

Now you need to open your phpmyadmin/database and create a database name

```
test
```

Now Import the sql file from the project folder into the database you created

```
test.sql
```

Should incase your databaser requires password, Kindly open the app folder from any text editor and locate

```
config/Database.php
```

Change the current configuration

```
    private $host = 'localhost';
    private $db_name = 'test';
    private $username = 'root';
    private $password = '';
    private $conn;
```

To

```
    private $host = 'localhost';
    private $db_name = 'test';
    private $username = 'root';
    private $password = 'YourDBPassword';
    private $conn;
```

Below is a postman link that explans how to use the Apis

```
https://documenter.getpostman.com/view/14941047/2s935pqiP4
```

### Design Decision

PHP OOP

```
OOP provides a clear structure for the programs.it helps to keep the PHP code DRY "Don't Repeat Yourself", and makes the code easier to maintain, modify and debug.
```

Database

```
PDO: it provides a data-access abstraction layer, which means that, regardless of which database you're using, you use the same functions to issue queries and fetch data.
```
