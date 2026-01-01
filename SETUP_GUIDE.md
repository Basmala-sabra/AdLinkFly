# AdLinkFly - Setup & Running Guide

This guide will help you set up and run the AdLinkFly URL shortener application on your local XAMPP environment.

## Prerequisites

1. **XAMPP** (already installed - your project is in `C:\xampp1\htdocs\`)
2. **PHP 5.6+** (check with `php -v` in command prompt)
3. **MySQL** (included with XAMPP)
4. **Apache Web Server** (included with XAMPP)
5. **Composer** (for PHP dependencies - check if `vendor/` folder exists)

## Step-by-Step Setup

### 1. Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL** services
3. Ensure both services are running (green indicators)

### 2. Create Database

1. Open **phpMyAdmin**: http://localhost/phpmyadmin
2. Click on **"New"** to create a new database
3. Enter database name (e.g., `adlinkfly` or `link_shortener`)
4. Choose **Collation**: `utf8mb4_unicode_ci` or `utf8_general_ci`
5. Click **"Create"**

**Note:** Keep the database name, username (usually `root`), and password (usually empty for XAMPP) handy for the installation step.

### 3. Configure .htaccess File

1. Navigate to: `C:\xampp1\htdocs\codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener\main\AdLinkFly\AdLinkFly\`
2. Check if `.htaccess` file exists in the root directory
   - If it doesn't exist, copy `htaccess.txt` and rename it to `.htaccess`
   - Make sure the `.htaccess` file is present in the root folder

### 4. Set File Permissions

Ensure the following directories are writable:

- `tmp/` directory
- `logs/` directory  
- `config/` directory

**On Windows with XAMPP**, these are usually writable by default, but if you encounter issues:

1. Right-click on each folder → **Properties**
2. Go to **Security** tab
3. Click **Edit** and ensure **IIS_IUSRS** and **Users** have **Modify** permissions

### 5. Run the Installation

1. Open your web browser
2. Navigate to: **http://localhost/codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener/main/AdLinkFly/AdLinkFly/**
   
   OR if you have a virtual host set up:
   **http://adlinkfly.local/** (or your configured domain)

3. The application should redirect you to the **Installation Wizard** at:
   **http://localhost/codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener/main/AdLinkFly/AdLinkFly/install**

4. Follow the installation wizard steps:
   - **Step 1:** System Requirements Check
   - **Step 2:** Database Configuration
     - Database Host: `localhost`
     - Database Name: (the one you created in step 2)
     - Username: `root` (default XAMPP)
     - Password: (leave empty for default XAMPP, or enter your MySQL password)
     - Port: `3306` (default)
   - **Step 3:** Create Admin Account
   - **Step 4:** Complete Installation

### 6. Access the Application

After successful installation:

- **Front-end (Public):** http://localhost/codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener/main/AdLinkFly/AdLinkFly/
- **Member Dashboard:** http://localhost/codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener/main/AdLinkFly/AdLinkFly/auth/users/signin
- **Admin Panel:** http://localhost/codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener/main/AdLinkFly/AdLinkFly/admin

## Troubleshooting

### Issue: "Page not found" or 404 errors

**Solution:**
- Ensure `.htaccess` file exists in the root directory
- Check that Apache `mod_rewrite` is enabled:
  1. Open `httpd.conf` in `C:\xampp1\apache\conf\`
  2. Find and uncomment: `LoadModule rewrite_module modules/mod_rewrite.so`
  3. Restart Apache

### Issue: Database connection failed

**Solution:**
- Verify MySQL is running in XAMPP Control Panel
- Check database credentials (username, password, database name)
- Ensure database exists in phpMyAdmin
- Try connecting with: `mysql -u root -p` in command prompt

### Issue: "tmp directory is not writable"

**Solution:**
- Right-click `tmp/` folder → Properties → Security
- Add **Write** permissions for **IIS_IUSRS** and **Users**
- Repeat for `logs/` and `config/` directories

### Issue: CSS/JS files not loading

**Solution:**
- Clear browser cache (Ctrl+F5)
- Check browser console for 404 errors
- Verify file paths are correct
- Ensure Apache is running

### Issue: Installation page doesn't appear

**Solution:**
- Navigate directly to: `/install` URL
- Check if installation is already completed (try accessing the main site)
- Check `config/app.php` for any configuration issues

## Quick Start (After Installation)

1. **Sign in** with your admin credentials
2. **Create shortened links** from the dashboard
3. **View statistics** and analytics
4. **Configure settings** in the admin panel

## Development Mode

To enable debug mode for development:

1. Edit `config/app_local.php` (or create from `app_local.example.php`)
2. Set `'debug' => true`
3. This will show detailed error messages (only use in development!)

## Important Notes

- Keep your database credentials secure
- Don't commit `app_local.php` with real credentials to version control
- Regularly backup your database
- For production, set `debug => false` in configuration

## Need Help?

- Check the installation wizard for specific error messages
- Review Apache error logs: `C:\xampp1\apache\logs\error.log`
- Review PHP error logs: `C:\xampp1\php\logs\php_error_log`
- Review application logs: `C:\xampp1\htdocs\codecanyon-FNmd6dpx-adlinkfly-monetized-url-shortener\main\AdLinkFly\AdLinkFly\logs\`

---

**Good luck with your URL shortener! 🚀**


