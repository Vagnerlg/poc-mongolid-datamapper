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

#[AsCommand(name: 'book:create')]
class BookCommandCreate extends Command
{
    protected function configure(): void
    {
        $this->addArgument('title', InputArgument::REQUIRED)
            ->addArgument('description', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var BookRepository $repository */
        $repository = Ioc::make(BookRepository::class);

        $book = new Book();
        $book->title = $input->getArgument('title');
        $book->description = $input->getArgument('description');

        $io = new SymfonyStyle($input, $output);
        $io->newLine(12);

        if (!$repository->insert($book)) {
            $io->error("Error Create Book");

            return Command::FAILURE;
        }

        $io->horizontalTable([
            'id', 'title', 'description', 'created_at', 'updated_at'
        ], [[
            $book->_id, $book->title, $book->description, $book->created_at, $book->updated_at,
        ]]);

        $io->newLine(4);

        return Command::SUCCESS;
    }
}