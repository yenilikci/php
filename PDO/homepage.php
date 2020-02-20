<h3>Veriler - Başlıklar</h3>

<!-- LIKE kullanımı anlatılırken eklendi -->

<form action="" method="get">
    <input type="text" name="arama" placeholder="Verilerde Arama Yap" value="<?php echo isset($_GET['arama']) ? $_GET['arama'] : '' ?>">
    <!-- Eğer arama yapılmışsa get edilen değer input text'in değeri olarak yazacak-->
    <button type="submit">ARAMA</button>
</form>

<!-- LIKE kullanımı anlatılırken eklendi -->


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

$sql = ' SELECT veriler.id,veriler.baslik,verikategorisi.ad as kategori_adi,veriler.onay FROM veriler
INNER JOIN verikategorisi ON verikategorisi.id = veriler.kategori_id'; //sql sorgumu değişkene atadım

if (isset($_GET['arama'])) //eğer bir arama yapılmışsa
{
    //bu ifadeyi de sql ifademe dahil edeceğim:
    $sql .= ' WHERE veriler.baslik LIKE "%' . $_GET['arama'] . '%" || veriler.icerik LIKE "%' . $_GET['arama'] . '%" ';
}

//. operatörü ile ifadeleri birbirine bağlayalım
$sql .= ' ORDER BY veriler.id DESC';


$veriler = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC); //son eklenen verilere göre listele

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
    <div>
        <!--arama var ama içerik yoksa:-->
        <?php if($_GET['arama']): ?>
        Aradığınız kritere uygun veri bulunamadı!
        <?php else: ?>
        <!--İçerik yoksada farklı bir hata mesajı:-->
        Henüz eklenmiş veri bulunmuyor!
        <?php endif; ?>

    </div>
<?php endif; ?>

