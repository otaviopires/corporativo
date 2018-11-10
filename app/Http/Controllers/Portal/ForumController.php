<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Forum;
use App\Models\ForumTag;
use App\Models\ForumResposta;

class ForumController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $forums = forum::with('user')->paginate(10);

        return view('portal.forum', compact('forums'));
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
            'resposta' => ['required','min:3'],
        ])->validate();

        $forum = forum::find($request->forum_id);
        $forum->resposta()->delete();
        $forum->resposta()->create([
            'resposta' => $request->resposta
        ]);

        return redirect()->route('forum.index')->with('success', 'Resposta enviada com sucesso.');
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
        
        $insert = forum::create($dados);
        
        $forum = forum::find($insert->id);
        
        foreach($dados['tag'] as $tag){
            $forum->tag()->create([
                'tag' => $tag
            ]);
        }

        if ($insert) {
            return redirect()->route('forum.index')->with('success', 'Pergunta enviada com sucesso.');
        } else {
            return redirect()->route('forum.index')->with('error', 'Erro ao enviar a pergunta!');
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
        $dados = $request->all();

        $validator = Validator::make($dados,[
            'resposta' => ['required','min:3'],
        ])->validate();

        $forum = forum::find($request->forum_id);
        $forum->resposta()->delete();
        $forum->resposta()->create([
            'resposta' => $request->resposta
        ]);

        return redirect()->route('forum.index')->with('success', 'Resposta enviada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = forum::find($id);

        $delete = $forum->delete();

        if ($delete) {
            return redirect()->route('forum.index')->with('success', 'Pergunta apagada com sucesso.');
        } else {
            return redirect()->route('forum.index')->with('error', 'Erro ao apagar a pergunta!');
        }
    }

    public function responder(Request $request)
    {
        dd($request);
    }
}
