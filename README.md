## Task Management App

This web application is built with Laravel for task management. There, you can create projects, then tasks under each of the projects added. Tasks are ordered based on their priorities.
The app includes a drag and drop functionality to reorder tasks based on priority, and they are automatically updated.
Projects and tasks can be created, edited and deleted.

The app can be accessed with the following details:
- sam@example.com
- 123456

## Running the App
- download the project
- run composer install
- rename .env.example file to .env, and set up your configurations
- create a database and set the name in the .env file, alongside your other DB configurations
- run the following commands:
```
composer install
```

```
php artisan key:generate
```

```
php artisan migrate
```

```
php artisan db:seed --class=UserSeeder
```

```
php artisan db:seed --class=ProjectSeeder
```

```
php artisan serve
```

- access the project from your browser with 127.0.01:8000 or localhost:8000 (depending on your configuration).
