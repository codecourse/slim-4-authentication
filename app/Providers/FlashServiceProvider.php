<?php

namespace App\Providers;

use Slim\Flash\Messages;
use League\Container\ServiceProvider\AbstractServiceProvider;

class FlashServiceProvider extends AbstractServiceProvider
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $provides = [
        'flash'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function register()
    {
        $this->getContainer()->share('flash', function () {
           return new Messages();
        });
    }
}
