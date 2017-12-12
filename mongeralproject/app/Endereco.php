<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = "enderecos";
    public $timestamps = false;
    protected $fillable = ['cep','logradouro', 'numero', 'complemento', 'bairro','cidade',
        'estado', 'clientes_id'];
    
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }
}
