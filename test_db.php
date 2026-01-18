<?php
// Quick database connection test
$host = 'localhost';
$user = 'root';
$pass = ''; // Change if you set a MySQL password
$db = 'ewelfare_db';

echo "<h2>Database Connection Test</h2>";

// Test connection
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>");
} else {
    echo "<p style='color: green;'>✅ Connected to MySQL server successfully!</p>";
}

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE 'ewelfare_db'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ Database 'ewelfare_db' exists!</p>";
    
    // Select database
    $conn->select_db($db);
    
    // Check if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Table 'users' exists!</p>";
        
        // Count users
        $result = $conn->query("SELECT COUNT(*) as count FROM users");
        $row = $result->fetch_assoc();
        echo "<p>📊 Total users in database: " . $row['count'] . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Table 'users' does NOT exist. Please import database.sql</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Database 'ewelfare_db' does NOT exist. Please create it and import database.sql</p>";
}

$conn->close();
?>

<h3>Next Steps:</h3>
<ul>
    <li>If you see errors, check DEBUG_DATABASE.md for troubleshooting steps</li>
    <li>Make sure MySQL is running in XAMPP Control Panel</li>
    <li>Import database.sql file in phpMyAdmin if database/tables are missing</li>
</ul>
