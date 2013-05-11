<?php

namespace Codeception\Module;

use Codeception\Util\Stub;

class SilexTest extends \PHPUnit_Framework_TestCase
{
    protected $module;

    public function setUp()
    {
        $this->module = new \Codeception\Module\Silex();
        $this->module->_setConfig(array(
            'app_path'     => "/tests/_data/app-sample1.php",
            'session.test' => true
        ));
        $this->module->_initialize();
        $this->module->_cleanup();
        $this->module->_before(Stub::makeEmpty('\Codeception\TestCase\Cest'));
    }

    public function tearDown()
    {
    }

    public function testRoot()
    {
        $this->module->amOnPage('/');
        $this->module->seeResponseCodeIs(200);
        $this->module->see('Hello World');
    }

    public function testSession()
    {
        // before having session
        $this->module->amOnPage('/session');
        $this->module->seeResponseCodeIs(200);
        $this->module->see('Set session!');

        // after having session
        $this->module->amOnPage('/session');
        $this->module->see('Aloha!');
    }
}
