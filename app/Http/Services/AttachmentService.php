<?php

namespace App\Http\Services;

use App\Exceptions\UndefinedStoragesException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $uploaded = [];
        $hashes = [];
        foreach ($files as $file) {
            $contentHash = md5_file($file->getRealpath());
            if (!in_array($contentHash, $hashes)) {
                $uploaded += $this->uploadFile($file);
                $hashes[] = $contentHash;
            }
        }
        return $uploaded;
    }

    /**
     * @param $file
     * @return array
     * @throws Throwable
     */

    public function uploadFile(UploadedFile $file): array
    {
        $uploadedFiles = [];
        $extension = $file->guessExtension();
        $contentHash = md5_file($file->getRealPath());
        $filesize=filesize($contentHash);
        dd($filesize);
        $fileName = "{$contentHash}.{$extension}";
        foreach ($this->getStorages() as $storage) {
                $uploadedFiles[] = [
                    'storage' => $storage,
                    'path' => $fileName,
                    'extension' => $extension,
                    'mime' => $file->getMimeType(),
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
