<?php


namespace App\Http\Controllers;


use App\Models\Aluno;
use App\Models\Nota;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use function PHPUnit\Framework\isEmpty;


class AlunoController extends Controller
{

    public function index()
    {
        $alunos = Aluno::all();

        return response()->json($alunos,200);
    }

    public function store(Request $request)
    {
        if(!$request->isJson()) {
            return response()->json("Entrada de dados somente no formato JSON",406);
        }

        $nome = $request->nome;
        $numeroAlunos = count(Aluno::all());

        $nomeform = trim($nome);


        if (ctype_space($nomeform) || empty($nomeform)) {
            return  response()->json('Nome obrigatório');
        }


        if ($numeroAlunos >= 100) {
            return response()->json('Limite de Alunos atingido');
        } else {
            return response()->json(Aluno::create(['nome' => strtoupper($nome)]), 201);
        }

    }

    public function show($id)
    {
        $aluno = Aluno::find($id);

        return response()->json($aluno, 200);
    }

    public function aprovados()
    {
        $alunos = Aluno::query()->where('media', '>=', '7')->get();

        return response()->json($alunos);
    }

    public function update(Request $request)
    {
        if(!$request->isJson()) {
            return response()->json("Entrada de dados somente no formato JSON");
        }

        $aluno = Aluno::find($request->id);

        $aluno->nome = $request->nome;
        $aluno->save();

        return response()->json($aluno);
    }

    public function notas(Request $request)
    {
        $notas = Nota::query()->where('aluno_id', '=', $request->id)->get();

        return response()->json($notas);
    }


}
