<?php

namespace Vagnerlg\MongolidPoc\Book\Command;

use Mongolid\Container\Ioc;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Vagnerlg\MongolidPoc\Book\Book;
use Vagnerlg\MongolidPoc\Book\BookRepository;
use Vagnerlg\MongolidPoc\Book\Comment\Comment;

#[AsCommand(name: 'book:find')]
class BookCommandFind extends Command
{
    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var BookRepository $repository */
        $repository = Ioc::make(BookRepository::class);

        $io = new SymfonyStyle($input, $output);
        $io->newLine(10);
        $io->title('Find Book ' . $input->getArgument('id'));

        /** @var Book $book */
        if (!$book = $repository->where($input->getArgument('id'))->first()){
            $io->error("Book Not found");

            return Command::FAILURE;
        }

        $io->horizontalTable([
            'id', 'title', 'description', 'created_at', 'updated_at'
        ], [[
            $book->_id, $book->title, $book->description, $book->created_at, $book->updated_at,
        ]]);

        $io->table([
            'id', 'name', 'avalible'
        ], array_map(function (Comment $comment) {
            return [
                'id' => $comment->_id,
                'name' => $comment->name,
                'avalable' => $comment->available,
            ];
        }, $book->comments ?? []));

        return Command::SUCCESS;
    }
}