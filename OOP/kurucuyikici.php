<?php

class YapYik
{
    private $degisken;

    //parametreli kurucu metot
    public function __construct($a)
    {
        $this->degisken = $a;
        //bir sınıf başlatıldığında otomatik olarak çağrılacak fonksiyondur
        echo $this->degisken.PHP_EOL;
    }

    public function bas()
    {
        echo 'ekrana yazı bastım'.PHP_EOL;
    }

    //yıkıcı metot
    public function __destruct()
    {
        //bir sınıfın çalışması bittiğinde çalışacak son metottur
        echo 'yıkıcı metot çalıştı'.PHP_EOL;
    }

}
 
$nesne = new YapYik('Kurucu metot çalıştı');
$nesne->bas();

?>