# Employee Management System

## Setup Instructions

1. **Database Setup**
   - Import the `setup.sql` file into your MySQL database to create the `employee_management` database, `users` table, and `employees` table.

2. **Configuration**
   - Update the database connection details in `db.php` (if necessary).

3. **User  Registration**
   - Access the registration page: `http://localhost/register.php` to create a new user. You can set the role as either "admin" or "user".

4. **User  Login**
   - Access the login page: `http://localhost/login.php` to log in.

5. **Run the Application**
   - Place all PHP files in your web server's document root (e.g., `htdocs` for XAMPP).
   - Access the application via your web browser:
     - Add Employee: `http://localhost/add.php` (Admin only)
     - View Employees: `http://localhost/view.php`
     - Search Employees: `http://localhost/search.php`
     - Logout: `http://localhost/logout.php`

6. **Logging**
   - All actions performed by users will be logged in `app.log` in the same directory as the PHP files.
