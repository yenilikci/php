    <?php

    //eğer bir id değeri get edilmemişse index.php'ye yönlendirir.
    if (!isset($_GET['id']) || empty($_GET['id']))
    {
        header('Location:index.php?sayfa=kategoriler');
        exit;
    }


    $sorgu = $db->prepare('SELECT * FROM verikategorisi WHERE id = ? ');
    $sorgu -> execute([
        $_GET['id']
    ]);
    $kategori = $sorgu -> fetch(PDO::FETCH_ASSOC); //tek id değeri için veri çekeceğim için fetch

    if (!$kategori) //kategori yoksa
    {
        header('Location:index.php?sayfa=kategoriler');
        exit;
    }
    {
        $sorgu = $db->prepare('SELECT * FROM veriler 
        WHERE kategori_id = ?
        ORDER BY id DESC');
        $sorgu -> execute([
            $_GET['id']
        ]);
        $veriler = $sorgu-> fetchAll(PDO::FETCH_ASSOC);

    }

    ?>

    <?php if($veriler): //veriler varsa burayı göster ?>
    <h3><?php echo $kategori['ad'];?> Kategorisi</h3>
    <ul>
        <?php foreach ($veriler as $vr): ?>
        <li>
            <!--İçeriklerin başlıkları listelendi-->
            <?php echo $vr['baslik']; ?>
            <div>
                <?php if($vr['onay'] == 1): ?>
                    <!--Sadece onaylı olan içeriklerin başlıkları gösterilecek.-->
                    <a href="index.php?sayfa=oku&id=<?php echo $vr['id'];?>">[OKU]</a>
                <?php endif; ?>
                <a href="index.php?sayfa=formUpdate&id=<?php echo $vr['id'] ?>">[DÜZENLE]</a>
                <a href="index.php?sayfa=sil&id=<?php echo $vr['id'] ?>">[SİL]</a>
            </div>
        </li>
        <?php endforeach; ?>
    <?php else: //yoksada burayı göster ?>
            Bu kategoriye ait henüz veri eklenmemiştir.
    <?php endif; ?>
