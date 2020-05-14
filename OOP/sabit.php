<?php

class File
{

    const DIRECTORY = __DIR__; // __DIR__ hangi dizinde ise bize onun ismini döndürür
    public function getDirectory()
    {
        return self::DIRECTORY; //dizin yolunu geri döndürür, self(sınıfı referans alır) ile eriştim
    }

}

class Folder extends File
{
    public function getDirectory()
    {
        return parent::DIRECTORY; //File sınıfındaki DIRECTORY sabitini kullandım, parent(temel sınıfı)'ı baz aldım.
    }
}

//File sınıfından nesne oluşturalım
$file = new File;
echo $file->getDirectory();

//veya sınıfı başlatmadan da sabitin değerini alabiliriz
echo "<br>". File::DIRECTORY;


//dizin değerini geri döndürme işlemini Folder sınıfının nesnesi ile yapalım
$folder = new Folder;
echo "<br>". $folder->getDirectory();

?>