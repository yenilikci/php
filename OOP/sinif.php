<?php 

class Uye
{ 
    public $ad = 'Melih';
    public $soyad = 'Celik';
    const DOGUMTARIHI = 1999;
    
    //başına public koyulmaz ise varsayılan olarak public atanır
    function stringAdDondur()
    {
        return 'Melih';
    }

    public function stringSoyadDondur()
    {
        return 'Celik';
    }

    //geriye değer döndüren parametreli fonksiyon
    public function kacYasinda($gunumuz,$dogumTarihi)
    {   
        return $gunumuz - $dogumTarihi;
    }

    //özellikleri kullanarak fonksiyon içerisinde değer geri döndürmek için $this kullanılır ve this ile yerel özelliklere erişim sağlanır.
    function adDondur()
    {
        return $this->ad;
    }
    function soyadDondur()
    {
        return $this->soyad;
    }

    //fonksiyon içerisinde fonksiyonumuzu döndürmek isteseydik
    function yasBas()
    {
        return $this->kacYasinda(2020,$this::DOGUMTARIHI);
    }
    
    //sabiti geriye döndürmek
    function dogumTarihi()
    {
        return $this::DOGUMTARIHI;
    }//veya self kullanabiliriz
    function dogumTarihi2()
    {
        return self::DOGUMTARIHI;
    }
}

//sınıftan nesne olusturma
$uye = new Uye();
//veya 
$uye2 = new Uye;


//sınıf içerisindeki özelliklere ve metotlara erişmek için -> işareti kullanılır

//metotlara erişmek ve ekrana yazdırmak için
echo $uye->stringAdDondur() . "<br>";

//özeliğe erişmek ve ekrana yazdırmak
echo $uye->soyad . "<br>" ; //çıktı Celik

//sabite erişmek ve ekrana yazdırmak için 
echo $uye::DOGUMTARIHI;


//uye2 için özelliklere farklı değerler atayalım:
$uye2->ad = 'Farklıİsim';
$uye2->soyad = 'FarkliSoyad';

echo "<hr>";
echo "<br>". $uye2->ad;
echo "<br>". $uye2->soyad;
echo "<br>". $uye2::DOGUMTARIHI;

//parametreli metodu çağırmak 
echo "<hr>";
echo "KAÇ YAŞINDALAR?" . "<br>";
echo $uye->kacYasinda(2020,$uye::DOGUMTARIHI);

//özellik ve fonksiyonları geri döndüren fonksiyonları çağırmak
echo "<hr>";
echo "Birde özellikleri geri döndürerek ad ve soyadı ekrana bastıralım" . "<br>";
echo $uye->adDondur() . "<br>";
echo $uye->soyadDondur();
echo "<br>". "Birde metodu geri döndürerek yaşı ekrana bastıralım" . "<br>";
echo $uye->yasBas();

//this ve self ile sabit döndüren fonksiyonların ekrana bastırılması
echo $uye->dogumTarihi(); //this kullanıldı
echo $uye->dogumTarihi2(); //self kullanıldı

//this NESNEYİ REFERANS ALIR , self ise SINIFI REFERANS ALIR

?>