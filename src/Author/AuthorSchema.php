<?php

namespace Vagnerlg\MongolidPoc\Author;

use Mongolid\Schema\Schema;

class AuthorSchema extends Schema
{
    public $entityClass = Author::class;

    public $collection = 'author';

    public $fields = [
        '_id' => 'objectId',
        'name' => 'string',
        'created_at' => 'createdAtTimestamp',
        'updated_at' => 'updatedAtTimestamp',
    ];
}