<?php
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

    //
    case 'oku':
        require_once 'oku.php';
        break;

    case 'formUpdate':
        require_once 'formUpdate.php';
        break;
}


?>