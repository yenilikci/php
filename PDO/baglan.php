<?php
    try
    {
        //PDO bir sınıf olduğu için new PDO demek gerekiyor onu da bir değişkene atıyorum.
        //phpmyadmin'den veri isimli bir veritabanı oluşturduğumuzu varsayalım (utf8_general_ci).
        $db = new PDO('mysql:host=localhost;dbname=veri','root',''); //dsn,username,passwd
    }
    catch (PDOException $e)
    {
        $e->getMessage();
    }
?>