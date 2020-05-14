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

echo $sonyorumlar->show();
echo "<br>";
echo $sosyalmedya->show();

?>