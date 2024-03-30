<?php

namespace Vagnerlg\MongolidPoc\Book\Comment;

use Mongolid\Container\Ioc;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Vagnerlg\MongolidPoc\Book\Book;
use Vagnerlg\MongolidPoc\Book\BookRepository;

#[AsCommand(name: 'book:comment:create')]
class CommentCommandCreate extends Command
{
    protected function configure(): void
    {
        $this->addArgument('book_id', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('available', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->newLine(12);
        $io->title('Book Create');

        /** @var BookRepository $repository */
        $repository = Ioc::make(BookRepository::class);

        /** @var Book $book */
        if (!$book = $repository->first($input->getArgument('book_id'))) {
            $io->error("Book Not found");
        }

        $comment = new Comment();
        $comment->name = $input->getArgument('name');
        $comment->available = (int) $input->getArgument('available');
        $book->comments[] = $comment;

        if (!$repository->update($book)) {
            $io->error("Error Create Book");

            return Command::FAILURE;
        }

        $io->horizontalTable([
            'id', 'title', 'description', 'created_at', 'updated_at'
        ], [[
            $book->_id, $book->title, $book->description, $book->created_at, $book->updated_at,
        ]]);

        $io->table([
            'id', 'name', 'avalible'
        ], array_map(function (array $comment) {
            return [
                'id' => (string) $comment['_id'],
                'name' => $comment['name'],
                'avalable' => $comment['available'],
            ];
        }, $book->comments));

        $io->newLine(4);

        return Command::SUCCESS;
    }
}