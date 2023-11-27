<?php

namespace App\Controllers\Dashboard;

use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $view;

    /**
     * Undocumented function
     *
     * @param Twig $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
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
        return $this->view->render($response, 'pages/dashboard/index.twig');
    }
}
