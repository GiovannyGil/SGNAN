<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProveedorCreateRequest;
use App\Http\Requests\ProveedorEditRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:proveedor.index')->only('index');
    }

    public function index()
    {
        //
        $proveedores = Proveedor::all();
        return view('proveedor.index')->with('proveedores', $proveedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proveedor.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorCreateRequest $request)
    {
        //
       
        $proveedores = new Proveedor();

        $proveedores->Nombre = $request->get('Nombre');
        $proveedores->asesor = $request->get('asesor');
        $proveedores->Correo = $request->get('Correo');
        $proveedores->Direccion = $request->get('Direccion');
        $proveedores->Telefono = $request->get('Telefono');
        
        

        $proveedores->save();

        return redirect('/proveedores')->with('crear', 'Proveedor registrado exitosamente');;
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
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor.show', compact('proveedor'));
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
        $proveedor = Proveedor::find($id);
        return view('proveedor.edit')->with('proveedor',$proveedor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorEditRequest $request, $id)
    {
        //
        $proveedor = Proveedor::find($id);
        
        $proveedor->Nombre = $request->get('Nombre');
        $proveedor->asesor = $request->get('asesor');
        $proveedor->Correo = $request->get('Correo');
        $proveedor->Direccion = $request->get('Direccion');
        $proveedor->Telefono = $request->get('Telefono');
        
        

        $proveedor->save();

        return redirect('/proveedores')->with('editar', 'Proveedor actualizado correctamente');;

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
        $proveedor =  Proveedor::find($id);

        $proveedor->delete();
        return redirect('/proveedores') ->with('Eliminar', 'Proveedor eliminado correctamente');;
    }
    public function change_status( Proveedor $proveedor)
    {
        if ($proveedor->status == 'ACTIVE') {
            $proveedor->update(['status' => 'DEACTIVATED']);
            return redirect()->back(); 
        } 
        else {
            $proveedor->update(['status' => 'ACTIVE']);
            return redirect()->back();
        }

    }
}