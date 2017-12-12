<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listar(){
        $data = array();
        
        try{
                
            $cliente = \App\Cliente::with('endereco')->get();
            
            return response()->json($cliente, 200);
        } catch (Exception $ex) {
            $data['msg'] = 'Cliente não encontrado';
            return response()->json($data, 500);
        }
        
    }
    
    public function novo(Request $request){
        $data = array();
        
        try{
            $cli = \App\Cliente::whereEmail($request->input("email", ""))->first();
            if($cli == null){
                
                $cliente = new \App\Cliente($request->all());
                //$cliente->nome = $request->input("nome");
                $cliente->empresa = $request->input("empresa", "");
                $end = $request->input("endereco");
                $endereco = new \App\Endereco($end);
                $endereco->complemento = ($end["complemento"] == null)?"":$end["complemento"];
                \DB::beginTransaction();
                    
                    $cliente->save();
                    $endereco->cliente()->associate($cliente);
                    $endereco->save();
                    
                \DB::commit();
                
                $email = $cliente->email;
                \Mail::send('email', array('nome' => $cliente->nome),
                        function($message) use($request, $email){
                            $message->from("cotiinformatica1@gmail.com");
                            $message->to("marques.coti@gmail.com");
                            $message->subject("Cadastro teste Mongeral");
                        });
                
                $data['msg'] = 'Cliente cadastrado com sucesso';
                return response()->json($data, 200);
                
            }else{
                $data['msg'] = 'E-mail já cadastrado';
                return response()->json($data, 200);
            }
        } catch (\Exception $ex) {
            $data['msg'] = 'Cliente não cadastrado - ' . $ex->getMessage();
            return response()->json($data, 200);
        }
        
    }
}
