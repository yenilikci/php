<?php

interface Islem
{
    public function Olustur($tabloAdi,$id);
    public function Oku($tabloAdi,$id);
    public function Guncelle($tabloAdi,$veri,$id);
    public function Sil($tabloAdi,$id);
}

//burada farklı olarak VT arayüzü Islem arayüzünden türetildi 
interface VT extends Islem
{
    public function baglan($host,$dbname,$kadi,$sifre);
}

//ve sadece VT arayüzü implemente edildi
class VeriTabani implements VT
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