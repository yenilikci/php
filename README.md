# PHP
## Başlıklar


* [PDO](https://github.com/yenilikci/php#pdo "PDO")
  * [Veritabanı Bağlantısı](https://github.com/yenilikci/php#veritaban%C4%B1-ba%C4%9Flant%C4%B1s%C4%B1-- "Veritabanı Bağlantısı")
  * [Veri Ekleme (INSERT)](https://github.com/yenilikci/php#veri-ekleme-insert- "Veri Ekleme (INSERT)")
  * [Veri Listeleme (SELECT](https://github.com/yenilikci/php#veri-listeleme-select- "Veri Listeleme (SELECT")) 
  * [Veri Güncelleme (UPDATE)](https://github.com/yenilikci/php#veri-g%C3%BCncelleme-update- "Veri Güncelleme (UPDATE)")
  * [Veri Silme (DELETE) ](https://github.com/yenilikci/php#veri-silme-delete- "Veri Silme (DELETE)")
  * [Birleştirici (JOIN) Kullanımı](https://github.com/yenilikci/php#birle%C5%9Ftirici-join-kullan%C4%B1m%C4%B1- "Birleştirici (JOIN) Kullanımı")
  * [Arama İşlemi (LIKE) Kulanımı](https://github.com/yenilikci/php#arama-i%CC%87%C5%9Flemi-like-kulan%C4%B1m%C4%B1- "Arama İşlemi (LIKE) Kulanımı") 
* [OOP](https://github.com/yenilikci/php#pdo "PDO")
  * [Sınıflar](https://github.com/yenilikci/php#s%C4%B1n%C4%B1flar- "Sınıflar")
  * [Görünürlük](https://github.com/yenilikci/php/blob/master/README.md#g%C3%B6r%C3%BCn%C3%BCrl%C3%BCk- "Görünürlük")


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
INSERT INTO Tablo_Adi SET kolon1 = değer1;
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
SELECT * FROM Tablo_Adi WHERE id = ?;
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
UPDATE Tablo_Adi SET kolon1 = değer1 WHERE kolon=değer;
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
DELETE FROM Tablo_Adi WHERE id = 2;
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
INNER JOIN Tablo_Adi ON Tablo_Adi.id = digerTablo_Adi.id;
```
Inner Join ile ortak değere sahip iki tablodaki ilişkili değerleri seçelim ve birleştirelim.
> Query içinde kullanımı:

```sql
SELECT veriler.id , veriler.baslik , verikategorisi.ad AS kategori_adi , veriler.onay FROM veriler
INNER JOIN verikategorisi ON verikategorisi.id = veriler.kategori_id
ORDER BY veriler.id DESC;
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
    <div>Henüz eklenmiş veri bulunmuyor!</div>
<?php endif; ?>
```
#### Left Join
```sql
SELECT * FROM Tablo_Adi LEFT JOIN digerTablo_Adi ON Tablo_adi.id = digerTablo_Adi.id;
```
Sol tablodaki tüm satırları ve koşula uygun olan sağ tablodaki satırları seçip birleştirelim ve bunları gruplayalım.
> Query içinde kullanımı:

```sql
SELECT verikategorisi.* , COUNT(veriler.id) AS toplamVeri 
FROM verikategorisi
LEFT JOIN veriler ON veriler.kategori_id = verikategorisi.id
GROUP BY verikategorisi.id
```
fetchAll() ile bu verileri çektiğimizi ve $kategori isimli bir değişkene atadığımızı varsayalım.

```php
<ul>
    <?php foreach ($kategori as $kt): ?>
    <li>
        <a href="index.php?sayfa=kategori&id=<?php echo $kt['id'];?>">
            <?php echo $kt['ad']; ?>
            (<?php echo $kt['toplamVeri']; ?>)
        </a>
    </li>
    <?php endforeach; ?>
</ul>
```
### Arama İşlemi (LIKE) Kulanımı [🐘](https://github.com/yenilikci/php/blob/master/PDO/homepage.php "🐘")
```sql
SELECT * FROM Tablo_Adi WHERE Kolon_Adi LIKE "%a%";
```
LIKE komutu WHERE komutu ile birlikte bir kolonda ilgili değeri aramak için kullanılır.

####  Joker Karakterler:
##### * Birden fazla bilinmeyen karakteri sorgulatacaksak kullanırız. 
##### # Bilinmeyen tek rakam için kullanırız.
##### ? Bilinmeyen tek karakter için kullanırız.

> Query içinde kullanımı:

```php
<?php

$sql = ' SELECT veriler.id,veriler.baslik,verikategorisi.ad as kategori_adi,veriler.onay FROM veriler
INNER JOIN verikategorisi ON verikategorisi.id = veriler.kategori_id'; 
//sql sorgumu değişkene atadım

if (isset($_GET['arama'])) //eğer bir arama yapılmışsa
{
    //bu ifadeyi de sql ifademe dahil edeceğim:
    $sql .= ' WHERE veriler.baslik LIKE "%' . $_GET['arama'] . '%" || veriler.icerik LIKE "%' . $_GET['arama'] . '%" ';
}
$sql .= ' ORDER BY veriler.id DESC';


$veriler = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//son eklenen verilere göre listele

?>

```
## OOP
### Sınıflar [🐘](https://github.com/yenilikci/php/blob/master/OOP/sinif.php "🐘")
Bir sınfı tanımlamak için class anahtar kelimesi kullanılır ve ardından sınıfın özel ismi yazılır.
Sınıflar isimlendirilirken barındıracağı özellikler neticesinde ve yerine getireceği işlevler düşünülerek isimlendirme yapılması mantıklı olandır.
İsimlendirme yapılırken türkçe karakter kullanımına izin vermektedir.
Harf veya alt çizgi ile sınıf ismini başlatabiliriz.

**Örnek Sınıf Kullanımı:**
```php
class Uye
{ 
    public $ad = 'Melih'; //özellik tanımlamaları
    public $soyad = 'Celik';
    const DOGUMTARIHI = 1999; //sabit tanımı
    
    //başına public koyulmaz ise varsayılan olarak public atanır
    function stringAdDondur()
    {
        return 'Melih';
    }

    public function stringSoyadDondur()
    {
        return 'Celik';
    }

    //geriye değer döndüren parametreli fonksiyon
    public function kacYasinda($gunumuz,$dogumTarihi)
    {   
        return $gunumuz - $dogumTarihi;
    }

    //özellikleri kullanarak fonksiyon içerisinde değer geri döndürmek için $this kullanılır ve this ile yerel özelliklere erişim sağlanır.
    function adDondur()
    {
        return $this->ad;
    }
    function soyadDondur()
    {
        return $this->soyad;
    }

    //fonksiyon içerisinde fonksiyonumuzu döndürmek isteseydik
    function yasBas()
    {
        return $this->kacYasinda(2020,$this::DOGUMTARIHI);
    }
    
    //sabiti geriye döndürmek
    function dogumTarihi()
    {
        return $this::DOGUMTARIHI;
    }//veya self kullanabiliriz
    function dogumTarihi2()
    {
        return self::DOGUMTARIHI;
    }
}
```
**Şimdi bu sınıftan nesneler türetelim**
```php
//sınıftan nesne olusturma
$uye = new Uye();
//veya 
$uye2 = new Uye;
```
**nesnelerimiz ile bu sınıfın özellik ve metotlarına erişelim:**

> Sınıf içerisindeki özelliklere ve metotlara erişmek için -> işareti kullanılır

Metotlara erişmek ve ekrana yazdırmak
```php
echo $uye->stringAdDondur() . "<br>";
```
Özelliğe erişmek ve ekrana yazdırmak
```php
echo $uye->soyad . "<br>" ;
```
Sabite erişmek ve ekrana yazdırmak
```php
echo $uye::DOGUMTARIHI;
```
uye2 için özelliklere farklı değerler atayalım
```php
$uye2->ad = 'Farklıİsim';
$uye2->soyad = 'FarkliSoyad';
```

uye2'nin değerlerini ekrana yazalım
```php
echo "<hr>";
echo "<br>". $uye2->ad;
echo "<br>". $uye2->soyad;
echo "<br>". $uye2::DOGUMTARIHI;
```
Parametreli metodu çağırmak
```php
echo "<hr>";
echo "KAÇ YAŞINDALAR?" . "<br>";
echo $uye->kacYasinda(2020,$uye::DOGUMTARIHI);
```
Özellik ve fonksiyonları geri döndüren fonskiyonları çağırmak 
```php
echo "<hr>";
echo "Birde özellikleri geri döndürerek ad ve soyadı ekrana bastıralım" . <br>";
echo $uye->adDondur() . "<br>";
echo $uye->soyadDondur()."<br>";
echo "<br>". "Birde metodu geri döndürerek yaşı ekrana bastıralım" . "<br>";
echo $uye->yasBas()."<br>";
```
> this nesneyi referans alır,self ise sınıfı referans alır

This ve self ile sabit döndüren fonksiyonların ekrana bastırılması
```php
echo $uye->dogumTarihi()."<br>"; //this kullanıldı
echo $uye->dogumTarihi2(); //self kullanıldı
```
Çıktı

![php-sınıf-çıktı](https://user-images.githubusercontent.com/57464067/81638248-33ac8f80-9421-11ea-9578-f81f5bb55961.png)

### Görünürlük [🐘](https://github.com/yenilikci/php/blob/master/OOP/gorunurluk.php "🐘")
Bir özellik, sabit ya da metodun görünürlüğünü üç farklı şekilde belirleyebiliriz.
Kullanımlara örnek sınıf üzerinden bakacak olursak:
```php
class Test
{
    public $a = 'a'; //her yerden erişilebilir.

    private $b = 'b'; //sadece sınıf içerisinden erişilebilir

    public function geriDonB()
    {
        return $this->b; //private özelliği public metotta geriye döndürebilirim
    }

    protected $c = 'c';
    //korumalı, aynı private gibi dışarıdan erişilemez sınıf içinde erişilebilir, miras aldığımız sınıfta da kullanabiliriz

    private function geriDonA() //private func
    {
        return $this->a;
    }

    protected function geriDonC() //protected func
    {
        return $this->c;
    }
}
```

Şimdi bu özellik ve metotları ekrana bastırmaya çalışalım
```php
$test = new Test;

echo $test->a; //bu özelliğe rahatça ekrana basabildim

echo $test->b; //bu özelliği ekrana bastırmak istediğimde hata ile karşılaşıyorum

echo $test->geriDonB(); //private özelliği public fonksiyon ile bastırdım

echo $test->c; //hata

echo $test->geriDonA(); //hata

echo $test->geriDonC(); //hata
```
