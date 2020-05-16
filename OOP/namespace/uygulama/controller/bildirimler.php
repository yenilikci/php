<?php

//namespace tanımı
namespace Uygulama\Controller;

//burada aslında bir isim-klasör eşleşmesi yok anlaşılır olsun diye bu formatta isimlendiriyoruz 

//bu Bildirimler sınıfını kullanmak için bu namespace'i kullanmam gerekecek
//bu namespace Uygulama klasörünün altındaki Controller klasörünün altındaki Bildirimler sınıfını temsil ediyor.

class Bildirimler
{
    public function __construct()
    {
        echo 'Controller İçin Bildirimler oluşturuldu!';
    }
}


?>
