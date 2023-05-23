<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoCreateRequest;
use App\Http\Requests\EmpleadoEditRequest;
use App\Models\Empleado;
use App\Models\Tipoempleado;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:empleados.index')->only('index');
    }

    public function index()//Leer todos los registros
    {
        $empleados = Empleado::all();
        return view('empleados.index')->with('empleados', $empleados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//Para abrir el formulario para un nuevo registro
    {
        $empleados = Empleado::all();
        $tipoempleados = Tipoempleado::all();
        return view('empleados.create', compact('tipoempleados'));
    }

    
    public function store(EmpleadoCreateRequest $request)//Para guardar en la BD un nuevo registro
    {
        $empleados = new Empleado();
        $empleados->Nombre = $request->get('Nombre');
        $empleados->Apellidos = $request->get('Apellidos');
        $empleados->Email = $request->get('Email');
        $empleados->Documento = $request->get('Documento');
        $empleados->Genero = $request->get('Genero');
        $empleados->Fecha_Nacimiento = $request->get('Fecha_Nacimiento');
        $empleados->Celular = $request->get('Celular');
        $empleados->Observaciones = $request->get('Observaciones');
        $empleados->id_tipoempleados = $request->get('id_tipoempleados');
        // $empleados->Imagen = $request->get('Imagen');

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $ImagenEmpleado = date('ymdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $ImagenEmpleado);
            $empleados['imagen'] = "$ImagenEmpleado";
        }

        $empleados->save();
        return redirect('/empleados')->with('Crear', 'Empleado registrado exitosamente');
    }

    public function show($id)//Para visualizar un solo registro a detalle
    {
        $tipoempleados = Tipoempleado::all();
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado', 'tipoempleados'));
        
    }


    public function edit($id)//Para abrir un formulario de edicion de un solo registro
    {
        $tipoempleados = Tipoempleado::all();
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('tipoempleados'))->with('empleado', $empleado);
        //
    }


    public function update(EmpleadoEditRequest $request, $id)//Para actualizar la informacion de un registro en la BD
    {
        $empleado = Empleado::findOrFail($id);
        
        $empleado->Nombre = $request->get('Nombre');
        $empleado->Apellidos = $request->get('Apellidos');
        $empleado->Email = $request->get('Email');
        $empleado->Documento = $request->get('Documento');
        $empleado->Genero = $request->get('Genero');
        $empleado->Fecha_Nacimiento = $request->get('Fecha_Nacimiento');
        $empleado->Celular = $request->get('Celular');
        $empleado->Observaciones = $request->get('Observaciones');
        $empleado->id_tipoempleados = $request->get('id_tipoempleados');

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $ImagenEmpleado = date('ymdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $ImagenEmpleado);
            $empleado['imagen'] = "$ImagenEmpleado";
        }
        else{
            unset($empleado['imagen']);
        }

        $empleado->save();

        return redirect('/empleados')->with('Editar', 'Empleado actualizado correctamente');
    }

    public function destroy($id)//Para eliminar un registro
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        return redirect('/empleados')->with('Eliminar', 'Empleado eliminado correctamente');
    }

    public function change_status(Empleado $empleado)
    {
        if ($empleado->status == 'ACTIVE') {
            $empleado->update(['status' => 'DEACTIVATED']);
            return redirect()->back();
        } 
        else {
            $empleado->update(['status' => 'ACTIVE']);
            return redirect()->back();
        } 
    }
}
