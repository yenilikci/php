<?php
//UPDATE Tablo_adi SET kolon1 = değer1 WHERE kolon=değer

$sorgu = $db->prepare('UPDATE veriler SET
baslik = ?,
icerik = ?,
onay = ?
WHERE id = ?'); //id'si şu olan...

//sorgu değişkenimi execute ediyorum ve güncelle değişkenine atıyorum.
$guncelle = $sorgu->execute([
    'yeni başlık','yeni içerik',1,2
]);

//eğer güncellendiyse...
if ($guncelle)
{
    echo "Güncelleme işlemi başarılı!"; //...yazdır.
}else
{
    echo "Güncelleme işlemi başarısız!";
}


?>