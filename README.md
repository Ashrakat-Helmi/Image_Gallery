# Image Gallery Website
-Upload images.
-View images.

## Features

- User authentication: Users can register, login, and manage their accounts.
- Image uploading: Users can upload images to the gallery.
- Image management: Users can view, edit, and delete their own images.
- Image gallery: Users can browse all uploaded images.
- Pagination: Images are displayed in a paginated manner to enhance performance.
- Filtering and sorting: Users can filter and sort images based on different criteria.
- Fancybox: Users can view images in a stylish lightbox using the Fancybox library.
- jQuery form validation: Forms are validated on the client-side using jQuery.
- SweetAlert: Users are presented with attractive and interactive alerts using SweetAlert.

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL database
- Laravel 9
- Bootstrap 5
- Laravel UI Auth
- jQuery
- Fancybox from Fancyapps
- SweetAlert

## Installation

1. Clone the repository to your local machine:

```
git clone https://github.com/your/repository.git
```

2. Navigate to the project directory:

```
cd image-gallery
```

3. Install dependencies using Composer:

```
composer install
```

4. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration settings in the `.env` file with your MySQL database credentials.

5. Generate an application key:

```
php artisan key:generate
```

6. Run migrations to create the necessary database tables:

```
php artisan migrate
```

7. Publish the Laravel UI Auth views and assets:

```
php artisan ui bootstrap --auth
```

8. Install npm dependencies:

```
npm install
```

9. Build the assets:

```
npm run dev
```

10. Start the development server:

```
php artisan serve
```

11. Access the website in your browser using the URL provided by the development server.

## Usage

1. Register a new user account or log in with an existing account.
2. Upload images to the gallery.
3. Browse the gallery, filter and sort the images.
4. Click on an image to view it in the Fancybox lightbox.
5. Edit or delete your own images as needed.
6. Log out when you're done.

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository on GitHub.
2. Create a new branch with a descriptive name for your feature or bug fix.
3. Make your changes and commit them with clear and concise messages.
4. Push your changes to your forked repository.
5. Submit a pull request to the main repository detailing your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Acknowledgments

This project uses the following open-source libraries:

- Laravel - https://laravel.com/
- Bootstrap - https://getbootstrap.com/
- Laravel UI - https://github.com/laravel/ui
- jQuery - https://jquery.com/
- Fancybox from Fancyapps - https://fancyapps.com/fancybox/
- SweetAlert - https://sweetalert.js.org/

## Contact

If you have any questions or issues, please contact the project maintainer at ashrakat5elkady@gmail.com
