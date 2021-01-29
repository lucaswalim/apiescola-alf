<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    protected $table = 'provas';
    protected $fillable =['gabarito'];

    public $timestamps = false;



    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }




}
