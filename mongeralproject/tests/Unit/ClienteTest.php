<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClienteTest extends TestCase
{
    protected static $email;
    
    public function setUp()
    {
        parent::setUp();
        $number = rand(1000,9999);
        self::$email = "email".$number."@teste.com.br";
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListarClientes()
    {
        $response = $this->get('/api/cliente');
        $response->assertStatus(200);
        
    }
    
    public function testCadastrarClientes()
    {
        $number = rand(1000,9999);
        $data = date('YmdHis');
        $datadb = date('Y-m-d');
        
        $response =  $this->json('POST', '/api/cliente', [
            'nome' => "Teste - " . $number, 
            'cpf'=>"1".$data, 
            'senha'=>$number,
            'telefone'=>$number, 
            'email'=>"1".self::$email,
            'datanascimento'=>$datadb, 
            'rg'=>$number, 
            'dataexpedicao'=>$datadb, 
            'orgao'=>"teste", 
            'estadocivil'=>"teste", 
            'categoria'=>"Teste", 
            'empresa'=>"teste", 
            'profissao'=>"Teste", 
            'rendabruta'=>$number, 
             'endereco' => [
                 'cep'=>$number, 
                 'logradouro'=>"Teste", 
                 'numero'=>$number, 
                 'complemento'=>"Teste complemento", 
                 'bairro'=>"Teste Bairro", 
                 'cidade'=>"Teste Cidade", 
                 'estado'=>"Teste Estado"
             ]
             ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'msg' => 'Cliente cadastrado com sucesso',
            ]);
        
    }
}
