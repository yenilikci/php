<?php

//eğer veri yoksa ya da boşsa
if (!isset($_GET['id']) || empty($_GET['id']))
{
    header('Location:index.php');
    exit;
}

//DELETE FROM Tablo_Adi WHERE id = 2
$sorgu = $db -> prepare('DELETE FROM veriler WHERE id = ?'); //veriler tablosunda id'si...

$sorgu -> execute([
    $_GET['id'] //... şu olan veriyi sil
]);

//daha sonra index.php'ye yönlendir.
header('Location:index.php');







?>
