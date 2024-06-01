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
        $created = [];
        foreach ($uploadedFiles as $file) {
            $created[] = File::create([
                'path' => $file['path'],
                'storage' => $file['storage'],
                'type'=>$file['mime'],
                'entry' => [
                    'extension' => $file['extension'],
                    'filesize'=>$file['size'],

                ]
            ]);
        }
        return $created;
    }
}
