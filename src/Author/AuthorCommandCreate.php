<?php

namespace Vagnerlg\MongolidPoc\Author;

use Mongolid\Container\Ioc;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'author:create')]
class AuthorCommandCreate extends Command
{
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var AuthorRepository $repository */
        $repository = Ioc::make(AuthorRepository::class);

        $author = new Author();
        $author->name = $input->getArgument('name');

        $io = new SymfonyStyle($input, $output);
        $io->newLine(10);

        if (!$repository->insert($author)) {
            $io->error("Error Create Author");

            return Command::FAILURE;
        }

        $io->horizontalTable([
            'id', 'name', 'created_at', 'updated_at'
        ], [[
            $author->_id, $author->name, $author->created_at, $author->updated_at,
        ]]);

        return Command::SUCCESS;
    }
}