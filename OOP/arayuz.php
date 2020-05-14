<?php

//arayüz interface deyimi kullanılarak tanımlanır.
interface Islem
{
    public function Olustur($tabloAdi,$id);
    public function Oku($tabloAdi,$id);
    public function Guncelle($tabloAdi,$veri,$id);
    public function Sil($tabloAdi,$id);
}

interface VT
{
    public function baglan($host,$dbname,$kadi,$sifre);
}

//arayüzümü kullanmak için sınıfıma implement etmem gerekir.
class VeriTabani implements Islem,VT
{
    public function baglan($host,$dbname,$kadi,$sifre)
    {

    }

    public function Olustur($tabloAdi,$id)
    {

    }
    public function Oku($tabloAdi,$id)
    {

    }
    public function Guncelle($tabloAdi,$veri,$id)
    {
        
    }
    public function Sil($tabloAdi,$id)
    {

    }
}

?>