<?php
require_once 'config.php';
require_once 'router/Router.php';
require_once 'controllers/PostController.php';

// Create the Router object
$router = new Router();

// Define the routes (without expecting an ID in the path)
$router->addRoute('/', 'PostController', 'index');
$router->addRoute('/create', 'PostController', 'create');
$router->addRoute('/edit', 'PostController', 'edit');  // Edit action (with query string for ID)
$router->addRoute('/delete', 'PostController', 'delete');  // Delete action (with query string for ID)
$router->addRoute('/view', 'PostController', 'view');


// Get the current URL path (without query string)
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// DEBUG: Show the requested URL to confirm it's correct
//echo "Requested URL: " . $url . "<br>";  // Debugging line

// Remove '/blog' part of the URL for matching if hosted under a subdirectory
$url = str_replace('/blog', '', $url);  // Adjust this if necessary based on your setup

//echo "Cleaned URL: " . $url . "<br>";  // Debugging line

// Dispatch to the router
$router->dispatch($url);
