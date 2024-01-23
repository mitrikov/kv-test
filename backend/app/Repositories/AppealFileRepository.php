<?php

namespace App\Repositories;

use Carbon\Carbon;

class AppealFileRepository extends AppealRepository
{
    public static $path = "appeals/";
    public function save()
    {
        $timestamp = Carbon::now()->format("m-d-Y--H-i-s");
        $filename = "appeal-$timestamp.json";

        self::createDirIfNotExists();
        file_put_contents(storage_path(self::$path) . $filename, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    private static function createDirIfNotExists() {
        if (!is_dir(storage_path(self::$path))) {
            mkdir(storage_path(self::$path));
        }
    }
}
