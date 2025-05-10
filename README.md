# 🎓 Arsi University Job Portal

A modern, full-featured web application built with **Laravel** and **Tailwind CSS (via Play CDN)**. This portal connects **jobseekers**, **employers**, and **administrators** within the Arsi University community, offering an elegant, scalable, and responsive job platform.

---

## 🚀 Features

### Jobseekers
- **Browse Jobs**: Filter and search by title, location, and job type. Jobs tagged with matching skills appear first.
- **Save Jobs**: Bookmark jobs for later reference.
- **Apply for Jobs**: Submit applications and upload resumes.
- **Resume Builder**: Create a profile-based resume in PDF.
- **Notifications**: Get real-time alerts on job status and system messages.
- **Profile System**: Add skills, links, and bio to your profile.

### Employers
- **Post Jobs**: Add new job listings with multiple tags and deadlines.
- **Manage Jobs**: View applications per job.
- **Analytics**: Track total applications, tag stats, and job matches.

### Admins
- **Approve/Reject Jobs**: Moderate employer job posts.
- **User Management**: View or delete users.
- **Job Management**: Approve, reject, or delete jobs.
- **Announcements**: Post event/resource announcements to jobseekers.

## 🧱 Technical Stack

- **Laravel 10**
- **Tailwind CSS** (via Play CDN)
- **Blade Templates**
- **MySQL**
- **Authentication**: Laravel built-in (web guard)
- **Authorization**: Role-based middleware

---
## 🧰 Setup Instructions

```bash
# Clone the repository
git clone https://github.com/antishman/arsijobportal.git
cd arsi-job-portal

# Install PHP dependencies
composer install

# Configure .env file
cp .env.example .env
php artisan key:generate

# Run migrations and seed default tags
php artisan migrate --seed

# Start development server
php artisan serve
```

---

# 📦 Database Architecture & Security – Arsi University Job Portal

This document outlines the database structure, normalization, security features, and backup strategies used in the **Arsi University Job Portal** built with Laravel.

---

## 🔐 Database Design & Security Principles

The platform is backed by a robust relational database using Laravel's Eloquent ORM.

---

### 🗃️ Database Relationships

| Relationship Type  | Models Involved                       | Description |
|--------------------|----------------------------------------|-------------|
| **One-to-Many**    | `User → Job`                           | Each employer can post multiple jobs. |
| **One-to-Many**    | `Job → Application`                    | Each job receives multiple applications. |
| **One-to-One**     | `User → Profile`                       | Each user has a unique extended profile. |
| **Many-to-Many**   | `User ↔ Tag`, `Job ↔ Tag`              | Users and jobs can be associated with multiple tags. |
| **One-to-Many**    | `User → Bookmark`, `Job → Bookmark`    | Users can bookmark multiple jobs. |
| **One-to-Many**    | `User (admin) → Announcement`          | Admins can post multiple announcements. |

Implemented using Eloquent methods (`hasMany`, `belongsTo`, `belongsToMany`, etc.) and enforced via migrations.

---


### 🔒 Security Features

#### ✅ Authentication & Roles
- Laravel session-based login
- Role-based access via middleware

#### ✅ CSRF Protection
- `@csrf` on all forms

#### ✅ SQL Injection Prevention
- ORM-based queries

#### ✅ Input Validation
- Laravel form validation

#### ✅ Password Hashing
- Secure bcrypt via `Hash::make()`

#### ✅ Session Expiry & Logout
- Session destroyed after logout
- Back-navigation restricted via `PreventBackHistory` middleware

---
### 📐 Normalization

1. **1NF** – Atomic fields
2. **2NF** – No partial dependencies
3. **3NF** – No transitive dependencies

Efficient schema with separate tables and foreign keys.

---

### 💾 Backup & Recovery

**Backup Command:**
```bash
mysqldump -u root -p arsijobportal > arsijobportal_backup.sql
```

**Restore Command:**
```bash
mysql -u root -p arsijobportal < arsijobportal_backup.sql
```

**Laravel Reset & Seed:**
```bash
php artisan migrate:fresh --seed
```

---
## 🎨 Design System

- **Primary**: `#002f66`
- **Accent**: `#FF6600`
- **Font**: [Inter](https://fonts.google.com/specimen/Inter)
- **Layout**: Responsive, grid-based dashboards
- **Icons**: Emojis + Heroicons

---

## ✅ Testing Overview

- **Unit Testing**: Form validation, access controls
- **Integration Testing**: Application flow, middleware checks
- **System Testing**: Full scenario testing (post jobs, apply, update profile)
- **Acceptance Testing**: Stakeholder validation

---

## 📚 Folder Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── JobController.php
│   │   │   ├── ApplicationController.php
│   │   │   ├── ResumeController.php
│   │   │   ├── ProfileController.php
│   │   │   └── AdminController.php
├── database/
│   ├── migrations/
│   └── seeders/TagSeeder.php
├── resources/
│   └── views/
│       ├── jobseeker/
│       ├── employer/
│       ├── admin/
├── routes/web.php
```

---
---

## 🙌 Credits

Developed by **CS students** for **Arsi University** using modern Laravel and Tailwind development practices.

---

## 📬 Contact

GitHub: [github.com/antishman/arsijobportal](https://github.com/antishman/arsijobportal)


