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
     * @param string $hash
     * @param string $storage
     * @return bool
     * @throws Throwable
     */

    public function delete(string $hash,string $storage): bool
    {
        if (blank($hash)) {
            return false;
        }

        $storages=explode(',',$storage);
        foreach ($storages as $storage) {
            $storageDisk = Storage::disk($storage);
            $files=$storageDisk->allFiles();
            $directories=$storageDisk->directories();

           foreach ($files as $file){
              if(strpos($file,$hash)!==false){
                  $storageDisk->delete($file);
              }
           }
          foreach ($directories as $directory){
              $allFiles=$storageDisk->allFiles($directory);
              $allDirectories=$storageDisk->allDirectories($directory);
              if(empty($allFiles) && empty($allDirectories)){
                  $storageDisk->deleteDirectory($directory);
              }
          }
        }

        return true;
    }

    public function uploadFiles(array $files): array
    {
        $uploaded = [];

        foreach ($files as $file) {

            $uploaded += $this->uploadFile($file);
        }
        return $uploaded;
    }

    /**
     * @param UploadedFile $file
     * @return array
     * @throws Throwable
     */

    public function uploadFile(UploadedFile $file): array
    {
        $uploadedFiles = [];
        $extension = $file->guessExtension();
        $contentHash = md5_file($file->getRealPath());
        $filesize = filesize($file->getRealPath());
        $fileName = date("Y/m/d/") . "{$contentHash}.{$extension}";
        foreach ($this->getStorages() as $storage) {
            $filePath = Storage::disk($storage)->putFileAs($file, $fileName);
            $uploadedFiles[] = [
                'storage' => $storage,
                'path' => $filePath,
                'extension' => $extension,
                'hash' => $contentHash,
                'mime' => $file->getMimeType(),
                'size' => $filesize,
            ];
        }
        return $uploadedFiles;

    }

    /**@return array
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
