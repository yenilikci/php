<?php


require __DIR__.'/controller/bildirimler.php';
require __DIR__.'/helper/bildirimler.php';

//Video sınıflarını çağırmak için namespacelere göre işlem yapmam gerekir.

use Uygulama\Controller\Bildirimler; // use namespaceismi\sınıfismi;
$controllerBildirim = new Bildirimler;

echo '<br>';

//veya şöyle bir kullanımda yapabilirim
$helperBildirim = new Uygulama\Helper\Bildirimler;

?>