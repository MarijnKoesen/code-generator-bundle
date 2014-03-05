MarijnKoesenCodeGeneratorBundle
==================

The **MarijnKoesenCodeGenerator** bundle allows you to generate php code for classes.

This project is based upon the [php-code-generator](https://github.com/MarijnKoesen/php-code-genereator) project 
and relies on the [Symfony2](http://symfony.com/) framework. If you don't have
Symfony2 take a look at the php-code-generator project that you can install standalone.



Installation
------------

Include the bundle using composer:

```
  "require-dev": {
    "marijnkoesen/code-generator-bundle": "0.1*",
  }

```

Then update your composer:

```
$ composer update
```

Register the bundle in `app_kernel.php`

```
if (in_array($this->getEnvironment(), array('dev', 'test'))) {
    $bundles[] = new Nelmio\ApiDocBundle\NelmioApiDocBundle();
}
```

Include the routes in `routing_dev.yml`:

```
MarijnKoesenCodeGeneratorBundle:
    resource: "@MarijnKoesenCodeGeneratorBundle/Resources/config/routing.yml"
    prefix:   /code-generator
```

Install the assets:

```
$ ./app/console assets:install
```


Open your browser and go to the `http://your-project/code-generator/` URL.



Configuration
-------------

You can add your own modules, or disable the default ones with the config.

For info on how to create your own modules, see below.

```
marijn_koesen_code_generator:
    # Add your own custom modules 
    modules:
        My\NameSpace\CodeGenerators\MyCustomGenerator: true

    # Disable a default generator
    defaultModules:
        codegenerator\generator\MockGenerator: false
```



Extending the code generator
----------------------------

You can easily create your own code generator if you want to generate anything else 
from your class definition.

You can extend the AbstractGenerator class, and easily create your own implementation.

See below for a sample Generator:

```php
<?php
namespace MyNamespace;

use codegenerator\model\ClassEntity;
use codegenerator\model\ClassMember;

class MyGenerator extends AbstractGenerator
{
    public function generateCode(ClassEntity $class=null)
    {
        return 'class ' . $class->getName() . ' {}';
    }

    public function getName()
    {
        return 'Doctrine';
    }
} 
```

Then add it to your `config_dev.yml`:

```
marijn_koesen_code_generator:
    modules:
        MyNamespace\MyGenerator: true
```


Credits
-------

Developed and maintained by [Marijn Koesen](http://github.com/MarijnKoesen/)


License
-------

This bundle is released under the MIT license. See the complete license in the
bundle:

    Resources/meta/LICENSE
