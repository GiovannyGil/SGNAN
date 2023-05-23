<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriasCreateRequest;
use App\Http\Requests\CategoriasEditRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categoria.index')->only('index');
    }

    public function index()
    {
        //
        $categorias = Categoria::all();
        return view('categoria.index')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        
        return view('categoria.create');
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasCreateRequest $request)
    {
        //
        $categorias = new Categoria();

        $categorias->Nombre = $request->get('Nombre');
        
        

        $categorias->save();

        return redirect('/categorias')->with('crear', 'Categoria registrada exitosamente');
        
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
        $categoria = Categoria::findOrFail($id);
        return view('compra.show', compact('categoria'));
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
        $categoria = Categoria::find($id);
        return view('categoria.edit')->with('categoria',$categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriasEditRequest $request, $id)
    {
        //
        $categoria = Categoria::find($id);

        $categoria->Nombre = $request->get('Nombre');
        $categoria->save();

        return redirect('/categorias')->with('editar', 'Categoria actualizada correctamente');
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
        $categoria =  Categoria::find($id);

        $categoria->delete();
        return redirect('/categorias')->with('Eliminar', 'Categoria eliminada correctamente');
    }
    public function change_status( Categoria $categoria)
    {
        if ($categoria->status == 'ACTIVE') {
            $categoria->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } 
        else {
            $categoria->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }

    }

}