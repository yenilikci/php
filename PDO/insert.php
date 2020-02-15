<?php

//burada veritabanına ekleme işlemi yapacağız.
//veriler diye bir tablo oluşturduğumuzu varsayalım.

/*                                                   veriler
 *  ==================================================================================================
 * id -> int (PK) , baslik -> varchar , icerik -> text , onay -> int , tarih-> timestamp (current_timestap())
 */


/*
 * Daha güvensiz hali:
 * $db->query('INSERT INTO veriler SET baslik="açıklı başlık", icerik = "açıklı içerik", onay = 1');
 *  dışarıdan müdahaleye açık.
 */

//INSERT INTO tablo_adi SET kolon1=değer1
//prepare ile sorgumuzu hazırlıyorum.
$sorgu = $db->prepare('INSERT INTO veriler SET
baslik = ?,
icerik = ?,
onay = ?');
//sonrasında ekle isimli bir değişkende bu sorguları çalıştıracağım.
$ekle = $sorgu->execute(['deneme başlık','deneme içerik',1]);

if ($ekle)
{
    echo "Verileriniz eklendi!";
}else
{
    //eğer başarısız olursa errorInfo() çağrılacak bu bize bir dizi döndürecek ve print_r ile onu görebileceğiz.
    print_r($sorgu->errorInfo());
    //veya
    $hata = $sorgu->errorInfo();
    echo "<br>MySQL hatası: ".$hata[2];
}

?>