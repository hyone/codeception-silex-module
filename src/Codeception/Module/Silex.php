<?php

namespace Codeception\Module;

use Symfony\Component\HttpKernel\Client;


class Silex extends \Codeception\Util\Framework
{
    protected $config = array(
        'app_path'     => 'app.php',
        'app_values'     => array(),
        'session.test' => false
    );
    public $app;

    public function _initialize()
    {
    }

    public function _before(\Codeception\TestCase $test)
    {
        $this->kernel = $this->createApplication();
        $this->client = new Client($this->kernel, array());
        $this->client->followRedirects(true);
    }

    public function _after(\Codeception\TestCase $test)
    {
    }

    protected function createApplication()
    {
        if (isset($this->config['app_class'])) {
            $values = $this->config['app_values'];
            $app = new $this->config['app_class']($values);
        } else {
            $app = require \Codeception\Configuration::projectDir() . $this->config['app_path'];
        }

        $app['debug'] = true;
        $app['session.test'] = $this->config['session.test'];
        $app['exception_handler']->disable();

        return $app;
    }
}
