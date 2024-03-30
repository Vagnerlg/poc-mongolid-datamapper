<?php

use Mongolid\Container\Ioc;
use Vagnerlg\MongolidPoc\DependencyInjection;
use Vagnerlg\MongolidPoc\Config;

$di = new DependencyInjection(Config::dependencyInjection());
Ioc::setContainer($di);