<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = ['id', 'nome', 'cpf', 'senha', 'telefone', 'email', 'datanascimento',
        'rg', 'dataexpedicao', 'orgao', 'estadocivil', 'categoria', 'empresa',
        'profissao', 'rendabruta'];
    public $timestamps = false;
    
    public function endereco()
    {
        return $this->hasOne('App\Endereco', 'clientes_id');
    }
}
