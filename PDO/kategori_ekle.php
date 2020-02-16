<?php
if (isset($_POST['ad']))
{
    if (empty($_POST['ad']))
    {
        echo "Lütfen kategori adı belirtiniz!";
    }
    else
    {
        //kategori ekle
        $sorgu = $db -> prepare('INSERT INTO verikategorisi SET
        ad = ?');

        $ekle = $sorgu -> execute([
            $_POST['ad']
        ]);

        //eğer ekleme başarılı ise
        if ($ekle)
        {
            header('Location:index.php/?sayfa=kategoriler');
        }
        else //değilse
        {
            echo "Kategori eklenemedi!";
        }
    }

}

?>

<form action="" method="post">
    Kategori Adı: <br>
    <input type="text" name="ad">
    <button type="submit">Gönder</button>
</form>