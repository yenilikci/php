# PHP
## PDO
### Veritabanı Bağlantısı  [🐘](https://github.com/yenilikci/php/blob/master/PDO/baglan.php "🐘")
```php
<?php
    try
    {
	//PDO Nesnesi. Parametreler: dsn,username,passwd
        $db = new PDO('mysql:host=localhost;dbname=veri','root',''); 
    }
    catch (PDOException $e)
    {
        //bağlantı başarısız olursa hatayı yakalayıp bilgi alıyoruz.
        $e -> getMessage();
    }
?>
```
### Veri Ekleme (INSERT) [🐘](https://github.com/yenilikci/php/blob/master/PDO/formInsert.php "🐘")
```sql
INSERT INTO Tablo_Adi SET kolon1=değer1
```
```php
//veriler tablosuna ekleme işlemi
$sorgu = $db -> prepare('INSERT INTO veriler SET
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
        } 
else 
        {
            //değilse hata mesajını alıp ekrana basıyoruz.
            $hata = $sorgu -> errorInfo();
            echo "MySQL Hatası: ".$hata[2];
        }
```
### Veri Listeleme (SELECT) 🐘
```sql
SELECT * FROM Tablo_Adi WHERE id = ?
```
```php
//veriler tablosundan id'si =
$sorgu = $db -> prepare('SELECT * FROM veriler WHERE id=?');
$sorgu -> execute([
    //get edilen id'ye eşit olanı al
    $_GET['id']
]);

//zaten tek bir veri alacağız o yüzden fetch() kullandım. (o id'ye ait olan)
$veri = $sorgu -> fetch(PDO::FETCH_ASSOC)
```
