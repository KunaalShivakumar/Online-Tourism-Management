# Online Tourism Management

A PHP and MySQL tourism booking application with a modern public package browsing experience, inquiry form, account bookings, reviews, and an AdminLTE-powered admin area.

## Features

- Public tour package listing and detail pages
- Package image gallery, pricing, ratings, and reviews
- Customer booking requests and account dashboard
- Inquiry/contact form
- Admin dashboard for packages, bookings, inquiries, users, reviews, and system settings
- Environment-variable support for deployment configuration

## Requirements

- PHP 7.4 or newer
- MySQL or MariaDB
- Apache/Nginx web server
- PHP `mysqli` extension

## Local Setup

1. Clone the repository into your web root, for example `htdocs/tourism`.
2. Create a MySQL database named `tourism_db`.
3. Import [database/tourism_db.sql](database/tourism_db.sql).
4. Copy [.env.example](.env.example) to `.env` if your host loads environment files, or configure the same variables in your hosting panel.
5. Update `BASE_URL` to match your local URL, for example `http://localhost/tourism/`.
6. Open the app in your browser.

Public site:

```text
http://localhost/tourism/
```

Admin panel:

```text
http://localhost/tourism/admin/login.php
```

Default admin login:

- Username: `admin`
- Password: `admin123`

Change these credentials before deploying publicly.

## Deployment Notes

- This is a PHP/MySQL app, so GitHub Pages cannot run it directly. Push the code to GitHub, then deploy it to PHP-capable hosting such as shared hosting, a VPS, cPanel, Render/Railway-style PHP setup, or your own Apache/Nginx server.
- Point the web server document root to this project folder.
- Configure `BASE_URL`, `DB_SERVER`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_NAME` as environment variables on the host.
- Import the SQL dump from [database/tourism_db.sql](database/tourism_db.sql) into the production database.
- Keep `.env` and runtime uploads out of Git. This repository tracks only [uploads/.gitkeep](uploads/.gitkeep) so the uploads directory exists after clone.
- Make sure the web server can write to `uploads/` for package images, cover images, logos, and avatars.

## GitHub

This project includes a deployment-focused `.gitignore`, environment example, and clean README so it is ready to push to a GitHub repository.

```bash
git add .
git commit -m "Prepare tourism app for deployment"
git remote add origin YOUR_GITHUB_REPO_URL
git push -u origin main
```
