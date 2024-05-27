<?php

namespace App\Http\Repositories;
use App\Models\File;

class FileRepository
{
    public function create(string $storage,string $path):File{

$fileData=[
    'path'=>$path,
    'storage'=>$storage

];
   return File::create($fileData);
}
}
