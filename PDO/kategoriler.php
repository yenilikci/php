<a href="index.php?sayfa=kategori_ekle">[Kategori Ekle]</a>
<?php

//verikategorisi bilgilerini getirmek için.
$kategori = $db -> query('SELECT verikategorisi.* , COUNT(veriler.id) AS toplamVeri 
FROM verikategorisi
LEFT JOIN veriler ON veriler.kategori_id = verikategorisi.id
GROUP BY verikategorisi.id')->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
    <?php foreach ($kategori as $kt): ?>
    <li>
        <a href="index.php?sayfa=kategori&id=<?php echo $kt['id'];?>">
            <?php echo $kt['ad']; ?>
            (<?php echo $kt['toplamVeri']; ?>) <!--Yukarıda COUNT ifadesi sayesinde kategoriler
            için mevcut olan toplam veri sayısı elde edilmiş oldu.-->
        </a>
    </li>
    <?php endforeach; ?>
</ul>


