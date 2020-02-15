<?php
//burada veritabanına form ile ekleme işlemi yapacağız.
//veriler diye bir tablo oluşturduğumuzu varsayalım.

/*                                                   veriler
 *  ==================================================================================================
 * id -> int (PK) , baslik -> varchar , icerik -> text , onay -> int , tarih-> timestamp (current_timestap())
 */

//form gönderilmiş.
if (isset($_POST['submit']))
{
    $baslik = isset($_POST['baslik']) ? $_POST['baslik'] : null;
    $icerik = isset($_POST['icerik']) ? $_POST['icerik'] : null;
    $onay = isset($_POST['onay']) ? $_POST['onay'] : null;
    if (!$baslik)
    {
        echo "Başlık ekleyin";
    }else if(!$icerik)
    {
        echo "İçerik ekleyin";
    } else
    {
        //veriler tablosuna ekleme işlemi
        $sorgu = $db->prepare('INSERT INTO veriler SET
        baslik = ?,
        icerik = ?,
        onay = ?');

        //baslik,icerik ve onayı işlem dizisine koyuyorum.
        $ekle = $sorgu -> execute([
            $baslik,
            $icerik,
            $onay
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
    Onay: <br>
    <select name="onay">
        <option value="1">Onaylı</option>
        <option value="0">Onaylı değil</option>
    </select> <br>
    <input type="hidden" name="submit" value="1"> <!--Gizli input değer kontrolü için-->
    <button type="submit">Gönder</button>
</form>
