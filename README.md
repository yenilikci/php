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
  * [Kurucu ve Yıkıcı Metot](https://github.com/yenilikci/php/blob/master/README.md#kurucu-ve-y%C4%B1k%C4%B1c%C4%B1-metot- "Kurucu ve Yıkıcı Metot")
  * [Kalıtım](https://github.com/yenilikci/php/blob/master/README.md#kal%C4%B1t%C4%B1m- "Kalıtım")
  * [Static Deyimi](https://github.com/yenilikci/php#static-deyimi- "Static Deyimi")
  * [Sınıf Sabitleri](https://github.com/yenilikci/php#s%C4%B1n%C4%B1f-sabitleri- "Sınıf Sabitleri")
  * [Sınıf Soyutlama](https://github.com/yenilikci/php#s%C4%B1n%C4%B1f-soyutlama- "Sınıf Soyutlama")
  * [Arayüzler](https://github.com/yenilikci/php#aray%C3%BCzler- "Arayüzler")
  * [İsim Uzayları](- "İsim Uzayları")


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
<?php
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
?>
```
**Şimdi bu sınıftan nesneler türetelim**
```php
<?php
//sınıftan nesne olusturma
$uye = new Uye();
//veya 
$uye2 = new Uye;
?>
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
<?php
echo "<hr>";
echo "<br>". $uye2->ad;
echo "<br>". $uye2->soyad;
echo "<br>". $uye2::DOGUMTARIHI;
?>
```
Parametreli metodu çağırmak
```php
<?php
echo "<hr>";
echo "KAÇ YAŞINDALAR?" . "<br>";
echo $uye->kacYasinda(2020,$uye::DOGUMTARIHI);
?>
```
Özellik ve fonksiyonları geri döndüren fonskiyonları çağırmak 
```php
<?php
echo "<hr>";
echo "Birde özellikleri geri döndürerek ad ve soyadı ekrana bastıralım" . <br>";
echo $uye->adDondur() . "<br>";
echo $uye->soyadDondur()."<br>";
echo "<br>". "Birde metodu geri döndürerek yaşı ekrana bastıralım" . "<br>";
echo $uye->yasBas()."<br>";
?>
```
> this nesneyi referans alır,self ise sınıfı referans alır

This ve self ile sabit döndüren fonksiyonların ekrana bastırılması
```php
<?php
echo $uye->dogumTarihi()."<br>"; //this kullanıldı
echo $uye->dogumTarihi2(); //self kullanıldı
?>
```
Çıktı

![php-sınıf-çıktı](https://user-images.githubusercontent.com/57464067/81638248-33ac8f80-9421-11ea-9578-f81f5bb55961.png)

### Görünürlük [🐘](https://github.com/yenilikci/php/blob/master/OOP/gorunurluk.php "🐘")
Bir özellik, sabit ya da metodun görünürlüğünü üç farklı şekilde belirleyebiliriz.
Kullanımlara örnek sınıf üzerinden bakacak olursak:
```php
<?php
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
?>
```

Şimdi bu özellik ve metotları ekrana bastırmaya çalışalım
```php
<?php
$test = new Test;

echo $test->a; //bu özelliğe rahatça ekrana basabildim

echo $test->b; //bu özelliği ekrana bastırmak istediğimde hata ile karşılaşıyorum

echo $test->geriDonB(); //private özelliği public fonksiyon ile bastırdım

echo $test->c; //hata

echo $test->geriDonA(); //hata

echo $test->geriDonC(); //hata
?>
```
### Kurucu ve Yıkıcı Metot [🐘](https://github.com/yenilikci/php/blob/master/OOP/kurucuyikici.php "🐘")

Kurucu metot bir sınıf başlatıldığında otomatik olarak çağrılacak fonksiyondur.
```php
<?php
    public function __construct($a)
    {
			.		.		.
    }
?>
```

Yıkıcı metot bir sınıfın çalışması bittiğinde çalışacak son metot.
```php
<?php
    public function __destruct()
    {
			.		.		.
    }
?>
```

Örneğin;
```php
<?php

class YapYik
{
    private $degisken;

    //parametreli kurucu metot
    public function __construct($a)
    {
        $this->degisken = $a;
        echo $this->degisken.PHP_EOL;
    }

    public function bas()
    {
        echo 'ekrana yazı bastım'.PHP_EOL;
    }

    //yıkıcı metot
    public function __destruct()
    {
        echo 'yıkıcı metot çalıştı'.PHP_EOL;
    }

}
 
$nesne = new YapYik('Kurucu metot çalıştı');
$nesne->bas();

?>
```
Çıktı

![çıktı](https://user-images.githubusercontent.com/57464067/81704814-f377fc00-9476-11ea-9aed-2387e4953b53.png)

### Kalıtım [🐘](https://github.com/yenilikci/php/blob/master/OOP/kalitim.php "🐘")

Kalıtım sınıf ve nesne ilişkilerini düzenleyen iyi kurgulanmış bir prensiptir.
Türeyen sınıflar ,türetilen sınıfların özellik ve metotlarını public ve protected olduğu sürece kullanabilirler.
Genişletmek için extends deyimi kullanılır.

Örnek bir temel(base) - ebeveyn(parent) sınıf :
```php
<?php
class Calisan
{
    public $maas;
    public $adsoyad;

    public function setAdSoyad($adsoyad)
    {
        //sınıfın içerisindeki adsoyad dışarıdan gelen adsoyad değerine eşit olsun
        $this->adsoyad = $adsoyad;
    }

    public function maas($maas)
    {
        //sınıfın içerisinde maas dışarıdan gelen maas değerine eşit olsun
        $this->maas = $maas;
    }

    public function senelikMaas()
    {
        return ($this->maas*12).'₺';
    }
}
?>
```

Calisan sınıfından türetilen Muhasebe sınıfı:
```php
<?php
class Muhasebe extends Calisan{}
?>
```
Calisan sınıfından türetilen IT sınıfı:
> Temel sınıfta bulunan bir fonksiyonu türeyen sınıfta tekrar tanımlayıp ama temel sınıftaki fonksiyonu kullanmak istersem parent deyimini kullanırım
```php
<?php
class IT extends Calisan{
    public function senelikMaas()
    {
        return 'IT Çalışanı: '.$this->adsoyad.' senelik maaş olarak '.parent::senelikMaas();
    }
}
?>
```

Zincirleme olarak kalıtım almak ve en aşağıdaki sınıftan en temel sınıfın özellik ve metotlarına erişmek:
```php
<?php
class x
{
    public function bas()
    {
        return 'x:bas';
    }
}
class y extends x
{
    public function bas()
    {
        return 'y:bas';
    }
}
class z extends y
{
    public function bas()
    {
        return 'z:bas';
    }
    public function basGetir()
    {
        return [
            'z' => self::bas(),
            'y' => parent::bas(),
            'x' => x::bas()
        ];
    }
}

$z = new z;
print_r($z->basGetir());
?>
```
### Static Deyimi [🐘](https://github.com/yenilikci/php/blob/master/OOP/staticornek.php "🐘")

Static tanımlama ile sınıf örneği oluşturmadan o sınıfın static metot ve özelliklerine erişilebilir.
Bu erişimi sağlamak için çift iki nokta erişecini kullanırız. (::)
Fakat php şu anda sınıfların static "METOTLARINA" sınıf örneği oluşturarakta erişime izin vermektedir.
Static metotlar ilk çağrıldığında ram'e aktarılır ve daha sonra ramden okunur, performans açısından kuvvetlidir.

```php
<?php

class Test
{
    public static function selam()
    {
        return 'selam';
    }
}

//içerisinde static metot olan bir sınıfımız varsa 
echo Test::selam(); //new ile oluşturmadan bu şekilde metotu çağırabilirim

?>
```
Static metotlar içerisinde yalnızca sınıfın static özelliklerine erişim sağlanabilir.

```php
<?php

class Test
{
    public static $b = 'test2';

    public static function test()
    {

        return self::$b;
    }
}

?>
```
Dosya yazma, okuma işlemlerini gerçekleştiren static metotlar yazalım ve bunlara hem sınıf örneği başlatarak hemde sınıf örneği kullanmadan erişelim:

```php
<?php

class File
{
    public static $dosyaAdi;
    public static function Olustur($dosyaAdi,$icerik)
    {
        self::$dosyaAdi = $dosyaAdi;
        $dosya = fopen($dosyaAdi,'w+');
        fwrite($dosya,$icerik);
        fclose($dosya);
    }
    public static function Oku($dosyaAdi = null)
    {   
        if(!$dosyaAdi) $dosyaAdi = self::$dosyaAdi; 
        return file_get_contents($dosyaAdi);
    }
}
//sınıfın örneğini oluşturmadan
File::Olustur('a.txt','deneme içeriği');

//sınıf örneklenerek
$ds = new File;
echo $ds->Oku();

?>
```
### Sınıf Sabitleri [🐘](https://github.com/yenilikci/php/blob/master/OOP/sabit.php "🐘")

Sınıf sabitleri tanımlanırken **const** ifadesi kullanılır. Değişkenler gibi tanımlanırken $ imi kullanılmaz. 
Sabitlerin değeri bir değişken,bir sınıfa ait özellik veya bir işlem olmamalıdır. Sınıf sabitleri "HER SINIF İÇİN BİR KERE AYRILIR", her sınıf örneği için ayrılmaz.

Örneğin File isminde bir sınıfımız olsun ve DIRECTORY isimli bir sabit içersin:
```php
<?php
class File
{

    const DIRECTORY = __DIR__; // __DIR__ hangi dizinde ise bize onun ismini döndürür
    public function getDirectory()
    {
        return self::DIRECTORY; //dizin yolunu geri döndürür, self(sınıfı referans alır) ile eriştim
    }

}
?>
```
Geri dönen değeri ekranda görmek:
```php
<?php
$file = new File;
echo $file->getDirectory();

//veya sınıfı başlatmadan da sabitin değerini alabiliriz

echo "<br>". File::DIRECTORY;
?>
```
Şimdi de Folder isimli bir sınıf tanımlayalım ve bu da File sınıfından türetilsin:
```php
<?php
class Folder extends File
{
    public function getDirectory()
    {
        return parent::DIRECTORY; //File sınıfındaki DIRECTORY sabitini kullandım, parent(temel sınıfı)'ı baz aldım.
    }
}
?>
```
Dizin değerini geri döndürme işlemini Folder sınıfının nesnesi ile yapalım:
```php
<?php
$folder = new Folder;
echo "<br>". $folder->getDirectory();
?>
```
Çıktımız şu şekilde olacaktır:

![const-ifadesi](https://user-images.githubusercontent.com/57464067/81931351-9f922200-95f2-11ea-88fa-a8cecf8906b8.png)

### Sınıf Soyutlama [🐘](https://github.com/yenilikci/php/blob/master/OOP/soyutlama.php "🐘")

Sınıfın başına **abstract** deyimi getirilerek bu sağlanır. Soyut sınıflarda soyut metotların (soyut metotlar tanımlanırken yine abstract deyimini kullanırız) yanında soyut olmayan metotlar da kullanılabilmektedir.
Bu özelliği ile arayüzlerden ayrılır ve esneklik kazanır. Tanımladığımız başka bir sınıfı extends deyimi ile tanımlanan herhangi bir soyut sınıftan türetebiliriz. Türetilen bu sınıfta soyut sınıfta tanımlanan soyut metotlar bulunmak zorundadır.
Soyut sınıflar başlatılamazlar, soyut sınıftan türettiğim normal sınıflarım ise başlatılabilirler. Soyut sınıfların soyut metotlarında sadece fonksiyon başlığı yazılır, fonksiyon gövdesi yazılmaz.

Örneğin PHP tabanlı bir CMS'e eklenti geliştirdiğimiz senaryoyu ele alalım bu basit ama anlaşılır bir örnek olacak.
Eklenti isimli bir soyut sınıf tasarlayalım:

```php
<?php
abstract class Eklenti //soyut sınıf
{
    abstract public function setTitle($title); //soyut metot, gövdesi yazılmaz, zorunluluk bildirir
    abstract public function setContent($content); //soyut metot, gövdesi yazılmaz, zorunluluk bildirir
    //normal metot 
    public function show()
    {
        echo '<h1>'.$this->title.'</h1>';
        echo '<p>'.$this->content.'</p>';
    }
}
?>
```
Sınıfın title ve content özelliklerini az sonra anlamlandıracağız, şimdi ise Eklenti isimli soyut sınıftan türeyen iki adet sınıf tanımlayalım.

SonYorumlar sınıfı:
```php
<?php
class SonYorumlar extends Eklenti //soyut sınıftan türedi
{
    public function setTitle($title)
    {
        //özelliğin tanımı metot içinde yapıldı (title)
        $this->title = $title;
    }
    public function setContent($content)
    {
        //özelliğin tanımı metot içinde yapıldı (content)
        $this->content = $content;
    }
}
?>
```
SosyalMedya sınıfı:
```php
<?php
class SosyalMedya extends Eklenti //soyut sınıftan türedi
{
    public function setTitle($title)
    {
        //özelliğin tanımı metot içinde yapıldı (title)
        $this->title = $title;
    }
    public function setContent($content)
    {
        //özelliğin tanımı metot içinde yapıldı (content)
        $this->content = $content;
    }
}
?>
```

Daha sonrasında bu iki sınıfımı başlatıyorum, title ve content özelliklerini set ediyorum:
```php
<?php
//SonYorumlar sınıfını başlatıyorum
$sonyorumlar = new SonYorumlar;
//değerleri set edelim
$sonyorumlar->setTitle('Son Yorumlar');
$sonyorumlar->setContent('Son Yorumlar Burada Gözükecek');

//SosyalMedya sınıfını başlatıyorum
$sosyalmedya = new SosyalMedya;
//değerleri set edelim
$sosyalmedya->setTitle('Sosyal Medya');
$sosyalmedya->setContent('Sosyal Medya Bağlantıları Burada Gözükecek');
?>
```
Şimdi ise soyut sınıfımda tanımladığım ama soyut olmayan show() metodum ile set edilen özellikleri her bir nesnem için çağırıyorum:
```php
<?php
echo $sonyorumlar->show();
echo "<br>";
echo $sosyalmedya->show();
?>
```
Çıktı şu şekilde olacaktır:

![title-content](https://user-images.githubusercontent.com/57464067/81936930-9194cf00-95fb-11ea-87ac-a28366bfefa3.png)

### Arayüzler [🐘](https://github.com/yenilikci/php/blob/master/OOP/arayuz.php "🐘")

Arayüz tanımlamak için **interface** deyimini kullanırız. Arayüzler soyut sınıflara benzer fakat bazı temel farklılıkları vardır.
Öncelikli farkı **arayüz**lerin tüm erişim belirleyicileri **public** olmak zorundadır, **soyut sınıf**larda bu **public, protected veya private** olabilir. <br>
**Arayüzler** soyut metotlar ve sabitler içerir, **soyut sınıflar** soyut metotlar,sabitler,normal metotlar ve özellikler içerir. <br>
**PHP** dilinde **arayüzlerin** diğer dillerden bir farklılığı vardır, **static metotları da içerebilir**. <br>
Arayüzler nesne olarak başlatılamazlar (new anahtar kelimesi ile). <br>
Arayüzlerin içerisinde **kurucu** ve **yıkıcı** metotlar **tanımlanabilir**. <br>
Arayüzler kendi içerisinde **extends** deyimi ile genişleyebilir Hatta birden fazla arayüz kalıtılabilir **PHP** de sıfılar arasında çoklu kalıtım desteklenmese de arayüzler arasında bu mümkündür. <br>
Aynı sınıfta birden fazla **arayüz** kullanılabilir, fakat aynı sınıf sadece bir **abstract** sınıftan türeyebilir.

Örneğin Islem adında bir arayüz tanımlayalım:
```php
<?php
interface Islem
{
    public function Olustur($tabloAdi,$id);
    public function Oku($tabloAdi,$id);
    public function Guncelle($tabloAdi,$veri,$id);
    public function Sil($tabloAdi,$id);
}
?>
```

Bundan farklı olarak birde VT adında bir arayüz tanımlayalım:
```php
<?php
interface VT 
{
    public function baglan($host,$dbname,$kadi,$sifre);
}
?>
```
Şimdi ise Veritabani sınıfımıza bu arayüzleri implement edelim:
```php
<?php
class VeriTabani implements Islem,VT
{
    public function baglan($host,$dbname,$kadi,$sifre)
    {

    }

    public function Olustur($tabloAdi,$id)
    {

    }
    public function Oku($tabloAdi,$id)
    {

    }
    public function Guncelle($tabloAdi,$veri,$id)
    {
        
    }
    public function Sil($tabloAdi,$id)
    {

    }
}
?>
```
Görüldüğü üzere arayüzlerde tanımlanan fonksiyonların hepsi implemente edilen VeriTabani sınıfında kullanıldı, eğer bu fonksiyonları VeriTabani sınıfında yazmasaydık hata alırdık. Fonksiyonların başında herhangi bir abstract deyimi yer almasada arayüzlerde tanımlanan fonksiyonlar soyut fonksiyon olarak tanımlandı.

PHP de çoklu arayüz kullanımı ve multi-inheritance istisnası:
```php
<?php
interface x
{
    public function basX();
}

interface y
{
    public function basY();
}

interface z extends x,y
{
    public function basZ();
}

class Test implements z
{
    public function basX()
    {
        
    }
    public function basY()
    {
        
    }
    public function basZ()
    {

    }
}
?>
```
### İsim Uzayları [🐘](https://github.com/yenilikci/php/tree/master/OOP/namespace/uygulama "🐘")

Birden çok geliştiricisi olan bir projenin kütüphaneleri yazılırken aynı isimli sınıflar oluşturulmuş olabilir. Biz bu sınıfları kullanmak istediğimizde uygulamamız hangi kütüphanedeki sınıfı çağırması gerektiğini bilemez ve fatal error benzeri sorunlar ile karşılaşırız.Bu ve bunun gibi hataların önüne geçmek için isim uzaylarını kullanmamız gerekmektedir.
Aynı isimli iki sınıfı farklı isim uzayları altında tanımlar ve bu isime göre sınıfımızı çağırırsak karışıklık ortadan kalkar ve modülerlik artar.

İsim uzayı tanımlayabilmek için **namespace** deyimini kullanmamız gerekmektedir.Örneğin iki tane sınıf yazalım ve bu iki sınıfımızın ismi de Bildirimler olsun. Bir tanesi Uygulama klasörünün altındaki Helper klasörü altında diğeri ise Uygulama klasörünün altındaki Controller klasöründe yazılmış olsun.

İsim uzayları tanımlanırken okunabilirliği artırmak için içinde bulunduğu klasör dizin yapısına göre isimlendirilmesi büyük kolaylık sağlayacaktır. Örneğin;

```php
<?php
namespace Uygulama\Helper;
?>
```
ve

```php
<?php
namespace Uygulama\Controller;
?>
```
gibi tanımlamalar yapabiliriz. Burada aslında bir klasör eşleşmesi yoktur, sınıfları gerçeklerken kolaylık olsun ve anlaşılır olsun diye isim uzaylarımızı böyle isimlendirdik.

ve şimdi bu isim uzayları içerisinde sınıflarımızı tanımlayalım iki sınıfımızın ismi de Bildirimler olsun.

#### uygulama->controller altındaki Bildirimler sınıfı:
```php
<?php
namespace Uygulama\Controller;

class Bildirimler
{
    public function __construct()
    {
        echo 'Controller İçin Bildirimler oluşturuldu!';
    }
}
?>
```

#### uygulama->helper altındaki Bildirimler sınıfı:

```php
<?php
namespace Uygulama\Helper;

class Bildirimler
{
    public function __construct()
    {
        echo 'Helper İçin Bildirimler oluşturuldu!';
    }
}
?>
```

Uygulama içerisindeki index.php içerisinde bu iki sınıfı gerçekleyelim bunu **use** deyimini kullanarak yapabiliriz.

```php
<?php
// use deyimini kullanarakta yapabilirim
use Uygulama\Controller\Bildirimler; // use namespaceismi\sınıfismi;
$controllerBildirim = new Bildirimler
?>
```
veya use deyimini **kullanmayarak**, direk nesne oluştururken isim uzayını sınıf isminin başına ekleyerekte bunu sağlayabilirim.
```php
<?php
//veya şöyle bir kullanımda yapabilirim
$helperBildirim = new Uygulama\Helper\Bildirimler;
?>
```
#### index.php dosyasının son hali :

```php
<?php
require __DIR__.'/controller/bildirimler.php';
require __DIR__.'/helper/bildirimler.php';

// use deyimini kullanarakta yapabilirim
use Uygulama\Controller\Bildirimler; // use namespaceismi\sınıfismi;
$controllerBildirim = new Bildirimler;

echo '<br>';

//veya şöyle bir kullanımda yapabilirim
$helperBildirim = new Uygulama\Helper\Bildirimler;

?>
```
çıktımız ise şu şekilde olacaktır:

![controller-helper](https://user-images.githubusercontent.com/57464067/82132175-94ebae80-97e5-11ea-9347-f8b11f16ffaf.png)






