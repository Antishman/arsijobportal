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


## 🧾 Database Relationships

- `User` hasOne `Resume`, hasMany `Applications`, belongsToMany `Tags`
- `Job` belongsTo `User` (employer), hasMany `Applications`, belongsToMany `Tags`
- `Application` belongsTo `User`, belongsTo `Job`
- `Bookmark` tracks jobseeker saved jobs

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


