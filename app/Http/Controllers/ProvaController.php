<?php


namespace App\Http\Controllers;


use App\Models\Prova;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use SebastianBergmann\CodeCoverage\Report\PHP;
use function PHPUnit\Framework\isNull;


class ProvaController extends Controller
{
    public function index()
    {
        return response()->json(Prova::all(), 200);
    }

    public function store(Request $request)
    {
        if(!$request->isJson()) {
            return response()->json("Entrada de dados somente no formato JSON",406);
        }

        $gabaritoCompleto = ($request->gabarito);

       $respostas = '';

       // Recebemos um array json e tranformamos em string com alternativa e peso => A,1,B,2...
        // Posição par sera sempre string e ímpar sera os pesos
        foreach($gabaritoCompleto as  $gabarito){
            foreach ($gabarito as $itens) {
                $respostas .= $itens . ",";
            }
        }

        // Removendo ultima virgula para dar explode
        $respostas = (substr($respostas, 0, -1));

        $stringnumber = explode(",", $respostas);

        $arrayPeso = [];

        // Posição par do array sera sempre alternativa, e Impar os pesos
        // Verificamos cada peso se é negativou ou = 0
        for ($i = 1; $i <= count($stringnumber); $i = $i + 2) {

            if (!is_numeric($stringnumber[$i])){
                return response()->json('String recebida em peso da nota');
            }


            if ($stringnumber[$i] <= 0) {
                return response()->json('Peso com valor negativo ou zerado',406);
            }

           array_push($arrayPeso, intval($stringnumber[$i]));

        }

        if (array_sum($arrayPeso) > 10){
            return response()->json('A somatória dos pesos deve ser numeros inteiros e positivos');
        }

        $prova = new Prova();
        $prova->gabarito = strtoupper($respostas);
        $prova->save();

        return response()->json($prova, 201);

    }

    public function show($id)
    {
        return response()->json(Prova::find($id));
    }

}
