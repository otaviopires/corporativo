<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Ogs;


class PortalController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dados = $request->all();

        $validator = Validator::make($dados,[
            'resposta' => ['required','min:3','max:255'],
        ])->validate();

        $faq = faq::find($request->faq_id);
        $faq->resposta()->delete();
        $faq->resposta()->create([
            'resposta' => $request->resposta
        ]);

        return redirect()->route('faq.index')->with('success', 'Resposta enviada com sucesso.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $validator = Validator::make($dados,[
            'pergunta' => ['required','min:3','max:255'],
            'tag' => ['required'],
        ])->validate();

        $dados['user_id'] = Auth()->user()->id;
        
        $insert = faq::create($dados);
        
        $faq = faq::find($insert->id);
        
        foreach($dados['tag'] as $tag){
            $faq->tag()->create([
                'tag' => $tag
            ]);
        }

        if ($insert) {
            return redirect()->route('faq.index')->with('success', 'Pergunta enviada com sucesso.');
        } else {
            return redirect()->route('faq.index')->with('error', 'Erro ao enviar a pergunta!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $faq = faq::find($id);

        $delete = $faq->delete();

        if ($delete) {
            return redirect()->route('faq.index')->with('success', 'Pergunta apagada com sucesso.');
        } else {
            return redirect()->route('faq.index')->with('error', 'Erro ao apagar a pergunta!');
        }
    }

    public function responder(Request $request)
    {
        dd($request);
    }
}
