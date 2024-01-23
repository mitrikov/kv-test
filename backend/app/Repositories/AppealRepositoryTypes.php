<?php

namespace App\Repositories;

/**
 * Типы используемых выводов
 */
enum AppealRepositoryTypes: string
{
    case Db = "db";
    case File = "file";
}
