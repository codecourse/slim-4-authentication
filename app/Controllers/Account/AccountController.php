<?php

namespace App\Controllers\Account;

use Exception;
use Slim\Csrf\Guard;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class AccountController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $view;

    /**
     * ]
     *
     * @var [type]
     */
    protected $flash;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $routeParser;

    /**
     * Undocumented function
     *
     * @param Twig $view
     * @param Messages $flash
     * @param RouteParserInterface $routeParser
     */
    public function __construct(Twig $view, Messages $flash, RouteParserInterface $routeParser)
    {
        $this->view = $view;
        $this->flash = $flash;
        $this->routeParser = $routeParser;
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param [type] $response
     * @return void
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->view->render($response, 'pages/account/index.twig');
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param [type] $response
     * @return void
     */
    public function action(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email', 'emailIsUnique'],
            'first_name' => ['required'],
            'last_name' => ['required'],
        ]);

        Sentinel::check()->update(
            array_only($data, [
                'email', 'first_name', 'last_name'
            ])
        );

        $this->flash->addMessage('status', 'Account details updated!');

        return $response->withHeader('Location', $this->routeParser->urlFor('account'));
    }
}
