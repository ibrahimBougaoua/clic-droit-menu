<?php

namespace IbrahimBougaoua\ClicDroitMenu\Services;

use Illuminate\Support\Facades\Route;

class RoutesService
{
    public static function getResourceRoutes()
    {
        $routes = Route::getRoutes();
        $resourceList = [];

        foreach ($routes as $route) {
            $routeName = $route->getName(); // Get the route name
            $routeUri = $route->uri(); // Get the route URI

            // Check if the route name or URI follows resource route patterns
            if (self::isResourceRoute($routeName, $routeUri)) {
                // Combine route name and URI for display
                $resourceList[$routeUri] = $routeUri;
            }
        }

        return $resourceList;
    }

    private static function isResourceRoute($routeName, $routeUri)
    {
        // Define the resource patterns to match
        $resourcePatterns = [
            '.index',
            '.create',
            '.show',
        ];

        // Check if the route name ends with any of the resource patterns
        if ($routeName) {
            foreach ($resourcePatterns as $pattern) {
                if (str_ends_with($routeName, $pattern)) {
                    return true;
                }
            }
        }

        // Additional check: Basic URI pattern matching for resources
        // You can expand this pattern as per your application's needs
        $resourceUriPattern = '/^[a-zA-Z0-9_-]+(\/\{[a-zA-Z0-9_-]+\})?$/';
        if (preg_match($resourceUriPattern, $routeUri)) {
            return true;
        }

        return false;
    }
}
