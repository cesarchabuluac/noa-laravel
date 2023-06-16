## About the base project with the NOA template

## Run composer

```composer install```

## Run npm

```npm install```

- After compiling the assets

```npm run dev```

## Clone .env.example

# windows
``` copy .env.example .env```

# linux
``` cp .env.example .env```

# Edit .env

- Edit the .env file and add the necessary database configurations
- Generate the app_key by running the command:
```php artisan key:generate```

- Generate the symbolic link for the storage folder where the avatars or images that are generated in the system will be stored
```php artisan storage:link```

## Run migration & seeders
- The main seeder creates the first user assigned its corresponding role and the corresponding permissions from the USER catalog

```php artisan migrate --seed```

## Spatie Permissions & Roles 
- https://spatie.be/docs/laravel-permission/v5/introduction

- To add more permissions per catalog using the controller verbs (index, create, show, store, update, destroy) should be created based on the RolesAndPermissionsSeeder example.

## Administrator default

- user: admin@demo.com
- password: 123456