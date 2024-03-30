<?php

namespace Vagnerlg\MongolidPoc\Author;

use Mongolid\Connection\Pool;
use Mongolid\DataMapper\DataMapper;

class AuthorRepository extends DataMapper
{
    public function __construct(Pool $pool)
    {
        parent::__construct($pool);
        $this->schemaClass = AuthorSchema::class;
        $this->setSchema(new AuthorSchema());
    }
}