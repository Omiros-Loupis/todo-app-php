# Todo App 

PHP AND SQLITE
This project allows users to register, login, create projects, and manage tasks within those projects.

## Features

* **User Authentication:** Secure registration and login (password hashing).
* **Project Management:** Users can create and view their own projects.
* **Task Management:** Add and delete tasks within specific projects.
* **Data Security:** Uses PDO Prepared Statements to prevent SQL Injection.
* **Portable:** Uses SQLite, so no heavy database server installation is required.

## Tech Stack

* **Backend:** PHP (Native)
* **Database:** SQLite
* **Frontend:** HTML, CSS

## How to Run

### Prerequisites
* PHP installed on your machine.
* A browser.

### Installation Steps

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/YOUR_USERNAME/todo-app.git](https://github.com/YOUR_USERNAME/todo-app.git)
    cd todo-app
    ```

2.  **Start the local PHP server:**
    Open your terminal in the project folder and run:
    ```bash
    php -S localhost:8000
    ```

3.  **Initialize the Database:**
    Open your browser and visit:
    `http://localhost:8000/setup.php`
    *(This will create the necessary tables and the SQLite file).*

4.  **Use the App:**
    Go to `http://localhost:8000/register.php` to create your first account.

