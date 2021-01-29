<?php


namespace App\Http\Controllers;


use App\Models\Aluno;
use App\Models\Nota;
use App\Models\Prova;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use function PHPUnit\Framework\isJson;


class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::all();

        return response()->json($notas);
    }

    public function store(Request $request)
    {
        if(!$request->isJson()) {
            return response()->json("Entrada de dados somente no formato JSON",406);
        }

        $gabaritoAluno = $request->gabarito_aluno;
        $gabaritoAlunoString = implode(",", $gabaritoAluno);


        $alunoId = $request->aluno_id;
        $provaId = $request->prova_id;

        $classeNota = Nota::query()->where('aluno_id', '=', $alunoId)->get();


        for ($i = 0; $i < count($classeNota); $i++) {
            if ($classeNota[$i]->prova_id == $provaId && $classeNota[$i]->aluno_id == $alunoId) {
                return response()->json('Registro existente no banco de dados',412);
            }
        }

        $nota = new Nota();
        $nota->aluno_id = $alunoId;
        $nota->prova_id = $provaId;
        $nota->gabarito_aluno = strtoupper($gabaritoAlunoString);


        $this->corrigirProva($gabaritoAlunoString, $provaId, $nota, $alunoId);

        //return response()->json($nota,405);

    }


    public function corrigirProva($gabaritoAlunoString, $provaId, $nota, $alunoId)
    {
        $prova = Prova::find($provaId);

        $gabaritoProva = explode(",", $prova->gabarito);


        $gabaritoAluno = explode(",", strtoupper($gabaritoAlunoString));

        $pontuacao = 0;


        // Criando Array so de Peso, podendo iterar
        $arrayPeso = [];
        for ($i = 1; $i <= count($gabaritoProva); $i = $i + 2) {
            array_push($arrayPeso, $gabaritoProva[$i]);
        }

        // Criando Array so de Alternativas, podendo iterar
        $arrayGabarito = [];
        for ($i = 0; $i < count($gabaritoProva); $i = $i + 2) {
            array_push($arrayGabarito, $gabaritoProva[$i]);
        }

        for ($i = 0; $i < count($arrayGabarito); $i = $i + 1) {

            if ($arrayGabarito[$i] == $gabaritoAluno[$i]){
                $pontuacao = $pontuacao + (1 * $arrayPeso[$i]);
            } else {
                $pontuacao = $pontuacao + (0 * $arrayPeso[$i]);
            }
        }

        //echo $pontuacao . PHP_EOL;
        $notaPonderada = (($pontuacao * count($arrayPeso)) / count($arrayPeso));


        if ($notaPonderada > 10) {
            return response()->json('', 405);
        }

        if ($notaPonderada == 0){
            $notaPonderada = 1;
        }

        $nota->nota = $notaPonderada;
        $nota->save();

        $this->media($alunoId, $nota);


        return response()->json($nota, 201);

    }


    public function media($alunoId, $nota)
    {
        $notas = Nota::where('aluno_id', $alunoId)->get();

        $aluno = Aluno::find($alunoId);

        $provas = Prova::all();


        $calculoMedia = 0;
        $media = 0;

        for ($i = 0; $i < count($notas); $i++) {
            $calculoMedia += $notas[$i]->nota;
        }

        $media = ($calculoMedia/count($provas));
        $aluno->media = $media;
        $aluno->save();

        return response()->json('',201);
    }

    public function nota($id)
    {
       // Buscamos determinada nota pelo id da nota

        $notas = Nota::query()->where('id', '=', $id)->get();

        return response()->json($notas);
    }

}
