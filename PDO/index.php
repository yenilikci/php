<?php

ob_start();
require_once 'header.php';

//LIKE kullanımı işlenirken eklendi:
$_GET = array_map(function ($get)
{
    //güvenlik önlemimiz
    return htmlspecialchars(trim($get));

}, $_GET);


//sayfa isimli get değerim var mı diye kontrol ediyor eğer yoksa kendim bu değere index atıyorum.
if (!isset($_GET['sayfa']))
{
    $_GET['sayfa']='index';
}

switch ($_GET['sayfa'])
{
    //eğer burası index ise
    case 'index':
        require_once 'homepage.php';
        break;

    //eğer case 'insert' ise
    case 'insert':
        //insert.php dahil edildi.
        require_once 'insert.php';
        break;

    //eğer case 'formInsert' ise
    case 'formInsert':
        //formInsert.php dahil edildi.
        require_once 'formInsert.php';
        break;

    //veri ayrıntı sayfası
    case 'oku':
        require_once 'oku.php';
        break;

    //veri güncelleme
    case 'formUpdate':
        require_once 'formUpdate.php';
        break;

    //veri sil
    case 'sil':
        require_once 'sil.php';
        break;

    //kategoriler
    case 'kategoriler':
        require_once 'kategoriler.php';
        break;

    //kategori ekle
    case 'kategori_ekle':
        require_once 'kategori_ekle.php';
        break;

    //kategori
    case 'kategori':
        require_once 'kategori.php';
        break;
}


?>