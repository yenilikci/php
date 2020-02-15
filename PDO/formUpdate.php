<?php require_once 'header.php'?>
<?php
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
        if (!$baslik) {
            echo "Başlık ekleyin";
        } else if (!$icerik) {
            echo "İçerik ekleyin";
        } else {
            //UPDATE Tablo_adi SET kolon1 = değer1 WHERE kolon=değer

            $sorgu = $db->prepare('UPDATE veriler SET
                baslik = ?,
                icerik = ?,
                onay = ?
                WHERE id = ?'); //id'si şu olan...

            //sorgu değişkenimi execute ediyorum ve güncelle değişkenine atıyorum.
            $guncelle = $sorgu->execute([
                $baslik, $icerik, $onay, $veri['id']
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
    Onay: <br>
    <select name="onay">
        <option <?php echo $veri['onay']== 1 ? 'selected' : ''  //ders onay 1'e eşitse onu seçer değilse boş olur.?> value="1">Onaylı</option>
        <option <?php echo $veri['onay'] == 0 ? 'selected' : '' ?> value="0">Onaylı değil</option>
    </select> <br>
    <input type="hidden" name="submit" value="1"> <!--Gizli input değer kontrolü için-->
    <button type="submit">Gönder</button>
</form>
