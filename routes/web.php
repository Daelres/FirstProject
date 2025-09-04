<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo"************** Variables y tipos de variables **************<br>";
    $name = "Daniel Restrepo";
    $age = rand(18,40);
    $height = 1.86;
    $islogin = true;

    echo"************** Estructuras de control **************<br>";

    echo "Mi nombre es $name, tengo $age años, mido $height metros <br>";

    echo $age > 18 ? "Eres mayor de edad<br>" : "Eres menor de edad<br>";

});
