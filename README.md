Summary of the steps taken during this short test using laravel and laradock.

#LARAVEL

##1. Setting Up the Environment
a) Laravel Installation

    Laravel is a PHP framework used for building web applications. To get started, you need a working PHP environment with some essential tools (like Composer) that manage dependencies and install Laravel packages.

    Steps:
        We installed PHP, Composer (a PHP package manager), and Docker.
        Then, we used Composer to create a new Laravel project: composer create-project --prefer-dist laravel/laravel test01.

b) Environment Configuration

    Laravel needs certain environment variables to function, such as the app's encryption key (APP_KEY), database connection settings, etc. These variables are stored in the .env file.

    When you generate a new Laravel project, an example environment file .env.example is copied to .env. We used the command php artisan key:generate to automatically generate an encryption key for your app and insert it into .env.

c) Development Server

    Laravel comes with a built-in development server, which can be run using:

    bash

    php artisan serve

    This server is useful for local development and testing purposes. It allows you to quickly serve your Laravel application on http://localhost:8000.

    Key takeaway: We didn’t need to install or configure any external server like Apache or Nginx for local development. Laravel’s built-in server handled the web requests while we are coding.

2. Raising the Server
a) PHP Artisan

    php artisan is Laravel’s command-line interface. It allows you to perform a variety of tasks, such as generating encryption keys, clearing caches, running migrations, and starting a development server.

    In our case, the command php artisan serve started the development server, which listens on port 8000 by default.

b) Without Laradock

    For this setup, we didn’t use Laradock (a Docker environment specifically for Laravel projects). Laradock is useful when you need a containerized development environment (which includes things like Nginx, MySQL, Redis, etc.).

    In this case, we simply used Laravel’s built-in server (php artisan serve) instead of running the app inside Docker containers via Laradock. It’s a much simpler setup, and ideal for a quick demo. However, if you wanted a more "production-like" environment, you could set up Laradock to run the web server (Nginx) and database (MySQL) inside Docker containers.

3. Routes and Views
a) Routes

    In Laravel, routes define how URLs map to specific logic in the application (controllers or closures). When you visit a URL, Laravel looks for a matching route and executes the corresponding code.

    Example:

    php

    Route::get('/', function () {
        return view('index');
    });

        This defines a route that listens for GET requests to / (the homepage). When a user visits the home page, Laravel runs the closure (in this case, it returns the view index).

    Route structure: You define routes in the routes/web.php file for web-based routes. There are other files (like routes/api.php) for API routes.

b) Views

    Views are the HTML templates that the user sees. Laravel uses Blade as its templating engine to dynamically generate HTML based on data.

    Blade syntax: Laravel's Blade engine allows you to easily insert dynamic data into the HTML. While our example didn’t include dynamic data, it did serve static HTML files (index.blade.php and about.blade.php).

    Example:

    php

    return view('index');

        This tells Laravel to load the Blade view located at resources/views/index.blade.php. When the view is rendered, it's converted into regular HTML that gets sent to the browser.

4. Did We Use Laradock?

In this specific setup, no, we didn’t use Laradock. Instead, we relied on Laravel’s built-in PHP server for a quick local development environment. Here’s a breakdown:

    Laradock is a Docker environment that allows you to run your application inside isolated containers. These containers might include services like Nginx (web server), MySQL (database), Redis, etc.
    If you wanted to use Laradock, you would use Docker to "containerize" your app and run it in a more production-like environment.

However, for a simple local development setup like this, Laradock is overkill unless you need more complex services (e.g., databases, multiple servers). The built-in PHP server (php artisan serve) is perfect for small applications or demos.

If you ever needed to use Laradock for a bigger project, you would:

    Clone Laradock into your project folder.
    Use Docker to start services like Nginx, MySQL, etc.
    Run the app through those Docker containers, accessing it through http://localhost or a specific port.

But in this case, we kept it simple with the built-in server.
5. Summary of Key Concepts

    Laravel: A PHP framework designed to simplify web development with features like routing, Blade templating, and database interaction.

    Environment Setup:
        We set up Laravel by installing PHP, Composer, and dependencies.
        We generated an encryption key for the app and used Laravel’s built-in development server.

    Routes: Defined in routes/web.php, they map URLs to specific actions (like returning a view). Each route tells Laravel what to do when a specific URL is visited.

    Views: Blade templates that generate HTML. We created two simple views (home and about), each linked to a route.

    Development Server: Laravel’s built-in server (php artisan serve) allows you to quickly run your app locally without needing extra configuration.

    Laradock: We didn’t use Laradock, but it’s a tool that helps you run your Laravel app inside Docker containers. For this demo, it wasn't necessary.

# LARADOCK

1. Cloning Laradock into the Laravel Project

We cloned the Laradock repository into the Laravel project directory:

bash

git clone https://github.com/laradock/laradock.git

What is Laradock?

    Laradock is a collection of Docker containers that are pre-configured to provide all the services that a Laravel application typically needs (like Nginx, MySQL, Redis, etc.).
    Docker containers are lightweight virtual environments that can run isolated services. In this case, we're using Docker to create an isolated environment where Nginx serves the app and MySQL handles the database, without installing them directly on your machine.

2. Configuring Laradock

We copied the example .env file to customize the settings for Laradock:

bash

cp .env.example .env

What we did here:

    This .env file contains configuration options for all the services managed by Laradock (Nginx, MySQL, PHP versions, etc.).
    Key settings we paid attention to:
        PHP_VERSION to ensure compatibility with our Laravel app.
        NGINX_HOST_HTTP_PORT, which defines the port Nginx uses to serve the app.
        MYSQL_PORT, which tells MySQL which port to listen to.

We also adjusted the configuration to avoid conflicts with other services on your machine, like Apache.

3. Starting the Docker Containers

To launch the necessary services, we used:

bash

docker-compose up -d nginx mysql

Explanation:

    docker-compose is a tool that reads the docker-compose.yml file inside the Laradock directory. This file specifies which services (containers) should be started and how they should interact.

    The command up -d nginx mysql starts two specific services:
        Nginx: This is the web server that serves your Laravel app to your browser.
        MySQL: This is the database server that Laravel uses to store and retrieve data.

    The -d flag makes these containers run in the background (detached mode).

Once the containers are up and running, your Laravel app is being served by Nginx through Docker, while MySQL is available for database interactions.

4. Adjusting the Laravel .env File

We needed to configure Laravel to use the MySQL container that Laradock is running.

We edited Laravel’s .env file to match the settings for Laradock’s MySQL container:

bash

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root

Explanation:

    DB_HOST=mysql: This points to the MySQL Docker container that Laradock is running (the container's service name is mysql).
    DB_PORT=3306: This is the default port MySQL listens on inside the container.
    DB_USERNAME and DB_PASSWORD: These are the default credentials set by Laradock’s MySQL configuration.

By doing this, we ensured that Laravel connects to the MySQL database running inside the Docker container, rather than any database running locally on your machine.

5. Accessing the Laravel Application

Once the services (Nginx and MySQL) were running and Laravel was properly configured, we accessed the Laravel app through:

bash

http://localhost

Initially, you were seeing Apache's default page because Apache was running on your system and occupying port 80, which conflicted with Laradock's Nginx.

To fix this:

    Option 1: We stopped Apache to allow Laradock’s Nginx to use port 80.
    Option 2: Alternatively, we could have changed the Nginx port in the Laradock .env file to something like 8080 to avoid the conflict, then accessed the app at http://localhost:8080.

After resolving this conflict, visiting http://localhost (or http://localhost:8080) showed the Laravel app running through the Nginx container.

6. What We Achieved

At the end of the process:

    Nginx (running in a Docker container) is serving your Laravel app.
    MySQL (running in another Docker container) is handling the database for your Laravel app.
    The app is isolated inside Docker containers, which means it's easy to manage, portable, and won’t interfere with other system services like Apache or local MySQL installations.

How the Docker Setup Works:

    Nginx container: This container acts as the web server, handling HTTP requests and serving your Laravel app.
    MySQL container: This container is the database server, which Laravel connects to for data storage and retrieval.
    Both containers are isolated but can communicate with each other internally (i.e., Laravel can connect to MySQL using the hostname mysql, which is defined inside Docker).

7. Recap: The Role of Laradock and Docker

    Laradock simplifies the process of setting up a full development environment by providing pre-configured Docker containers.
    Docker allows you to run isolated services (Nginx, MySQL, Redis, etc.) in containers, which means you don’t need to install or configure these services directly on your host machine.
    With Laradock, you can easily start/stop these containers, switch between different PHP versions, and add additional services as needed, like Redis or Elasticsearch.