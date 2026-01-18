# Database Connection Debugging Guide

If you're getting a "Database connection failed" error, follow these steps:

## Step 1: Verify MySQL is Running
1. Open XAMPP Control Panel
2. Check that MySQL shows "Running" (green)
3. If not running, click "Start"

## Step 2: Verify Database Exists
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Check if database `ewelfare_db` exists in the left sidebar
3. If it doesn't exist, you need to import it:
   - Click "New" or "Databases" tab
   - Create database: `ewelfare_db`
   - Select collation: `utf8mb4_unicode_ci`
   - Click "Create"
   - Select the database
   - Click "Import" tab
   - Choose `database.sql` file
   - Click "Go"

## Step 3: Check Database Credentials
Edit `config.php` and verify:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Empty by default in XAMPP
define('DB_NAME', 'ewelfare_db');
```

If you set a MySQL password, update `DB_PASS`:
```php
define('DB_PASS', 'your_password');
```

## Step 4: Test Database Connection
Create a test file `test_db.php` in your project root:

```php
<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Your MySQL password if set
$db = 'ewelfare_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful!";
}

$conn->close();
?>
```

Visit: http://localhost/ewelfare/test_db.php

If you see "Connection successful!", the database works.
If you see an error, check the error message.

## Common Errors and Solutions

### Error: "Unknown database 'ewelfare_db'"
**Solution:** Database doesn't exist. Import `database.sql` in phpMyAdmin.

### Error: "Access denied for user 'root'@'localhost'"
**Solution:** 
- MySQL password might be set. Update `DB_PASS` in `config.php`
- Or reset MySQL password in XAMPP

### Error: "Can't connect to MySQL server"
**Solution:**
- MySQL service not running. Start it in XAMPP Control Panel
- Check if port 3306 is available

### Error: "Table 'users' doesn't exist"
**Solution:** Database exists but tables are missing. Import `database.sql`

## Quick Fix: Re-import Database
1. Open phpMyAdmin
2. Select `ewelfare_db` database (or create it if missing)
3. Click "Import" tab
4. Choose `database.sql` file
5. Click "Go"
6. Refresh your registration page

## Check PHP Error Logs
XAMPP error logs location:
- Windows: `C:\xampp\apache\logs\error.log`
- Mac: `/Applications/XAMPP/xamppfiles/logs/error_log`
- Linux: `/opt/lampp/logs/error_log`

Check the log for detailed error messages.
