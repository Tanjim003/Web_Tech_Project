# E-Welfare Bangladesh - Installation Guide

## Prerequisites
- XAMPP (or any PHP/MySQL server)
- PHP 7.4 or higher
- MySQL 5.7 or higher (or MariaDB 10.3+)

## Installation Steps

### 1. Database Setup
1. Start XAMPP and ensure Apache and MySQL services are running
2. Open phpMyAdmin (usually at http://localhost/phpmyadmin)
3. Import the database schema:
   - Click on "Import" tab
   - Choose file: `database.sql`
   - Click "Go" to import
   
   OR manually run the SQL file:
   ```sql
   -- Execute the SQL commands in database.sql
   ```

### 2. Database Configuration
Edit `config.php` and update the database credentials if needed:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Update if you have a password
define('DB_NAME', 'ewelfare_db');
```

### 3. File Permissions
Ensure the web server has read/write permissions on:
- The project directory
- Any upload directories (if file uploads are added later)

### 4. Access the Application
1. Navigate to: `http://localhost/ewelfare/`
2. The application should now be accessible

## Testing

### Test User Registration
1. Go to the homepage
2. Click "Sign Up Now" or "Join Us"
3. Fill in the registration form
4. Submit to create a new account

### Test Login
1. Go to `login.php`
2. Use the credentials from registration
3. You should be logged in and redirected to homepage

### Test Service Applications
1. Log in to the application
2. Go to "Services" page
3. Click on any service (Doctor, Donation, Farmer, etc.)
4. Fill out and submit the form
5. Check the database to verify the application was saved

## Database Tables

The application uses the following main tables:
- `users` - User accounts
- `service_applications` - Main service applications
- `doctor_applications` - Doctor-specific applications
- `donation_applications` - Donation applications
- `farmer_applications` - Farmer support applications
- `animal_welfare_applications` - Animal welfare applications
- `food_support_applications` - Food support applications
- `password_resets` - Password reset tokens

## Troubleshooting

### Database Connection Error
- Check if MySQL service is running in XAMPP
- Verify database credentials in `config.php`
- Ensure database `ewelfare_db` exists

### Session Issues
- Check PHP session configuration
- Ensure cookies are enabled in browser
- Clear browser cache and cookies

### 404 Errors
- Verify Apache is running
- Check file paths are correct
- Ensure `.htaccess` is not blocking access (if present)

## Next Steps

Consider adding:
- Email functionality for password reset
- Admin dashboard for managing applications
- User profile pages
- File upload functionality for documents
- Email notifications for application submissions
