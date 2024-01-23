<?php

namespace App\Models;

use App\Repositories\AppealDBRepository;
use App\Repositories\AppealFileRepository;
use App\Repositories\AppealRepository;
use App\Repositories\AppealRepositoryTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;


class Appeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'content'
    ];

    /**
     * Фабричный метод, возращающий класс
     * средств вывода в зависимости от
     * передаваемого типа
     *
     * @param AppealRepositoryTypes $type
     * @return AppealRepository
     */
    public function setRepository(AppealRepositoryTypes $type) : AppealRepository
    {
        return match ($type) {
            AppealRepositoryTypes::Db => new AppealDBRepository($this->toArray()),
            AppealRepositoryTypes::File => new AppealFileRepository($this->toArray()),
            default => throw new InvalidArgumentException("Неверно указан тип репозитория!"),
        };
    }
}
