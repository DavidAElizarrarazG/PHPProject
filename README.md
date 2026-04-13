# Employee Directory — PHP CRUD Final Project

A complete PHP CRUD application for managing an Employee Directory with 12 fields and multiple form control types.

## Requirements Met

| Requirement | Implementation |
|---|---|
| **Create** | Add new employees with a full form |
| **Read** (Report) | View all employees in a table |
| **Read** (Search) | Search by field (name, email, department, etc.) |
| **Update** (Modify) | Search and edit any employee record |
| **Delete** | Search, confirm, and delete an employee |
| **10+ fields** | 12 fields total |
| **Select** | Department & Status dropdowns |
| **Radio buttons** | Gender (Male / Female / Other) |
| **Checkboxes** | Skills (PHP, MySQL, JavaScript, HTML/CSS, Python) |
| **Textarea** | Bio |
| **Date control** | Hire Date |

## Database Fields

| # | Field | Type | Control |
|---|---|---|---|
| 1 | EmployeeID | INT (Auto PK) | — |
| 2 | FirstName | VARCHAR(100) | Text |
| 3 | LastName | VARCHAR(100) | Text |
| 4 | Email | VARCHAR(150) | Email |
| 5 | Phone | VARCHAR(20) | Tel |
| 6 | Department | VARCHAR(50) | Select |
| 7 | Gender | VARCHAR(10) | Radio buttons |
| 8 | Skills | VARCHAR(255) | Checkboxes |
| 9 | Bio | TEXT | Textarea |
| 10 | HireDate | DATE | Date |
| 11 | Salary | DECIMAL(10,2) | Number |
| 12 | Status | VARCHAR(20) | Select |

## Setup (Docker)

### Prerequisites
- Docker & Docker Compose installed

### 1. Start the containers
```bash
cd /path/to/this/project
docker compose up -d
```

This starts 3 services:

| Service | URL | Purpose |
|---|---|---|
| **Web** (PHP + Apache) | http://localhost:8080 | Serves the PHP application |
| **DB** (MySQL 8.0) | localhost:3306 | Database server |
| **phpMyAdmin** | http://localhost:8081 | Visual database manager |

### 2. Create the database table
Open in your browser:
```
http://localhost:8080/2026_setup.php
```

### 3. Use the application
Go to the main menu:
```
http://localhost:8080/2026_menu.html
```

### Stop the containers
```bash
docker compose down
```

### Stop and delete all data
```bash
docker compose down -v
```

## Database Credentials

| Setting | Value |
|---|---|
| Host | `db` (Docker) / `localhost` (native) |
| Database | `kashi` |
| Username | `user2025` |
| Password | `user2025` |

## File Structure

```
├── docker-compose.yml          # Docker setup (MySQL + PHP + phpMyAdmin)
├── 2026_menu.html              # Main menu
├── 2026_setup.php              # Database table creation
│
├── 2026_create.html            # Create form (all 12 fields)
├── 2026_create_process.php     # INSERT query
│
├── 2026_report.php             # View all employees
│
├── 2026_search.php             # Search form
├── 2026_search_process.php     # Search query
│
├── 2026_modify.php             # Modify - search form
├── 2026_modify_search.php      # Modify - editable form (pre-filled)
├── 2026_modify_process.php     # Modify - UPDATE query
│
├── 2026_delete.php             # Delete - search form
├── 2026_delete_search.php      # Delete - confirmation
└── 2026_delete_process.php     # Delete - DELETE query
```
