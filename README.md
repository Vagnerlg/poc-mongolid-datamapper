# POC Mongolid PHP com DataMapper

## Objetivo

A partir do pacote [leroy-merlin-br/mongolid](https://github.com/leroy-merlin-br/mongolid) criar um app de linha de comando para criar, editar Entidades com o mongolib usando DataMapper.

## Estrutura (APP)

Para o teste foi criado apenas 3 Entidades.
- [Author](./src/Author/Author.php)
- [Book](./src/Book/Book.php)
- [Comment](./src/Book/Comment/Comment.php)

## Como Fazer os testes

É necesário apenas o `docker composer` instalado na máquina.

Primeiro execute este comando na raiz do projeto.

```sh
docker compose up -d
```

Voce pode acompanhar como os dados estão armazenados em [localhost:8081](localhost:8081) no `Express(mongo)`

## Comandos para criar editar as entidades

```sh
docker compose run --rm php php ./src/index.php author:create <name>
docker compose run --rm php php ./src/index.php book:comment:create <book_id> <name> <available>
docker compose run --rm php php ./src/index.php book:create <title> <description>
docker compose run --rm php php ./src/index.php book:find <id>
docker compose run --rm php php ./src/index.php book:update <title> <description>
```

## DataMapper

O `Mongolid` o DataMapper funciona com duas classes:

### Schema

```php
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
```

### Entity
```php
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
```

Como a class de `DataMapper` do mongolid que é feita toda interação de criação, edição e busca com o mongo.

```php
$mapper = new DataMapper($poll);

$book - new Book();
$book->title = 'Dom Casmirro';
$book->description = 'Dom Casmurro é um romance escrito por Machado de Assis, publicado em 1899 pela Livraria Garnier.';

$mapper->insert($book);
```

## Conclusões finais

### Foi feito

- Criação e edição de uma entidade
- Criação e edição de uma subcollection (Comments)

### O que faltou

- Não foi possivel cria uma relação entre entidade, por exemplo, Book/Autor
- Foi necesário fazer os testes com a versão `dev-master` e não `v3.7` como era esperado
- Não tem por padrão ainda uma configuração do `DataMapper` no pacote `mongolid-laravel`