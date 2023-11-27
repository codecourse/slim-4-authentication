<?php

namespace App\Controllers\Auth;

use Exception;
use Slim\Csrf\Guard;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use App\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class SignInController extends Controller
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
        return $this->view->render($response, 'pages/auth/signin.twig', [
            'redirect' => $request->getQueryParams()['redirect'] ?? null
        ]);
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
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);        

        try {
            if (
                !$user = Sentinel::authenticate(
                    array_only($data, ['email', 'password']),
                    isset($data['persist'])
                )
            ) {
                throw new Exception('Incorrect email or password');
            }
        } catch (Exception $e) {
            $this->flash->addMessage('status', $e->getMessage());

            return $response->withHeader(
                'Location', $this->routeParser->urlFor('auth.signin')
            );
        }

        return $response->withHeader(
            'Location', $data['redirect'] ? $data['redirect'] : $this->routeParser->urlFor('home')
        );
    }
}
