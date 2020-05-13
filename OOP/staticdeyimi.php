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