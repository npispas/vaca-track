# VacaTrack - Employee Vacation Management System

## 🚀 About the Project
VacaTrack is a fictional **Employee Vacation Management System** that allows employees to request vacation days online while ensuring managers can approve or reject vacation requests. The system enforces **role-based access control** and ensures vacation constraints such as **annual leave limits**.

## 📌 Features
- ✅ **User Authentication & Authorization** (Employees & Managers)
- ✅ **Vacation Requests with Approval Workflow**
- ✅ **Role-Based Access Control (RBAC)**
- ✅ **Annual Leave Balance Calculation (Dynamic)**
- ✅ **Session-Based User Handling**
- ✅ **Error Pages (401 Unauthorized, 403 Forbidden, 404 Not Found)**
- ✅ **Flash Messages & Toaster Notifications**
- ✅ **Bootstrap for UI Enhancements**

---

## 🛠️ Tech Stack
- **Backend:** PHP 8+, Eloquent ORM (without Laravel Facades)
- **Frontend:** Twig, Bootstrap
- **Database:** MariaDB
- **Architecture:** MVC (Model-View-Controller)
- **Session Handling:** PHP Sessions
- **Containerization:** Docker & Docker Compose

---

## 📋 Prerequisites
Before installing, ensure you have the following:
- ✅ **Docker & Docker Compose** installed
- ✅ **PHP 8+** installed (if running outside Docker)
- ✅ **Composer** (PHP dependency manager)
- ✅ **Node.js & npm** (for frontend assets)

---

## 📦 Installation & Setup
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/npispas/vaca-track.git
cd vacatrack
```

### **2️⃣ Set Up Environment Variables**
Create a `.env` file or copy `.env.example` in the project root:
```
APP_DEBUG=
APP_TIMEZONE=
APP_NAME=
APP_VACATION_DAYS=

DB_HOST=
DB_NAME=
DB_USER=
DB_PASS=
```

### **3️⃣ Start Docker Services**
```sh
make up
```

### **4️⃣ Install Dependencies**
```sh
make composer-install
make npm-install
```

### **5️⃣ Run Database Migrations & Seeder**
```sh
make migrate
make seed
```

---

## ⚙️ Development
### **🏗️ Project Structure**
```
├── docker/
├── src/
│   ├── app/
│   │   ├── Config/
│   │   ├── Controllers/
│   │   ├── Core/
│   │   ├── Database/
│   │   ├── Libraries/
│   │   ├── Middleware/
│   │   ├── Models/
│   │   ├── Views/
│   │   ├── bootstrap.php
│   ├── public/
```

### **📌 Available Makefile Commands**
| Command                 | Description                          |
|-------------------------|--------------------------------------|
| `make up`               | Start Docker containers              |
| `make down`             | Stop and remove containers           |
| `make restart`          | Restart containers                   |
| `make logs`             | Print docker logs                    |
| `make install`          | Install PHP and Node.js dependencies |
| `make migrate`          | Run database migrations              |
| `make rollback`         | Rollback last database migration     |
| `make seed`             | Seed database with sample data       |
| `make composer-install` | Install composer dependencies        |
| `make npm-install`      | Install npm dependencies             |


### **📌 Code Formatting**
Use PHP CS Fixer before committing:
```sh
make fix
```

---

## 📖 License
This project is licensed under the **GNU GPL-3.0-or-later** License.

---

## 📫 Contact & Contributions
Feel free to contribute to the project! Open issues or submit a pull request.

🌟 **Created by Nikolaos Pispas**
📧 [npispasl@gmail.com](mailto:npispas@gmail.com)

