<?php

namespace App\Http\Repositories;

use App\Http\Services\AttachmentService;
use App\Models\File;
use Collectable;
use Countable;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileRepository
{
    public function upload(string $field, array $storages): array
    {
        $files = request()->files->get($field);
        if ($files instanceof UploadedFile) {
            $files = [$files];
        }

        $uploadedFiles = AttachmentService::instance()
            ->setStorages($storages)
            ->uploadFiles($files);
        $insertData = [];
        foreach ($uploadedFiles as $file) {
            $insertData[]=[
                'path' => $file['path'],
                'storage' => $file['storage'],

            ];
        }
        File::insert($insertData);
        $fileRecords=File::whereIn('path',array_column($uploadedFiles,'path'))->get()->all();
        return $fileRecords;
    }
}
