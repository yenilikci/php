<?php
//burada veritabanına form ile ekleme işlemi yapacağız.
//veriler diye bir tablo oluşturduğumuzu varsayalım.

/*                                                   veriler
 *  ==================================================================================================
 * id -> int (PK) , baslik -> varchar , icerik -> text , onay -> int , tarih-> timestamp (current_timestap())
 */

//kategoriler için
$sorgu = $db -> prepare('SELECT * FROM verikategorisi ORDER BY ad ASC'); //a-z'ye sıralama
$sorgu -> execute();
$getir = $sorgu -> fetchAll(PDO::FETCH_ASSOC);

//form gönderilmiş.
if (isset($_POST['submit']))
{
    $baslik = isset($_POST['baslik']) ? $_POST['baslik'] : null;
    $icerik = isset($_POST['icerik']) ? $_POST['icerik'] : null;
    $onay = isset($_POST['onay']) ? $_POST['onay'] : 0;
    //yeni eklendi:
    $kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : null;

    if (!$baslik)
    {
        echo "Başlık ekleyin";
    }else if(!$icerik)
    {
        echo "İçerik ekleyin";
    }else if(!$kategori_id)
    {
        echo "Kategori seçin!";
    }else
    {
        //veriler tablosuna ekleme işlemi
        $sorgu = $db->prepare('INSERT INTO veriler SET
        baslik = ?,
        icerik = ?,
        onay = ?,
        kategori_id = ?');

        //baslik,icerik ve onayı işlem dizisine koyuyorum.
        $ekle = $sorgu -> execute([
            $baslik,
            $icerik,
            $onay,
            $kategori_id
        ]);

        //eğer ekleme işlemi başarılıysa
        if ($ekle)
        {
            //yönlendirme işlemi yapıyorum.
            header('Location:index.php');
        } else {
            $hata = $sorgu -> errorInfo();
            echo "MySQL Hatası: ".$hata[2];
        }

    }

}
?>

<form action="" method="post">
    Başlık: <br>
    <input type="text" name="baslik" value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : '' ?>"> <br>
    <!--baslik inputu içinde yazdığım php kodu ile eğer bir submit işlemi olduysa değeri içinde tutup
    yazacak ve veri kaybı olmayacak eğer zaten bir değeri yoksa input içinde boş bir string yazacak.-->
    İçerik: <br>
    <textarea name="icerik" cols="30" rows="10"></textarea> <br>

    Kategori: <br>
    <select name="kategori_id">
        <option value="">-- Kategori Seçin --</option>
        <?php foreach ($getir as $gt): ?>
            <option value="<?php echo $gt['id'];?>"><?php echo $gt['ad']; ?></option>
        <?php endforeach; ?>
    </select>

    <br>

    Onay: <br>
    <select name="onay">
        <option value="1">Onaylı</option>
        <option value="0">Onaylı değil</option>
    </select> <br>
    <input type="hidden" name="submit" value="1"> <!--Gizli input değer kontrolü için-->
    <br>
    <button type="submit">Gönder</button>
</form>
