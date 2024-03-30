<?php

namespace Vagnerlg\MongolidPoc\Book\Comment;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use Mongolid\Schema\Schema;

class Comment extends Schema
{
    public ?ObjectId $_id = null;
    public string $name;
    public int $available;
    public UTCDateTime $created_at;
}