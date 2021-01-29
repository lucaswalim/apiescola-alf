<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';

    protected $fillable = ['aluno_id'];
    protected $appends = ['links'];

    public $timestamps = false;

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function prova()
    {
        return $this->belongsTo(Prova::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'prova'=> '/api/provas/'. $this->prova_id,
            'aluno' => '/api/alunos/'. $this->aluno_id
        ];
    }
}
