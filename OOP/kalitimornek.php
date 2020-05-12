<?php

class Calisan
{
    public $maas;
    public $adsoyad;

    public function setAdSoyad($adsoyad)
    {
        //sınıfın içerisindeki adsoyad dışarıdan gelen adsoyad değerine eşit olsun
        $this->adsoyad = $adsoyad;
    }

    public function maas($maas)
    {
        //sınıfın içerisinde maas dışarıdan gelen maas değerine eşit olsun
        $this->maas = $maas;
    }

    public function senelikMaas()
    {
        return ($this->maas*12).'₺';
    }
}

class Muhasebe extends Calisan{}

class IT extends Calisan{
    public function senelikMaas()
    {
        return 'IT Çalışanı: '.$this->adsoyad.' senelik maaş olarak '.parent::senelikMaas();
    }
}

$muhasabeci = new Muhasebe;

$muhasabeci->adsoyad = 'ASDAS DSASD';
$muhasabeci->maas = 4200;
echo "Muhasabeci Senelik Maaşı: ".$muhasabeci->senelikMaas();

echo "<br>";

$it = new IT;
$it->adsoyad = 'FFJS SFLP';
$it->maas= 8500;
echo $it->senelikMaas();

?>