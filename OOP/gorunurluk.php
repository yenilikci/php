<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

class Test
{
    public $a = 'a'; //her yerden erişilebilir.

    private $b = 'b'; //sadece sınıf içerisinden erişilebilir

    public function geriDonB()
    {
        return $this->b; //private özelliği public metotta geriye döndürebilirim
    }

    protected $c = 'c';
    //korumalı, aynı private gibi dışarıdan erişilemez sınıf içinde erişilebilir, miras aldığımız sınıfta da kullanabiliriz

    private function geriDonA() //private func
    {
        return $this->a;
    }

    protected function geriDonC() //protected func
    {
        return $this->c;
    }

}

$test = new Test;

echo $test->a; //bu özelliği rahatça ekrana basabildim

echo $test->b; //bu özelliği ekrana bastırmak istediğimde hata ile karşılaşıyorum

echo $test->geriDonB();

echo $test->c; //hata

echo $test->geriDonA(); //hata

echo $test->geriDonC(); //hata

?>