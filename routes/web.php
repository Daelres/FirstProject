<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Calculadora (solo vistas y rutas)
Route::match(['get', 'post'], '/calculadora', function (Request $request) {
    $result = null;
    $error = null;

    if ($request->isMethod('post')) {
        $data = $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'op' => 'required|in:sum,sub,mul,div',
        ]);
        $a = (float)$data['a'];
        $b = (float)$data['b'];
        $op = $data['op'];
        try {
            switch ($op) {
                case 'sum':
                    $result = $a + $b;
                    break;
                case 'sub':
                    $result = $a - $b;
                    break;
                case 'mul':
                    $result = $a * $b;
                    break;
                case 'div':
                    if ($b == 0.0) {
                        throw new \InvalidArgumentException('División por cero no permitida');
                    }
                    $result = $a / $b;
                    break;
            }
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
    }

    return view('calculator', [
        'result' => $result,
        'error' => $error,
        'old' => $request->all(),
    ]);
})->name('calculator.view');

// Conversor de moneda
Route::match(['get', 'post'], '/moneda', function (Request $request) {
    $rates = [
        'USD' => 1.0,
        'EUR' => 0.92,
        'COP' => 4000.0,
        'MXN' => 18.0,
    ];
    $output = null;
    $error = null;
    if ($request->isMethod('post')) {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'from' => 'required|in:USD,EUR,COP,MXN',
            'to' => 'required|in:USD,EUR,COP,MXN',
        ]);
        $amount = (float)$data['amount'];
        $from = $data['from'];
        $to = $data['to'];
        if ($amount < 0) {
            $error = 'El monto no puede ser negativo';
        } else {
            $usd = $amount / $rates[$from];
            $output = $usd * $rates[$to];
        }
    }
    return view('currency', compact('rates', 'output', 'error'));
})->name('currency.view');

// Conversor decimal-binario
Route::match(['get', 'post'], '/binario', function (Request $request) {
    $mode = $request->input('mode', 'toBinary');
    $result = null;
    $error = null;
    if ($request->isMethod('post')) {
        if ($mode === 'toBinary') {
            $data = $request->validate(['decimal' => 'required|integer|min:0']);
            $result = decbin((int)$data['decimal']);
        } else {
            $data = $request->validate(['binary' => 'required|string']);
            if (!preg_match('/^[01]+$/', $data['binary'])) {
                $error = 'Ingrese un binario válido';
            } else {
                $result = bindec($data['binary']);
            }
        }
    }
    return view('binary', ['mode' => $mode, 'result' => $result, 'error' => $error]);
})->name('binary.view');

// Lista de tareas (sesión)
Route::match(['get', 'post'], '/tareas', function (Request $request) {
    $todos = $request->session()->get('todos', []);

    if ($request->isMethod('post')) {
        $action = $request->input('action', 'add');
        if ($action === 'add') {
            $data = $request->validate(['title' => 'required|string|max:100']);
            $todos[] = ['title' => $data['title'], 'done' => false];
        } elseif ($action === 'toggle') {
            $i = (int)$request->input('index');
            if (isset($todos[$i])) {
                $todos[$i]['done'] = !$todos[$i]['done'];
            }
        } elseif ($action === 'delete') {
            $i = (int)$request->input('index');
            if (isset($todos[$i])) {
                array_splice($todos, $i, 1);
            }
        } elseif ($action === 'clear') {
            $todos = [];
        }
        $request->session()->put('todos', $todos);
        return redirect()->route('todos.view');
    }

    return view('todos', compact('todos'));
})->name('todos.view');
