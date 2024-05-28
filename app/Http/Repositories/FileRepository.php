<?php

namespace App\Http\Repositories;

use App\Http\Services\AttachmentService;
use App\Models\File;

class FileRepository
{
    public function upload(string $field, array $storages = []): File
    {

        $files = request()->file[$field];
        if(!is_countable($files)){
            $files[] = $files;
        }

        $uploadedFiles = AttachmentService::instance()
            ->setStorages($storages)
            ->uploadFiles($files);

        $insertData = [];
        foreach ($uploadedFiles as $file) {
            $insertData[] = [
                'path' => $file['path'],
                'storage' => $file['storage'],
                'extension' => $file['extension'],
            ];
        }
        return File::insert($insertData);
    }
}
