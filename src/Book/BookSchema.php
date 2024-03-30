<?php

namespace Vagnerlg\MongolidPoc\Book;

use Mongolid\Schema\Schema;
use Vagnerlg\MongolidPoc\Book\Comment\CommentSchema;

class BookSchema extends Schema
{
    public $entityClass = Book::class;

    public $collection = 'book';

    public $fields = [
        '_id' => 'objectId',
        'title' => 'string',
        'description' => 'string',
        'comments' => 'schema.' . CommentSchema::class,
        'created_at' => 'createdAtTimestamp',
        'updated_at' => 'updatedAtTimestamp',
    ];
}