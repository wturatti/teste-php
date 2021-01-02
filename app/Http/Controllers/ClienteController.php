<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = Cliente::find(0);
        return view('form', ["cliente" => $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'dataNascimento' => 'required',
            'sexo' => 'required'
        ]);

        $data_nascimento = $request->get('dataNascimento');
        $dt = Carbon::createFromFormat('d/m/Y', $data_nascimento);

        if ($request->id > 0) {
            $cliente = Cliente::find($request->id);
            $cliente->nome = strtoupper($request->get('nome'));
            $cliente->data_nascimento = $dt->year . "-" . $dt->month . "-" . $dt->day;
            $cliente->sexo = $request->get('sexo');
            $cliente->cep = $request->get('cep');
            $cliente->endereco = strtoupper($request->get('endereco'));
            $cliente->numero = $request->get('numero');
            $cliente->complemento = strtoupper($request->get('complemento'));
            $cliente->bairro = strtoupper($request->get('bairro'));
            $cliente->estado = strtoupper($request->get('estado'));
            $cliente->cidade = strtoupper($request->get('cidade'));
            
            $cliente->save();
        } else {
            $cliente = new Cliente([
                'nome' => strtoupper($request->get('nome')),
                'data_nascimento' => $dt->year . "-" . $dt->month . "-" . $dt->day,
                'sexo' => $request->get('sexo'),
                'cep' => $request->get('cep'),
                'endereco' => strtoupper($request->get('endereco')),
                'numero' => $request->get('numero'),
                'complemento' => strtoupper($request->get('complemento')),
                'bairro' => strtoupper($request->get('bairro')),
                'estado' => strtoupper($request->get('estado')),
                'cidade' => strtoupper($request->get('cidade')),
            ]);
            
            $cliente->save();
        }

        return redirect('/')->with('success', 'Cadastro efetuado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        $data_nascimento = explode("-", $cliente->data_nascimento);
        $cliente->data_nascimento = $data_nascimento[2] . $data_nascimento[1] . $data_nascimento[0];
        
        return view('form', ["cliente" => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
