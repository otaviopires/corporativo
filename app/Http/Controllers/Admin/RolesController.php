<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use App\Role;
use App\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.roles', compact('roles','permissions'));
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
            'name' => ['required','min:3','max:50','unique:roles'],
            'label' => ['required','min:3','max:50'],
        ])->validate();

        $insert = Role::create($dados);
        if (isset($dados['permission']))
            $insert->permissions()->sync($dados['permission']);

        if ($insert) {
            return redirect()->route('roles.index')->with('success', 'Nível de acesso cadastrado com sucesso.');
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
        $roles = Role::find($id);
        $permissions = Permission::all();
        $permissao = [];
        
        foreach ($roles->permissions as $value) {
            $permissao[] = $value->name;
        }

        return view('admin.editarRole',compact('roles','permissions','permissao'));
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
            'name' => ['required','min:3','max:50', Rule::unique('roles')->ignore($id)],
            'label' => ['required','min:3','max:50'],
        ])->validate();

        $roles = Role::find($id);
        $update = $roles->update($dados);

        if (isset($dados['permission'])){
            $roles->permissions()->sync($dados['permission']);
        }else{
            $roles->permissions()->sync([]);
        }

        if ($update) {
            return redirect()->route('roles.index')->with('success', 'Nível de acesso editado com sucesso.');
        } else {
            return redirect()->route('roles.index')->with('error', 'Erro ao editar o nível de acesso!');
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
        $role = Role::find($id);

        $delete = $role->delete();

        if ($delete) {
            return redirect()->route('roles.index')->with('success', 'Nível de acesso apagado com sucesso.');
        } else {
            return redirect()->route('roles.index')->with('error', 'Erro ao apagar o nível de acesso!');
        }
    }
}
