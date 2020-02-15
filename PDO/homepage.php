<?php require 'header.php' ?>
<h3>Veriler - Başlıklar</h3>
<?php
//SELECT * FROM Tablo_adi
//listeleme işlemi: (fetc() ~ fetchAll())

/*
$sorgu = $db->prepare('SELECT * FROM veriler WHERE id=? ');
$sorgu -> execute([
    3
]); //veriler tablosundaki id'si 3 olanı listeler.
$veriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
*/

$veriler = $db->query('SELECT * FROM veriler')->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
    <!-- foreach ile veriler çekiliyor $veriler as $vr-->
    <?php foreach ($veriler as $vr): ?>
    <li>
        <!--İçeriklerin başlıkları listelendi-->
        <?php echo $vr['baslik']; ?>
        <?php if($vr['onay'] == 1): ?>
        <!--Sadece onaylı olan içeriklerin başlıkları gösterilecek.-->
            <a href="index.php?sayfa=oku&id=<?php echo $vr['id'];?>">[OKU]</a>
        <?php endif; ?>
        <a href="">[DÜZENLE]</a>
        <a href="">[SİL]</a>
    </li>
    <?php endforeach;?>
</ul>
