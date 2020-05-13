<?php

class File
{
    public static $dosyaAdi;
    public static function Olustur($dosyaAdi,$icerik)
    {
        self::$dosyaAdi = $dosyaAdi;
        $dosya = fopen($dosyaAdi,'w+');
        fwrite($dosya,$icerik);
        fclose($dosya);
    }
    public static function Oku($dosyaAdi = null)
    {   
        if(!$dosyaAdi) $dosyaAdi = self::$dosyaAdi; 
        return file_get_contents($dosyaAdi);
    }
}
//sınıfın örneğini oluşturmadan
File::Olustur('a.txt','deneme içeriği');

$ds = new File;
echo $ds->Oku();

?>

