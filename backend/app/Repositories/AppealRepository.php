<?php

namespace App\Repositories;

abstract class AppealRepository
{
    public $data = null;

    public function __construct($data) {
        $this->data = $data;
    }

    abstract public function save();
}
