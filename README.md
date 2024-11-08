# Scholarship System

Welcome to the **Scholarship System** repository! This project is a comprehensive web-based application developed using **HTML**, **CSS**, **Java**, **JavaScript**, and **AJAX**. It provides an efficient and user-friendly platform for managing scholarships, programs, and applicant records, while ensuring data security with AES 128 encryption. 

---

## Features

### 1. **Admin Dashboard**
   - **Scholarship Management**: 
     - Add, edit, and delete scholarship details.
   - **Program Management**: 
     - Manage the different programs associated with the scholarships.
   - **School Fee Management**: 
     - Add, edit, and delete school fee records.
   - **Announcement Management**: 
     - Create and update announcements to keep applicants and scholars informed.
   - **Applicant and Scholar Monitoring**: 
     - Track the status of applicants and scholars, updating their status as necessary.
     - Send notifications to applicants via SMS (using **Semaphore**) and email (using **PHPMailer**).
   - **Report Generation**: 
     - Generate payroll and billing reports in **PDF** or **Excel** formats.
     - Create lists of scholars for administrative purposes.

### 2. **User Dashboard**
   - **Scholarship Application**: 
     - Apply for various scholarships available in the system.
     - Track the status of applications in real-time.
   - **Personal Information Management**: 
     - Update and manage personal details securely.

---

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: Java
- **AJAX**: For asynchronous requests and a seamless user experience
- **Notifications**: 
  - **SMS**: Using **Semaphore** for sending updates.
  - **Email**: Using **PHPMailer** for email notifications.
- **Encryption**: AES 128 encryption for secure data storage

---

## Installation Guide

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/scholarship_system.git
   ```
2. **Navigate to the Project Directory**:
   ```bash
   cd scholarship_system
   ```
3. **Set Up the Database**:
   - Create a database and configure it in the system.
   - Ensure AES 128 encryption is set up for secure data storage.

4. **Configure SMS and Email**:
   - **Semaphore**: Set up your Semaphore account for SMS notifications.
   - **PHPMailer**: Configure PHPMailer for sending emails.

5. **Run the Application**:
   - Use your preferred server setup to run the application.

---


## Contribution Guidelines

We welcome contributions to improve the Scholarship System. If you would like to contribute, please fork the repository and create a new branch for your changes. Submit a pull request with a detailed explanation of your changes or enhancements.

