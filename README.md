# Codeception Silex Module

This module allows you to run Codeception functional tests for Silex application.

## Usage

composer.json :

```json
{
  "require": {
    "silex/silex": "1.0.*@dev",
  },

  "require-dev": {
    "hyone/codeception-silex-module": "dev-master",
    "codeception/codeception": "~1.6.1"
  },

  "repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/hyone/codeception-silex-module.git"
      }
  ]
}
```

Initialize tests

    $ vendor/bin/codecept bootstrap

Edit functional.suite.yaml like below:

```yaml
class_name: TestGuy
modules:
    enabled: [Silex, TestHelper]
    config:
      Silex:
        app_path: /src/app.php
        session.test: true
```

Generate Cest test file

    $ vendor/bin/codecept build
    $ vendor/bin/codecept generate:cest functional Foo

Writing test ...

```php
class FooCest
{
    public function _before($scenario) {}

    public function _after() {}

    // tests
    public function tryToTest(\TestGuy $I)
    {
        $I->amOnPage('/');
        $I->fillField('name', 'Miles');
        // ...
    }
}
```

Run test

    $ vendor/bin/codecept run functional --debug
