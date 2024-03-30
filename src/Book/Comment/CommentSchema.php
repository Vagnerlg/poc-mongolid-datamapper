<?php

namespace Vagnerlg\MongolidPoc\Book\Comment;

use Mongolid\Schema\Schema;

class CommentSchema extends Schema
{
    public $entityClass = Comment::class;

    public $collection = null;

    public $fields = [
        '_id' => 'objectId',
        'name' => 'string',
        'available' => 'int',
        'created_at' => 'createdAtTimestamp',
    ];
}