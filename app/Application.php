<?php

namespace App;

use AltoRouter;
use Nette\DI\Container;

class Application
{
    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * @var Container
     */
    private $container;

    /**
     * Application constructor.
     * @param Container $container
     * @param AltoRouter $router
     */
    public function __construct(Container $container, AltoRouter $router)
    {
        $this->setRouter($router);
        $this->setContainer($container);
    }


    public function run()
    {
        $router = $this->getRouter();
        require_once __DIR__ . '/routes.php';

        $match = $router->match();

        if(!$match) {
            $this->handle404();
        }

        list($controller,$method) = explode('@',$match['target']);

        try {
            $controller = $this->getContainer()->getByType($controller);
            $controller->{$method}($match['params']);
        } catch (\Exception $e) {
            $this->handle500();

        }
    }

    /**
     * Handle 404 header
     */
    protected function handle404() {
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    /**
     * Handle 500 header
     */
    protected function handle500() {
        header("HTTP/1.1 500 Internal Server Error");
        exit;
    }

    /**
     * @return AltoRouter
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param AltoRouter $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }
}