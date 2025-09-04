<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "************** Variables y tipos de variables **************<br>";
    $name = "Daniel Restrepo";
    $age = rand(18, 40);
    $height = 1.86;
    $islogin = true;

    echo "************** Estructuras de control **************<br>";

    echo "Mi nombre es $name, tengo $age años, mido $height metros <br>";

    echo $age > 18 ? "Eres mayor de edad<br>" : "Eres menor de edad<br>";

    echo "************** Funcionaes **************<br>";

    printUserWithCallBack(name: $name, edad: $age, callBack: function () {
        echo "Esta es una función callback<br>";
    });

    echo "************** Listas y mapas **************<br>";

    $lista = ["Daniel", "Andres", "Camila", "Sofia"];
    foreach ($lista as $key => $value) {
        echo "El índice es $key y el valor es $value<br>";
    }
});

function printUser(string $name, int $edad)
{
    return "El nombre del usuario es $name y su edad es $edad<br>";
}

function printUserWithCallBack(string $name, int $edad, callable $callBack)
{
    echo "Soy $name y tengo $edad años<br>";
    $callBack();
}
