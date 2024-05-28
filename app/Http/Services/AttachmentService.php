<?php

namespace App\Http\Services;

use App\Http\Requests\ValidationFileRequest;
use App\Exceptions\UndefinedStoragesException;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;


class AttachmentService
{
    /**
     * @var AttachmentService
     */
    private static self $instance;

    /**
     * @var array
     */
    private array $storages;


    /**
     * @return self
     */

    public static function instance(): self
    {
        return self::$instance ??= new self();
    }

    /**
     * @param string $file
     * @return bool
     * @throws Throwable
     */

    public function delete(string $file): bool
    {
        if (blank($file)) {
            return false;
        }

        $storages = $this->getStorages();

        foreach ($storages as $storage) {
            $storageDisk = Storage::disk($storage);

            $deleteLog = $storageDisk->exists($file) && $storageDisk->delete($file);
        }

        return true;
    }

    public function uploadFiles(array $files): array
    {
        return array_map([$this, 'uploadFile'], $files);
    }

    /**
     * @param $file
     * @return array
     * @throws Throwable
     */

    public function uploadFile($file): array
    {
        $uploadedFiles = [];
        $extension = $file->extension();
        $randomName = md5(Str::random(5) . now()->toDateTimeString());
        $fileName = "{$randomName}.{$extension}";
        foreach ($this->getStorages() as $storage) {
            $uploadedFiles[] = [
                'storage' => $storage,
                'path' => Storage::disk($storage)->putFileAs($file, $fileName),
                'extension' => $extension,
            ];
        }
        return $uploadedFiles;
    }


    /**
     * @throws Throwable
     */
    public function getStorages(): array
    {
        throw_if(blank($this->storages), new UndefinedStoragesException('Storages must be set before you want to get it'));
        return $this->storages;
    }

    public function setStorages(string|array $storages): self
    {
        $this->storages = is_array($storages) ? $storages : (array)$storages;
        return $this;
    }
}
