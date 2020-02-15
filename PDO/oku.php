<?php require 'header.php';?>
<?php
//eğer id yoksa veya boşsa
if (!isset($_GET['id']) || empty($_GET['id']))
{
    //index'e yönlendirme işlemi
    header('Location:index.php');
    exit;
}

//veriler tablosundan id'si =
$sorgu = $db->prepare('SELECT * FROM veriler WHERE id=?');
$sorgu->execute([
    //get edilen id'ye eşit olanı al
    $_GET['id']
]);

//zaten tek bir veri alacağız (o id'ye ait olan).
$veri = $sorgu->fetch(PDO::FETCH_ASSOC);

//eğer veri yoksa
if (!$veri)
{
    //yine index'e yönlendir.
    header('Location:index.php');
    exit;
}

?>

<h3> <?php echo $veri['baslik']; ?></h3>
<hr>
<div>
    <strong> Eklenme Tarihi: <?php echo $veri['tarih'] ?></strong>
    <hr>
    <?php echo nl2br($veri['icerik']) ?> <!-- Alt alta yazdırabilmek için-->
</div>