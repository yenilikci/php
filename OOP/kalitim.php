<?php

class Test
{
    public $isim = 'melih';
    protected $soyisim = 'celik';
    public function selam()
    {
        return "selam";
    }
}

//Test2 sınıfı Test sınıfından türetildi
class Test2 extends Test
{
    //Test sınıfının public ve protected metotlarını miras aldı
    public function arkadaslar()
    {
        return "arkadaşlar";
    }

    public function isimDon()
    {
        return $this->isim;
    }

    public function soyIsimDon()
    {
        return $this->soyisim;
    }

}

$test = new Test;
echo $test->selam();

echo "<br>";

$test2 = new Test2;
echo $test2->selam()." ".$test2->arkadaslar();

echo "<br>";
echo $test2->isimDon()." ".$test2->soyIsimDon();

?>