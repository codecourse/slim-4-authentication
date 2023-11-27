<?php

namespace App\Providers;

use App\Middleware\RedirectIfGuest;
use Slim\Interfaces\RouteParserInterface;
use App\Middleware\RedirectIfAuthenticated;
use League\Container\ServiceProvider\AbstractServiceProvider;

class MiddlewareServiceProvider extends AbstractServiceProvider
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $provides = [
        RedirectIfGuest::class
    ];

    protected $routeParser;

    public function __construct(RouteParserInterface $routeParser)
    {
        $this->routeParser = $routeParser;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function register()
    {
        $container = $this->getContainer();

        $container->add(RedirectIfGuest::class, function () use ($container) {
            return new RedirectIfGuest(
                $container->get('flash'),
                $this->routeParser
            );
        });

        $container->add(RedirectIfAuthenticated::class, function () use ($container) {
            return new RedirectIfAuthenticated();
        });
    }
}
