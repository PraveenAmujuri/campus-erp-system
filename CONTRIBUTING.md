# Campus ERP System - Contribution Guidelines

This project follows a modular Laravel architecture with clean separation of concerns to support scalability, maintainability, and collaborative development.

---

# Project Architecture

The application follows a layered architecture approach:

```text
Route
→ Controller
→ Request Validation
→ Service
→ Model
→ Database
```

---

# Folder Responsibilities

## Controllers

**Location**

```text
app/Http/Controllers/
```

**Responsibilities**

- Handle HTTP requests and responses
- Call service layer methods
- Return views or JSON responses

Controllers should remain thin and focused on request handling.

Avoid:

- Large business logic
- Complex calculations
- Long database queries inside controllers

---

## Requests

**Location**

```text
app/Http/Requests/
```

**Responsibilities**

- Validation
- Authorization
- Request sanitization

Use Form Request classes whenever possible.

**Examples**

```text
StoreStudentRequest
UpdateFeeRequest
```

---

## Services

**Location**

```text
app/Services/
```

**Responsibilities**

- Business logic
- Calculations
- Workflows
- Reusable module logic

**Examples**

- Fee calculations
- Report generation
- Audit logging

---

## Models

**Location**

```text
app/Models/
```

**Responsibilities**

- Database entities
- Relationships
- Query scopes

Models should represent database tables cleanly and consistently.

---

# Module Structure

Modules should be organized separately for better scalability and collaboration.

```text
app/
├── Services/
│   ├── Admission/
│   ├── Finance/
│   └── Academic/
│
├── Http/
│   ├── Controllers/
│   │   ├── Admission/
│   │   ├── Finance/
│   │   └── Academic/
│   │
│   └── Requests/
│       ├── Admission/
│       ├── Finance/
│       └── Academic/
```

---

# Naming Conventions

## Controllers

**Rule**

```text
PascalCase + Controller suffix
```

**Examples**

```text
StudentController
FeePaymentController
AttendanceController
```

---

## Models

**Rule**

```text
Singular PascalCase
```

**Examples**

```text
Student
FeePayment
AuditLog
```

**Avoid**

```text
studentModel
student_table
```

---

## Services

**Rule**

```text
PascalCase + Service suffix
```

**Examples**

```text
StudentService
FeeService
ReportService
```

---

## Request Classes

**Rule**

```text
Action + Entity + Request
```

**Examples**

```text
StoreStudentRequest
UpdateFeeRequest
```

---

## Migration Files

Use Laravel standard naming conventions.

**Examples**

```text
create_students_table
create_fee_payments_table
```

---

# Function Naming Rules

Use camelCase naming.

**Examples**

```php
createStudent()
generateReceipt()
calculateFee()
markAttendance()
```

**Avoid**

```php
Create_Student()
student_create()
```

---

# Variable Naming Rules

Use meaningful camelCase variable names.

**Examples**

```php
$studentFee
$admissionDate
$totalAmount
```

**Avoid**

```php
$a
$temp
$data1
```

unless used temporarily in loops.

---

# Database Naming Rules

## Table Names

Use plural snake_case naming.

**Examples**

```text
students
fee_payments
audit_logs
```

---

## Foreign Keys

Use:

```text
student_id
branch_id
category_id
```

Avoid:

```text
studentId
studentID
```

---

# Migration Rules

- Parent tables should be created before child tables
- Avoid modifying the same migration files simultaneously
- Keep migrations modular and readable

**Example Order**

```text
streams
→ branches
→ students
```

---

# Git Workflow

## Clone Repository

```bash
git clone <repo-url>
```

---

## Create Feature Branch

Always create a separate feature branch before starting work.

**Example**

```bash
git checkout -b finance-module
```

**Branch Examples**

```text
finance-module
admission-module
academic-module
auth-rbac
```

---

## Before Starting Work

Always pull the latest changes from the main branch.

```bash
git pull origin main
```

---

## Commit Changes

Use meaningful commit messages.

**Examples**

```text
Implement fee payment workflow
Add normalized branch relationships
Setup RBAC middleware structure
```

**Avoid**

```text
done
updated
fixed stuff
```

---

## Push Branch

```bash
git push origin finance-module
```

---

## Merge Workflow

- Complete features in separate branches
- Review changes before merging
- Merge into the main branch after testing

---

# Changelog and Update Guidelines

While pushing major changes:

- Update README if setup changes
- Mention important changes clearly in commit messages

---

# Code Formatting Rules

- Keep functions small and readable
- Avoid duplicate code
- Use proper indentation
- Use comments only where necessary
- Prefer reusable methods and services

---

# Validation Guidelines

Prefer Form Request validation instead of inline validation.

**Good**

```text
StoreStudentRequest
```

**Avoid**

```text
Large inline validation arrays inside controllers
```

---

# Architecture Guidelines

- Controllers should not contain heavy business logic
- Services should contain workflows and calculations
- Models should focus on relationships and database interactions
- Requests should handle validation and authorization

---

# Collaboration Rules

- Communicate before modifying shared or core files
- Avoid pushing directly into the main branch
- Avoid editing another module without discussion
- Test changes before pushing

---

# Branch Protection Rules

- Avoid direct pushes to main branch
- Use feature branches for development
- Test code before merging

---

# Project Goals

This project aims to maintain:

- Modular ERP architecture
- Scalable college management workflows
- Clean team collaboration workflow
- Normalized database relationships
- Maintainable and reusable codebase
- Proper separation of concerns
- Secure authentication and authorization structure
