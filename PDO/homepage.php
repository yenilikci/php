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

/*
 * verikategorisi tablosu eklenmeden önceki hali:
 * $veriler = $db->query('SELECT * FROM veriler')->fetchAll(PDO::FETCH_ASSOC);
*/

//verikategorisi tablosu eklendikten sonraki INNER JOIN'li hali:
//INNER JOIN Tablo_Adi ON Tablo_Adi.id = digerTablo_Adi.id
$veriler = $db->query('SELECT veriler.id,veriler.baslik,verikategorisi.ad as kategori_adi,veriler.onay FROM veriler
INNER JOIN verikategorisi ON verikategorisi.id = veriler.kategori_id
ORDER BY veriler.id DESC')->fetchAll(PDO::FETCH_ASSOC); //son eklenen verilere göre listele

?>

<!--Eğer veri varsa-->
<?php if ($veriler): ?>
        <ul>
        <!-- foreach ile veriler çekiliyor $veriler as $vr-->
    <?php foreach ($veriler as $vr): ?>
        <li>
            <!--İçeriklerin başlıkları ve kategorileri listelendi-->
            <?php echo $vr['baslik']; ?>
            (<?php echo $vr['kategori_adi']; ?>)
            <div>
              <?php if($vr['onay'] == 1): ?>
                  <!--Sadece onaylı olan içeriklerin başlıkları gösterilecek.-->
                  <a href="index.php?sayfa=oku&id=<?php echo $vr['id'];?>">[OKU]</a>
              <?php endif; ?>
              <a href="index.php?sayfa=formUpdate&id=<?php echo $vr['id'] ?>">[DÜZENLE]</a>
              <a href="index.php?sayfa=sil&id=<?php echo $vr['id'] ?>">[SİL]</a>
          </div>
        </li>
    <?php endforeach;?>
        </ul>
<?php else: ?>
    <!--veri yoksa...-->
    <div>Henüz eklenmiş ders bulunmuyor!</div>
<?php endif; ?>

