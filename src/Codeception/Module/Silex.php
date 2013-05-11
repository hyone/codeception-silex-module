<?php

namespace Codeception\Module;

use Symfony\Component\HttpKernel\Client;


class Silex extends \Codeception\Util\Framework
{
    protected $config = array(
        'app_path'     => 'app.php',
        'session.test' => false
    );
    public $app;

    public function _initialize()
    {
        $this->kernel = $this->createApplication();
    }

    public function _before(\Codeception\TestCase $test)
    {
        // $this->kernel = $this->createApplication();
        $this->client = new Client($this->kernel, array());
        $this->client->followRedirects(true);
    }

    public function _after(\Codeception\TestCase $test)
    {
    }

    protected function createApplication()
    {
        $app = require \Codeception\Configuration::projectDir() . $this->config['app_path'];
        $app['debug'] = true;
        $app['session.test'] = $this->config['session.test'];
        $app['exception_handler']->disable();

        return $app;
    }
}
