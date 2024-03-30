<?php

namespace Vagnerlg\MongolidPoc\Book;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use Vagnerlg\MongolidPoc\Book\Comment\Comment;

class Book
{
    public ?ObjectId $_id = null;
    public string $title;
    public string $description;
    public UTCDateTime $created_at;
    public UTCDateTime $updated_at;

    /** @var Comment[]  */
    public ?array $comments = null;
}