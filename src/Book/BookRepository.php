<?php

namespace Vagnerlg\MongolidPoc\Book;

use Mongolid\Connection\Pool;
use Mongolid\DataMapper\DataMapper;

class BookRepository extends DataMapper
{
    public function __construct(Pool $pool)
    {
        parent::__construct($pool);
        $this->schemaClass = BookSchema::class;
        $this->setSchema(new BookSchema());
    }
}