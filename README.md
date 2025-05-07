**TaskVault: Employee Task Management System ✅**
TaskVault is a web-based employee task management system built to streamline task assignment, progress tracking, and employee management for organizations. Designed for admins to easily assign and monitor tasks, and for employees to manage and update their task status in real-time.

**🛠️ Technologies Used:**

          Frontend: HTML, CSS
          Backend: PHP
          Database: MySQL
          Server: XAMPP / Apache

**👨‍💼 Admin Features:**

![Screenshot 2025-03-25 192527](https://github.com/user-attachments/assets/e6fa80fa-b925-420f-a50f-40a985bca255)


          Add and manage employee records
          
          Assign tasks with deadlines and priority levels
          
          Dashboard showing total employees, pending and in-progress tasks
          
          View employee details and assign tasks dynamically
          
          Secure admin logout

**👨‍💻 Employee Features:**

![Screenshot 2025-04-11 152407](https://github.com/user-attachments/assets/6f2895cc-323d-4a0c-a178-644e9079c9f7)


          Login to personal dashboard
          
          View assigned tasks with status
          
          Update task progress (Pending, In Progress, Completed)
          
          View profile details
          
          Secure employee logout

**📌 Project Structure Overview**

          admin/ — Admin login and dashboard
          
          employee/ — Employee panel and task display
          
          db/connection.php — Database connection
          
          login/ — Login logic
          
          logout/ — Secure logout mechanism


🔒 Authentication:

**🔐 Login Redirection Logic:**

After successful login, the system checks whether the user is an admin or an employee based on the credentials entered.
          
          Admin is redirected to the Admin Dashboard to manage employees and tasks.
          
          Employees are redirected to the Employee Dashboard where they can view and update their assigned tasks.

This logic ensures role-based access and keeps data securely separated between admin and employees.
![Screenshot 2025-04-11 144346](https://github.com/user-attachments/assets/dbb40170-de73-49ba-9225-62cd2073cc67)


          Role-based login for Admin and Employee
          
          Session management for secure page access

**⚠️ Limitations (Current Version):**

          No email notification system
          
          No task file uploads or comment sections
          
          Passwords are not encrypted yet

These features may be added in future versions for better security and usability.

**📬 Contact:**

For questions, collaborations, or suggestions:

**Email: ayushsgaikwad8480@gmail.com**

**GitHub: AyushGaikwad84**



