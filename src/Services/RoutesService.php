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
            $routeName = $route->getName();
            $routeUri = $route->uri();

            if (self::isResourceRoute($routeName, $routeUri)) {
                $resourceList[$routeUri] = $routeUri;
            }
        }

        return $resourceList;
    }

    private static function isResourceRoute($routeName, $routeUri)
    {
        $resourcePatterns = [
            '.index',
            '.create',
            '.show',
        ];

        if ($routeName) {
            foreach ($resourcePatterns as $pattern) {
                if (str_ends_with($routeName, $pattern)) {
                    return true;
                }
            }
        }

        $resourceUriPattern = '/^[a-zA-Z0-9_-]+(\/\{[a-zA-Z0-9_-]+\})?$/';
        if (preg_match($resourceUriPattern, $routeUri)) {
            return true;
        }

        return false;
    }
}
