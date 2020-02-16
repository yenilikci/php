<?php

//yeni eklendi:
$sorgugetir = $db -> prepare('SELECT * FROM verikategorisi ORDER BY ad ASC'); //a-z'ye sıralama
$sorgugetir -> execute();
$getir = $sorgugetir -> fetchAll(PDO::FETCH_ASSOC);

//eğer gönderilmeye çalışılan id değişkeni yoksa veya boşsa
if (!isset($_GET['id']) ||empty($_GET['id']))
{
    header('Location:index.php');
    exit;
}

$sorgu = $db -> prepare('SELECT * FROM veriler
WHERE id = ?');

//gönderilen id değerini execute et.
$sorgu -> execute([
    $_GET['id']
]);

//tek bir id'yi çekeceğim için fetch()
$veri = $sorgu -> fetch(PDO::FETCH_ASSOC);

//eğer veri yoksa
if (!$veri)
{
    //direk index'e yönlensin.
    header('Location:index.php');
    exit;
}

if (isset($_POST['submit'])) {
    {
        $baslik = isset($_POST['baslik']) ? $_POST['baslik'] : $veri['baslik'];
        $icerik = isset($_POST['icerik']) ? $_POST['icerik'] : $veri['baslik'];
        $onay = isset($_POST['onay']) ? $_POST['onay'] : 0; //onay yoksa zaten 0 olsun
        //yeni eklendi:
        $kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : null;

        if (!$baslik) {
            echo "Başlık ekleyin";
        } else if (!$icerik) {
            echo "İçerik ekleyin";
        }else if (!$kategori_id)
        {
            echo "Kategori seçin!";
        } else {
            //UPDATE Tablo_adi SET kolon1 = değer1 WHERE kolon=değer

            $sorgu = $db->prepare('UPDATE veriler SET
                baslik = ?,
                icerik = ?,
                onay = ?,
                kategori_id = ?
                WHERE id = ?'); //id'si şu olan...

            //sorgu değişkenimi execute ediyorum ve güncelle değişkenine atıyorum.
            $guncelle = $sorgu->execute([
                $baslik, $icerik, $onay,$kategori_id, $veri['id']
            ]);

            //eğer güncelleme başarılıysa
            if ($guncelle) {
                header('Location:index.php?sayfa=oku&id=' . $veri['id']);
            } else {
                echo "Güncelleme işlemi başarısız!";
            }
        }
    }
}
?>

<form action="" method="post">
    Başlık: <br>
    <input type="text" name="baslik" value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : $veri['baslik'] ?>"> <br>
    <!--baslik inputu içinde yazdığım php kodu ile eğer bir submit işlemi olduysa değeri içinde tutup
    yazacak ve veri kaybı olmayacak eğer zaten bir değeri yoksa benim kendi başlık değerimi gösterecek.-->
    İçerik: <br>
    <textarea name="icerik" cols="30" rows="10"></textarea> <br>

    Kategori: <br>
    <select name="kategori_id">
        <option value="">-- Kategori Seçin --</option>
        <?php foreach ($getir as $gt): ?>
            <option <?php echo $gt['id'] == $veri['kategori_id'] ? 'selected' : null ?> value="<?php echo $gt['id'];?>"><?php echo $gt['ad']; ?></option>
        <?php endforeach; ?>
    </select>

    <br>

    Onay: <br>
    <select name="onay">
        <option <?php echo $veri['onay']== 1 ? 'selected' : ''  //ders onay 1'e eşitse onu seçer değilse boş olur.?> value="1">Onaylı</option>
        <option <?php echo $veri['onay'] == 0 ? 'selected' : '' ?> value="0">Onaylı değil</option>
    </select> <br>
    <input type="hidden" name="submit" value="1"> <!--Gizli input değer kontrolü için-->
    <button type="submit">Gönder</button>
</form>
