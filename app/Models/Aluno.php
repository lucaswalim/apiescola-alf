<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $fillable = ['nome'];
    protected $appends = ['links'];
    public $timestamps = false;

    public function provas()
    {
        return $this->hasMany(Prova::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function gabaritos()
    {
        return $this->hasMany(Gabarito::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'notas'=> '/api/alunos/'. $this->id . '/notas'
        ];
    }

}
