# Quick Start Guide - E-Welfare Bangladesh

## Step 1: Start XAMPP Services

1. **Open XAMPP Control Panel**
   - On macOS: Open Applications → XAMPP → XAMPP (or search "XAMPP" in Spotlight)
   - On Windows: Open XAMPP Control Panel from Start Menu

2. **Start Apache and MySQL**
   - Click "Start" button next to **Apache**
   - Click "Start" button next to **MySQL**
   - Both should show green/running status

## Step 2: Import Database

### Option A: Using phpMyAdmin (Recommended)
1. Open your web browser
2. Go to: `http://localhost/phpmyadmin`
3. Click on "New" in the left sidebar (or click "Databases" tab)
4. Create database name: `ewelfare_db`
   - Select collation: `utf8mb4_unicode_ci`
   - Click "Create"
5. Select the `ewelfare_db` database
6. Click "Import" tab at the top
7. Click "Choose File" and select `database.sql` from the ewelfare folder
8. Click "Go" at the bottom
9. You should see "Import has been successfully finished"

### Option B: Using Terminal/Command Line
```bash
# Navigate to your project directory
cd /Applications/XAMPP/xamppfiles/htdocs/ewelfare

# Import database (default password is empty)
/Applications/XAMPP/xamppfiles/bin/mysql -u root < database.sql
```

## Step 3: Access the Application

1. Open your web browser (Chrome, Firefox, Safari, etc.)
2. Go to: `http://localhost/ewelfare/`
3. You should see the E-Welfare Bangladesh homepage!

## Step 4: Test the Application

### Test Registration:
1. Click "Sign Up Now" or "Join Us" button
2. Fill in the registration form:
   - Full Name
   - Username (must be unique)
   - Email (must be unique)
   - Phone Number
   - Password (minimum 6 characters)
   - Role (Volunteer, Medical Professional, Farmer, or Community Supporter)
   - District
3. Click "Register Now"
4. You should see a success message

### Test Login:
1. Click "Login" in the navigation
2. Enter your email/username and password
3. Click "Login"
4. You should be redirected to the homepage (logged in state)

### Test Services:
1. Click "Services" in the navigation
2. Click any service (e.g., "Medical Volunteers", "Become a Donator")
3. Fill out the form
4. Submit - it should save to the database

### View Dashboard:
1. After logging in, click "Dashboard" in the navigation
2. You should see your profile and applications

## Troubleshooting

### Apache/MySQL won't start:
- **Port conflict**: Another service might be using port 80 (Apache) or 3306 (MySQL)
  - Check if Skype or other apps are using these ports
  - You can change ports in XAMPP settings if needed

### Database connection error:
- Make sure MySQL is running in XAMPP
- Check `config.php` - database credentials should be:
  - Host: `localhost`
  - User: `root`
  - Password: (empty by default)
  - Database: `ewelfare_db`

### Page shows 404 or not found:
- Make sure Apache is running
- Check the URL is correct: `http://localhost/ewelfare/`
- Verify files are in: `/Applications/XAMPP/xamppfiles/htdocs/ewelfare/`

### Database import fails:
- Make sure MySQL is running
- Check if database `ewelfare_db` already exists (drop it first if needed)
- Verify the `database.sql` file exists in the project folder

### PHP errors:
- Check XAMPP error logs: `/Applications/XAMPP/xamppfiles/logs/`
- Make sure PHP is enabled in Apache
- Check browser console (F12) for JavaScript errors

## Default Database Settings

If you need to change database settings, edit `config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Change if you set a MySQL password
define('DB_NAME', 'ewelfare_db');
```

## Need Help?

1. Check `INSTALLATION.md` for detailed setup
2. Check `CONVERSION_SUMMARY.md` for feature overview
3. Verify all files are in the correct location
4. Check XAMPP control panel for error messages
