<?php

namespace App\Controllers\Auth;

use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class SignOutController
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $routeParser;

    /**
     * Undocumented function
     *
     * @param RouteParserInterface $routeParser
     */
    public function __construct(RouteParserInterface $routeParser)
    {
        $this->routeParser = $routeParser;
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param [type] $response
     * @return void
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        Sentinel::logout();

        return $response->withHeader('Location', $this->routeParser->urlFor('home'));
    }
}
