<a href="index.php?sayfa=kategori_ekle">[Kategori Ekle]</a>
<?php

//verikategorisi bilgilerini getirmek için.
$sorgu = $db -> prepare('SELECT * FROM verikategorisi');
$sorgu -> execute();
$getir = $sorgu -> fetchAll(PDO::FETCH_ASSOC);

?>

<ul>
    <?php foreach ($getir as $gt): ?>
    <li>
        <a href="index.php?sayfa=kategori&id=<?php echo $gt['id'];?>">
            <?php echo $gt['ad']; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>


