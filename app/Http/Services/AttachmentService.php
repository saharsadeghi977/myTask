<?php

namespace App\Http\Services;

use App\Exceptions\UndefinedStoragesException;
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
        $savedFiles = [];
        foreach ($files as $file) {
            $savedFiles = array_merge($savedFiles, $this->uploadFile($file));
        }

        return $savedFiles;
    }

    /**
     * @param $file
     * @return array
     * @throws Throwable
     */
    public function uploadFile($file): array
    {
        $savedFiles = [];
        $directory = date('Y/m/d');
        $extension = $file->getClientOriginalExtension();
        $randomName = md5(Str::random(5) . now()->toDateTimeString());
        $fileName = "{$randomName}.{$extension}";
        $fileMimeType = $file->getMimeType();
        foreach ($this->getStorages() as $storage) {
            $savedFiles = array_merge($savedFiles, [
                'file' => Storage::disk($storage)->putFileAs($directory, $file, $fileName),
                'type' => $fileMimeType,
                'extension' => $extension,
                'storage' => $storage
            ]);
        }

        return $savedFiles;
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
