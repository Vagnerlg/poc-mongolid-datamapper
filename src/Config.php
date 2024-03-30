<?php

namespace Vagnerlg\MongolidPoc;

use Mongolid\Connection\Connection;
use Mongolid\Connection\Pool;
use Mongolid\DataMapper\EntityAssembler;
use Mongolid\DataMapper\SchemaMapper;
use Mongolid\Event\EventTriggerService;
use SplQueue;
use Vagnerlg\MongolidPoc\Book\Book;
use Vagnerlg\MongolidPoc\Book\BookRepository;
use Vagnerlg\MongolidPoc\Book\BookSchema;
use Vagnerlg\MongolidPoc\Book\Comment\Comment;
use Vagnerlg\MongolidPoc\Book\Comment\CommentSchema;
use Vagnerlg\MongolidPoc\Author\Author;
use Vagnerlg\MongolidPoc\Author\AuthorRepository;
use Vagnerlg\MongolidPoc\Author\AuthorSchema;

class Config
{
    public static function dependencyInjection(): array
    {
        return [
            Book::class => fn($parameters) => new Book(),
            BookSchema::class => fn($parameters) => new BookSchema(),
            BookRepository::class => fn($parameters) => new BookRepository(new Pool()),

            Comment::class => fn($parameters) => new Comment(),
            CommentSchema::class => fn($parameters) => new CommentSchema(),

            Author::class => fn($parameters) => new Author(),
            AuthorSchema::class => fn($parameters) => new AuthorSchema(),
            AuthorRepository::class => fn($parameters) => new AuthorRepository(new Pool()),

            SchemaMapper::class => fn($parameters) => new SchemaMapper($parameters['schema']),
            EventTriggerService::class => fn($parameters) => new EventTriggerService(),
            SplQueue::class => function($parameters) {
                $splQueue = new SplQueue();
                $splQueue->push(new Connection('mongodb://db:27017'));
                return $splQueue;
            },
            EntityAssembler::class => fn($parameters) => new EntityAssembler(),
        ];
    }
}