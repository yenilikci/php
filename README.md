# PHP
## PDO
**Veritabanı adı:** *veri*

**Tablo adı:** *veriler*
| id | baslik  |icerik|onay|tarih|
| --- | --- | --- | --- | ---|
| 1  |  pdo1 | pdo ile veritabani1 | 1|2020-02-15 22:24:39
| 2  |  pdo2 | pdo ile veritabani2 | 1|2020-02-15 22:25:39
| 3  |  pdo3 | pdo ile veritabani3 | 1|2020-02-15 22:26:39
| 4  |  pdo4 | pdo ile veritabani4 | 1|2020-02-15 22:27:39
| 5  |  pdo5 | pdo ile veritabani5 | 1|2020-02-15 22:28:39

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
### Veri Güncelleme (UPDATE) [🐘](https://github.com/yenilikci/php/blob/master/PDO/formUpdate.php "🐘")
```sql
UPDATE Tablo_Adi SET kolon1 = değer1 WHERE kolon=değer
```
```php
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
if ($guncelle) 
{
	header('Location:index.php?sayfa=oku&id=' . $veri['id']);
} 
else
{
	echo "Güncelleme işlemi başarısız!";
}
```
### Veri Silme (DELETE) [🐘](https://github.com/yenilikci/php/blob/master/PDO/sil.php "🐘")
```sql
DELETE FROM Tablo_Adi WHERE id = 2
```
```php
$sorgu = $db -> prepare('DELETE FROM veriler WHERE id = ?'); //veriler tablosunda id'si...

$sorgu -> execute([
    $_GET['id'] //... şu olan veriyi sil
]);

//daha sonra index.php'ye yönlendir.
header('Location:index.php');
```

