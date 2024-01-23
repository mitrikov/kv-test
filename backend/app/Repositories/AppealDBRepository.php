<?php

namespace App\Repositories;

use Symfony\Component\Console\Output\ConsoleOutput;

class AppealDBRepository extends AppealRepository
{
    /**
     * Эмулируем запись в БД. Используется
     * вывод в консоль, в рамках тестового
     * задания
     *
     * @return void
     */
    public function save()
    {
        $result = print_r($this->data, true);
        $output = new ConsoleOutput();
        $output->writeln("<info>В базу данных было записано обращение:</info>");
        $output->writeln("$result");
    }
}
