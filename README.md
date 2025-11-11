# 🚀 THR — Laravel Starter Project

This is a **Laravel Breeze-based web application** built with authentication, modern front-end tooling, and database migrations.

---

## 🧩 Features

- Laravel 11 + Breeze Authentication
- Blade / React-ready frontend setup
- Database migrations included
- Modern asset pipeline using Vite
- Ready for free cloud deployment (Render)

---

## ⚙️ Local Installation

### 🪄 1. Clone the Repository
```bash
git clone https://github.com/kmht1/THR.git
cd THR
🧱 2. Install PHP Dependencies
Make sure you have PHP ≥ 8.1 and Composer installed. Then run:

bash
Copy code
composer install
💻 3. Install Node.js Dependencies
Ensure you have Node.js ≥ 18 and npm installed:

bash
Copy code
npm install
npm run build
During development, use npm run dev instead.

⚙️ 4. Create Environment File
Copy the example environment file:

bash
Copy code
cp .env.example .env
Then open .env and configure your database:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thr
DB_USERNAME=root
DB_PASSWORD=
🔑 5. Generate Application Key
bash
Copy code
php artisan key:generate
🗄️ 6. Run Database Migrations
bash
Copy code
php artisan migrate
🚀 7. Start the Development Server
bash
Copy code
php artisan serve
Now visit:
👉 http://localhost:8000

☁️ Deployment (Free Hosting with Render)
🧰 1. Push Your Code to GitHub
If you haven’t already:

bash
Copy code
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/kmht1/THR.git
git push -u origin main
🌍 2. Create a Free Render Account
Go to https://render.com and sign up with GitHub.

⚙️ 3. Deploy the App
Click “New +” → Web Service

Select your THR repo

Use the following settings:

Build Command:
bash
Copy code
composer install && php artisan key:generate && php artisan migrate --force
Start Command:
bash
Copy code
php artisan serve --host 0.0.0.0 --port $PORT
Choose the Free Tier plan

Click Deploy Web Service

Render will build and host your app automatically 🎉
Once it’s done, you’ll get a live URL like:

arduino
Copy code
https://thr.onrender.com
🗄️ Optional: Add a Free PostgreSQL Database
In Render dashboard → New → PostgreSQL

Copy the credentials and update your .env:

env
Copy code
DB_CONNECTION=pgsql
DB_HOST=your-hostname
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
Redeploy your app.

🧹 Optimize for Production
Before deploying, run:

bash
Copy code
php artisan config:cache
php artisan route:cache
php artisan view:cache
🧑‍💻 Tech Stack
Framework: Laravel 11

Frontend: Breeze (Blade/React-ready)

Database: MySQL / PostgreSQL

Server: PHP 8.2+

Deployment: Render Free Tier

🪪 License
This project is open-source and available under the MIT license.

✨ Author
Developed by KMHT 10
GitHub: @kmht1
