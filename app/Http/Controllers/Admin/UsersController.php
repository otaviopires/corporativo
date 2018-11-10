<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use App\User;
use App\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $roles = Role::all();

        return view('admin.usuarios', compact('usuarios','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ['required','min:3','max:50'],
            'username' => ['required','min:3','max:50','unique:users'],
            'email' => ['required','email','unique:users'],
            'role' => ['required'],
        ])->validate();

        $dados['password'] = bcrypt($dados['password']);
        
        $insert = User::create($dados);
        
        $insert->roles()->sync([$dados['role']]);

        if ($insert) {
            return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso.');
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
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.editarUsuario', compact('user','roles'));
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
            'name' => ['required','min:3','max:50'],
            'username' => ['required','min:3','max:50', Rule::unique('users')->ignore($id)],
            'email' => ['required','email', Rule::unique('users')->ignore($id)],
            'role' => ['required'],
        ])->validate();

        $user = User::find($id);
        $update = $user->update($dados);
        $user->roles()->sync([$dados['role']]);

        if ($update) {
            return redirect()->route('usuarios.index')->with('success', 'Usuário editado com sucesso.');
        } else {
            return redirect()->route('usuarios.index')->with('error', 'Erro ao editar o usuário!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $delete = $user->delete();

        if ($delete) {
            return redirect()->route('usuarios.index')->with('success', 'Usuário apagado com sucesso.');
        } else {
            return redirect()->route('usuarios.index')->with('error', 'Erro ao apagar o usuário!');
        }
    }
}
