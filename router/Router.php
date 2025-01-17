<?php
class Router
{
    private $routes = [];

    // Add a route to the router
    public function addRoute($route, $controller, $action)
    {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    // Dispatch the URL to the correct controller
    public function dispatch($url)
    {
        // DEBUG: Show available routes
        //echo "Available Routes: ";
        //print_r($this->routes);  // Debugging line

        // Loop through the defined routes
        foreach ($this->routes as $route => $params) {
            // Match routes like '/edit' and check for query parameters (e.g., '?id=1')
            if (preg_match("#^$route(/([0-9]+))?$#", $url, $matches)) {
                $controllerName = $params['controller'];
                $action = $params['action'];
                $controller = new $controllerName();

                // Check if the URL has a query string (e.g., ?id=1)
                if (isset($_GET['id'])) {
                    $controller->$action($_GET['id']);  // Pass the ID from the query string
                } else {
                    $controller->$action();  // Call the action without an ID
                }
                return;
            }
        }

        // If no route matches, show 404
        echo "404 Not Found: The page does not exist.";
    }
}
