# Backend - Online Learning Platform

This is the backend part of the Online Learning Platform. It is built with Laravel and provides API endpoints to manage courses, lessons, user authentication, and more.

## Technologies Used

- **Laravel** - PHP framework for building the backend
- **MySQL** - Database for storing course and user data
- **JWT (JSON Web Token)** - For user authentication
- **Axios** - Used by the frontend to interact with API endpoints
- **Artisan** - Command-line tool for Laravel to handle various tasks like migrations, seeding, etc.

## Setup and Installation

### Prerequisites

- PHP (v8 or later)
- Composer (Dependency manager for PHP)
- MySQL or MariaDB

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/online-learning-platform-backend.git
    ```

2. Install the dependencies:
    ```bash
    cd online-learning-platform-backend
    composer install
    ```

3. Set up your `.env` file:
    - Copy the `.env.example` file to `.env`.
    - Set up the database and JWT settings in `.env`.

    Example `.env`:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=online_learning
    DB_USERNAME=root
    DB_PASSWORD=yourpassword

    JWT_SECRET=your-jwt-secret
    ```

4. Generate the application key:
    ```bash
    php artisan key:generate
    ```

5. Run database migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

6. Run the development server:
    ```bash
    php artisan serve
    ```

    The API will be available at `http://localhost:8000`.

## Available API Endpoints

- `POST /api/register` - Register a new user.
- `POST /api/login` - User login and JWT token generation.
- `GET /api/courses` - Get a list of all courses.
- `GET /api/courses/{id}` - Get a detailed view of a course.
- `POST /api/courses` - Create a new course (Instructor only).
- `PUT /api/courses/{id}` - Update a course (Instructor only).
- `DELETE /api/courses/{id}` - Delete a course (Instructor only).
- `GET /api/courses/{courseId}/lessons` - Get a list of lessons in a course.
- `POST /api/courses/{courseId}/lessons` - Create a new lesson in a course.
- `PUT /api/courses/{courseId}/lessons/{lessonId}` - Update a lesson.
- `DELETE /api/courses/{courseId}/lessons/{lessonId}` - Delete a lesson.

## Authentication

- User authentication is handled using JWT (JSON Web Tokens).
- Use the `Authorization` header with `Bearer <JWT_TOKEN>` to authenticate API requests.

## Deployment

1. Set up your production environment.
2. Deploy to your desired hosting provider (e.g., DigitalOcean, AWS, Heroku, etc.).
3. Ensure that the `JWT_SECRET` and database settings are configured properly for production.

---

## Notes

- **CORS**: Ensure your backend is set up to handle CORS if you're serving the frontend and backend from different domains. You can configure CORS in Laravel via the `config/cors.php` file.
- **File Uploads**: For storing files like course materials and lesson videos, you can set up file storage with Laravel's file storage system.

