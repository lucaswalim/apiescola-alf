<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('api/alunos', 'AlunoController@index'); // Listar alunos
$router->get('api/alunos/aprovados', 'AlunoController@aprovados');
$router->post('api/alunos', 'AlunoController@store'); // Salvar Aluno
$router->get('api/alunos/{id}', 'AlunoController@show'); // Listar aluno
$router->put('api/alunos/{id}', 'AlunoController@update'); // Atualizar Aluno
$router->get('api/alunos/{id}/notas', 'AlunoController@notas');


$router->get('api/provas', 'ProvaController@index');
$router->post('api/provas', 'ProvaController@store');
$router->get('api/provas/{id}', 'ProvaController@show');


$router->get('api/notas', 'NotaController@index');
$router->post('api/notas', 'NotaController@store');
$router->get('api/notas/{id}', "NotaController@nota");

