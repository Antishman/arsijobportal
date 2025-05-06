# Arsi University Job Portal

A modern web application developed using **Laravel** and **Tailwind CSS**, designed to connect **jobseekers**, **employers**, and **administrators** through a seamless experience tailored for Arsi University students and partners.

---

## 🚀 Features Overview

### 🧑‍💼 Jobseekers

#### 🔍 Browse Jobs

* Explore all posted jobs with filters (by title, category, location, and date).
* Paginated list for user-friendly navigation.

#### 💾 Save Jobs

* Bookmark jobs for later viewing.
* View all saved jobs in one place.

#### 📨 Apply for Jobs

* Submit applications directly through the portal.
* Prevent duplicate applications.

#### 📝 Resume Builder

* Create and update a professional resume using a guided form.
* Downloadable PDF format (future enhancement).

#### 🔔 Notifications

* Get notified when employers interact with your application.
* See unread and read notifications.

#### 📢 Announcements

* Receive university-wide or jobseeker-targeted announcements.
* View announcements in a clean panel with external resource links.

#### 👤 Dashboard

* Personalized dashboard showing saved jobs, announcements, and new notifications.
* Elegant UI with icons, colors, and responsive layout.

---

### 🏢 Employers

#### 📄 Post Jobs

* Employers can create job posts with title, description, requirements, and location.
* Each job defaults to `pending` until approved by an admin.

#### 🗂 Manage Posted Jobs

* View all posted jobs.
* Delete jobs at any time.
* Access applications received for each job.

#### 📥 View Applications

* For each job, see the list of applicants.
* View resumes and profiles of jobseekers.

#### 👤 Dashboard

* Employer-focused view showing job post history.
* Access to create jobs, view applications.

---

### 🛠️ Admin

#### 📢 Manage Announcements

* Create, edit, and delete announcements for jobseekers and employers.
* Optional links for external resources.

#### 📊 Site Analytics

* Dashboard with counts of jobseekers, employers, jobs, and applications.
* Simple overview cards with icons.

#### 👥 Manage Users

* View list of all users.
* See roles and emails.
* Delete users directly.

#### 📌 Manage Jobs

* View all jobs posted.
* Approve, reject, or delete jobs.
* Monitor job activity.

---

## 🧱 Tech Stack

* **Laravel 10** - backend framework
* **Tailwind CSS** - modern utility-first UI framework
* **Blade Templates** - server-side rendering
* **MySQL** - database
* **Authentication** - Laravel Breeze&#x20;

---

## 📁 Folder Structure (Key Files)

```
├── app/Http/Controllers
│   ├── JobController.php
│   ├── ApplicationController.php
│   ├── ResumeController.php
│   ├── AdminController.php
│   └── AnnouncementController.php
├── resources/views
│   ├── jobseeker/dashboard.blade.php
│   ├── employer/dashboard.blade.php
│   ├── admin/dashboard.blade.php
├── routes/web.php
├── public/
└── database/migrations/
```

---

## 🧪 Testing & Validation

* Forms include CSRF protection.
* Confirm dialogs before destructive actions (deleting users, jobs).
* Session-based flash messages for feedback.
* Validation rules applied to forms.

---

## 🎨 Design System

* **Colors**: Primary `#002f66`, Accent `#FF6600`, Light Grays
* **Fonts**: [Inter](https://fonts.google.com/specimen/Inter)
* **Icons**: Emoji-enhanced sections for visual clarity
* **Responsive**: Tailwind breakpoints used for all layouts

---

## ✅ Future Enhancements

* PDF Resume Download
* Job Expiry and Archive System
* Employer Verification Workflow
* Advanced Notification Panel
* Role-based Permissions (Gate & Policies)

---

## 🔒 Authentication & Roles

* Auth middleware controls access.
* Roles defined: `jobseeker`, `employer`, `admin`
* Route-level protections to prevent unauthorized actions

---

## 📎 Setup Instructions

```bash
# Clone the repo
git clone https://github.com/antishman/arsijobportal.git
cd arsi-job-portal

# Install dependencies
composer install
npm install && npm run dev

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database
php artisan migrate --seed

# Run the server
php artisan serve
```

---

## 🙌 Credits

* Developed for Arsi University
* UI/UX designed with accessibility and clarity in mind

---

## 📬 Contact

For questions, suggestions or contributions: **Tele**:+251222380252  **GitHub**: \[[LINK](https://github.com/antishman/arsi-job-portal.git)]

---

*Thank you for using Arsi University's Job Portal!*
