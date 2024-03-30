<?php

use Symfony\Component\Console\Application;
use Vagnerlg\MongolidPoc\Book\Command\BookCommandCreate;
use Vagnerlg\MongolidPoc\Book\Command\BookCommandFind;
use Vagnerlg\MongolidPoc\Book\Command\BookCommandUpdate;
use Vagnerlg\MongolidPoc\Book\Comment\CommentCommandCreate;
use Vagnerlg\MongolidPoc\Author\AuthorCommandCreate;

$application = new Application();

$application->add(new BookCommandCreate());
$application->add(new BookCommandFind());
$application->add(new BookCommandUpdate());
$application->add(new CommentCommandCreate());

$application->add(new AuthorCommandCreate());

$application->run();
