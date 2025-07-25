# 🎯 Online Quiz System

This is a Laravel-based Online Quiz System developed as part of a task submission.

## 📂 Project Link

GitHub: [https://github.com/aki961996/quiz](https://github.com/aki961996/quiz)

## 🚀 Features

- User Registration & Login
- Forgot Password (Email-based)
- Create & Manage Quizzes
- Take Quiz & View Results
- Answer Tracking and Score Calculation

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10
- MySQL / MariaDB


## 🛠️ Installation Steps

1. **Clone the repository**
   ```bash
     git clone https://github.com/aki961996/quiz.git
     cd quiz

    composer install
    npm install && npm run dev
    
    cp .env.example .env
    Set database credentials in .env file
    
    php artisan key:generate
    
    php artisan migrate 
    
    php artisan db:seed --class=QuizSeeder 
    
    php artisan serve

