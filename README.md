## Laravel 10 + Inertia.js + Vue 3 -> single page application

<div style="display: flex;">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/985px-Laravel.svg.png" alt="Laravel Logo" style="width: 40px;">
  <img src="https://user-images.githubusercontent.com/79047182/222930653-4c8079bc-30f0-43e1-9c63-b50a9ad68320.png" alt="image" style="width: 40px;">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png" alt="Vue.js Logo" style="width: 40px;">
 <img src="https://ih1.redbubble.net/image.2428884987.0603/st,small,507x507-pad,600x600,f8f8f8.jpg" alt="Redbubble Image" style="width: 40px;">
</div>
<br>
The application is designed to provide a smooth and interactive user experience. This SPA offers an all-in-one solution for managing users and roles, featuring an easy-to-use dashboard for administrators.

## Preview

[gif.webm](https://user-images.githubusercontent.com/79047182/222930543-9883369c-1d8f-4985-9b61-baa933122596.webm)

## Installation

To get started with the installation, follow these steps:

1. Clone the repository
``git clone https://github.com/hminvozone/venues-dashboard.git``

2. Enter project directory
``cd venues-dashboard``

3. Install/update composer
``composer install | composer update``

4. Install npm
``npm install``

5. Set up the environment variables
``cp .env.example .env``

6. Set up the email configurations in .env

7. Generate an application key
``php artisan key:generate``

8. Configure the database
``php artisan migrate``

9. Configure the database
   ``php artisan db:seed``

10. Start the development server
``npm run dev``

11. Start the development server
   ``php artisan serve``

11. Setup the queues in .env
    ``QUEUE_CONNECTION=database``

12. Start the queue jobs
   ``php artisan queue:work``

13. Visit the application at in the browser.

## Laravel Valet Instalattion
To install Laravel Valet follow this link https://gist.github.com/bradtraversy/b58f74cd863a465068eaeaae1544d9be

## License

This project is licensed under the MIT License. See the [LICENSE.md](LICENSE.md) file for details.
