<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CalculatorController extends BaseController
{
    public function calculate(Request $request)
    {
        echo "inicio proceso";
        $data = $request->validate([
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'op' => 'required|string|in:sum,sub,mul,div',
        ]);

        $a = (float) $data['a'];
        $b = (float) $data['b'];
        $op = $data['op'];

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
                    return response()->json(['message' => 'División por cero no permitida'], 422);
                }
                $result = $a / $b;
                break;
            default:
                return response()->json(['message' => 'Operación no soportada'], 400);
        }

        return response()->json(['result' => $result]);
    }
}
