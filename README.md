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

> Şimdi ise verilerimizi ilişkilendirebilmek için "**verikategorisi**" isimli bir tablo daha oluşturuyoruz.

**Veritabanı adı:** *veri* (aynı veritabanında çalışıyoruz)

**Tablo adı:** *verikategorisi*

| id | ad  |
| --- | --- |
| 1  |  php |
| 2  |  asp.net core | 
| 3  |  nodejs | 
| 4  |  django |

bununla birlikte **veriler** tablomuza verikategorisi tablosunun id'si ile eşleştireceğimiz **kategori_id** kolonunu ekliyoruz.


| id | baslik  |icerik |kategori_id|onay|tarih|
| --- | --- | --- | --- | ---|---|
| 1  |  pdo1 | pdo ile veritabani1 | 1|1|2020-02-15 22:24:39
| 2  |  pdo2 | pdo ile veritabani2 |1| 1|2020-02-15 22:25:39
| 3  |  pdo3 | pdo ile veritabani3 | 1|1|2020-02-15 22:26:39
| 4  |  pdo4 | pdo ile veritabani4 | 1|1|2020-02-15 22:27:39
| 5  |  pdo5 | pdo ile veritabani5 | 1|1|2020-02-15 22:28:39

### Birleştirici (JOIN) Kullanımı [🐘](https://github.com/yenilikci/php/blob/master/PDO/homepage.php "🐘")
```sql
INNER JOIN Tablo_Adi ON Tablo_Adi.id = digerTablo_Adi.id
```
Inner Join ile ortak değere sahip iki tablodaki ilişkili değerleri seçelim ve birleştirelim.
> Query içinde kullanımı:

```sql
SELECT veriler.id , veriler.baslik , verikategorisi.ad AS kategori_adi , veriler.onay FROM veriler
INNER JOIN verikategorisi ON verikategorisi.id = veriler.kategori_id
ORDER BY veriler.id DESC
```
fetchAll() ile bu verileri çektiğimizi ve $veriler isimli bir değişkene atadığımızı varsayalım.

```php
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
```


