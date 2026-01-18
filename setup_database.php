<?php
// Database Setup Script
// This script will create the database and import tables automatically

$host = 'localhost';
$user = 'root';
$pass = ''; // Change if you set a MySQL password
$db_name = 'ewelfare_db';

echo "<h2>E-Welfare Database Setup</h2>";
echo "<p>Setting up database...</p>";

// Connect to MySQL server (without selecting database)
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>");
}

echo "<p style='color: green;'>✅ Connected to MySQL server</p>";

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Database '$db_name' created or already exists</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating database: " . $conn->error . "</p>";
    $conn->close();
    exit;
}

// Select the database
$conn->select_db($db_name);

// Read and execute SQL file
$sql_file = __DIR__ . '/database.sql';
if (!file_exists($sql_file)) {
    die("<p style='color: red;'>❌ Error: database.sql file not found at: $sql_file</p>");
}

echo "<p>📄 Reading database.sql file...</p>";
$sql_content = file_get_contents($sql_file);

// Remove CREATE DATABASE and USE statements as we're already using the database
$sql_content = preg_replace('/CREATE DATABASE\s+IF NOT EXISTS.*?;/is', '', $sql_content);
$sql_content = preg_replace('/USE\s+.*?;/is', '', $sql_content);

// Remove comments
$sql_content = preg_replace('/--.*$/m', '', $sql_content);

echo "<p>⚙️ Executing SQL statements...</p>";

// Execute the SQL content using multi_query
if ($conn->multi_query($sql_content)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "<p style='color: green;'>✅ SQL statements executed successfully</p>";
} else {
    // If multi_query fails, try executing statement by statement
    $statements = explode(';', $sql_content);
    $executed = 0;
    $errors = [];
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (empty($statement) || strlen($statement) < 10) {
            continue;
        }
        
        if ($conn->query($statement)) {
            $executed++;
        } else {
            // Ignore "table already exists" errors
            if (strpos($conn->error, 'already exists') === false && 
                strpos($conn->error, 'Duplicate') === false) {
                $errors[] = $conn->error;
            }
        }
    }
    
    if (!empty($errors)) {
        echo "<p style='color: orange;'>⚠️ Some warnings occurred (tables may already exist):</p><ul>";
        foreach (array_unique($errors) as $error) {
            echo "<li style='color: orange;'>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
    echo "<p style='color: green;'>✅ Processed $executed SQL statements</p>";
}

// Verify tables were created
$tables = ['users', 'service_applications', 'doctor_applications', 'donation_applications'];
echo "<p><strong>Checking tables:</strong></p>";
echo "<ul>";

foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result && $result->num_rows > 0) {
        echo "<li style='color: green;'>✅ Table '$table' exists</li>";
    } else {
        echo "<li style='color: red;'>❌ Table '$table' does NOT exist</li>";
    }
}

echo "</ul>";

$conn->close();

echo "<hr>";
echo "<h3 style='color: green;'>✅ Database setup complete!</h3>";
echo "<p><strong>Next steps:</strong></p>";
echo "<ul>";
echo "<li><a href='index.php'>Go to Homepage</a></li>";
echo "<li><a href='test_db.php'>Test Database Connection</a></li>";
echo "</ul>";
?>
