<?php

namespace Vagnerlg\MongolidPoc\Author;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Author
{
    public ?ObjectId $_id = null;
    public string $name;
    public UTCDateTime $updated_at;
    public UTCDateTime $created_at;
}