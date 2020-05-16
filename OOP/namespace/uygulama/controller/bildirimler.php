<?php

//namespace tanımı
namespace Uygulama\Controller;

//burada aslında bir isim-klasör eşleşmesi yok anlaşılır olsun diye bu formatta isimlendiriyoruz 

//bu video sınıfını kullanmak için bu namespace'i kullanmam gerekecek
//bu namespace App klasörünün altındaki Controller klasörünün altındaki Video sınıfını temsil ediyor.

class Bildirimler
{
    public function __construct()
    {
        echo 'Controller İçin Bildirimler oluşturuldu!';
    }
}


?>