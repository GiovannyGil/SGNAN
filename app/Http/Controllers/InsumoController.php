<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsumoCreateRequest;
use App\Http\Requests\InsumoEditRequest;
use App\Models\Categoria;
use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:insumo.index')->only('index');
    }

    public function index()
    {
        //
        $insumos = Insumo::all();
        
        return view('insumo.index')->with('insumos', $insumos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $insumos = Insumo::all();
        $categorias = Categoria::where('status','ACTIVE')->get();
       
        return view('insumo.create', compact('categorias'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsumoCreateRequest $request)
    {
        //
        // $request->validate([
        //     'Nombre_Insumo' => 'require',
        //     'Precio' => 'require',
        //     'cantidad' => 'require',
        // ]);
        // $insumos = Insumo::create($request->only(keys: 'Nombre_Insumo','Precio','cantidad')
        // +[


        // ]);

        $insumos = new Insumo();

        $insumos->Nombre_insumo = $request->get('Nombre_Insumo');
        $insumos->Precio = $request->get('Precio');
        $insumos->cantidad = $request->get('cantidad');
        $insumos->id_categorias = $request->get('id_categorias');
        
        
       
        

        $insumos->save();

        return redirect('/insumos')->with('crear', 'Insumo registrado exitosamente');
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
        // $insumo = Insumo::findOrFail($id);
        // return view('insumo.show', compact('insumo'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::all();
        $insumo = Insumo::find($id);
        return view('insumo.edit', compact('categorias'))->with('insumo', $insumo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsumoEditRequest $request, $id)
    {
        //
        $insumo = Insumo::find($id);

        $insumo->Nombre_insumo = $request->get('Nombre_Insumo');
        $insumo->Precio = $request->get('Precio');
        $insumo->cantidad = $request->get('cantidad');
        $insumo->id_categorias = $request->get('id_categorias');

        
        

        $insumo->save();

        return redirect('/insumos')->with('editar', 'Insumo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        //h
        $insumo =  Insumo::find($id);

        $insumo->delete();
        return redirect('/insumos')->with('Eliminar', 'Insumo eliminado exitosamente');;
    }
    public function change_status( Insumo $insumo)
    {
        if ($insumo->status == 'ACTIVE') {
            $insumo->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } 
        else {
            $insumo->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }

    }
}