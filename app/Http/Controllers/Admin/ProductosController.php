<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Marca;
use App\ImagenesProducto;
use Redirect;
use Carbon\Carbon;
use DB;
use App\Http\Requests\ProductoRequest;

class ProductosController extends Controller
{
    public function __construct()
    {
        $model = new Producto(); 
        $tabla = $model->getTable();
        $this->middleware('permisos:'.$tabla.',acceder')->only('index');
        $this->middleware('permisos:'.$tabla.',crear')->only('create','store');
        $this->middleware('permisos:'.$tabla.',actualizar')->only('edit','update');
        $this->middleware('permisos:'.$tabla.',eliminar')->only('destroy');

        if(!\Session::has('imagenesProducto'))
            \Session::put('imagenesProducto',array());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filtro = "")
    {
        $productos = Producto::paginate(15);
        
        return view('admin.productos.grid', compact('productos', 'filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::pluck('nombre', 'id');
        $marcas = Marca::pluck('nombre','id');

        return view('admin.productos.create', compact('producto', 'categorias','marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {

        try
        {
            DB::beginTransaction();
            
            $producto = new Producto();
            $producto->slug = str_slug($producto->nombre);
            $result = $producto->fill($request->all())->save();

            //Agregando la imágenes nuevas 
            if($result)
            {
                if(isset($request->imagenes))
                {
                    foreach($request->imagenes as $fileName)
                    {
                        $imagen = new ImagenesProducto();
                        $imagen->url = 'productos/'.$producto->id.'/'.$fileName;  //Creará una carpeta con el nombre del producto
                        $imagen->nombre_archivo = $fileName;  //Nombre del archivo de imágen
                        $imagen->producto_id = $producto->id;  
                        $imagen->default = ($request->imagen_predeterminada == $fileName ? 1 : 0);
                        $result = $imagen->save();
                        if(!$result)
                        {
                            throw new Exception('Error al intentar registrar las imágenes.');  
                        }
                    }
                }
            }            
            $arrFile = $request->files->all();
            if(array_key_exists('imagen',$arrFile))
            {
                foreach($arrFile['imagen'] as $file)
                {
                    $this->uploadFile($file, $producto->id);
                }
            }
            
            DB::commit();

            $mensaje =  "El producto ha sido actualizado";
            $tipo = "success";
            
        }catch(Exception $ex){
            DB::rollback();
            $mensaje = "Error al intentar actualizar el producto: ".$ex->getMessage(); 
            $tipo = "danger";
            $result = false;
        }
        
        return Redirect::to('/admin/productos')->with('message',$mensaje)->with('type-message',$tipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $producto->slug = str_slug($producto->nombre);
        $producto->precio = intval($producto->precio);
        $producto->precio_anterior = intval($producto->precio_anterior);
        $categorias = Categoria::pluck('nombre', 'id');
        $marcas = Marca::pluck('nombre','id');

        return view('admin.productos.edit', compact('producto','categorias','marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoRequest $request, $id)
    {

        try
        {
            DB::beginTransaction();
            $arrFile = $request->files->all();
            if(array_key_exists('imagen',$arrFile))
            {
                foreach($arrFile['imagen'] as $file)
                {
                    $this->uploadFile($file, $id);
                }
            }
            $producto = Producto::find($id);        
            $result = $producto->fill($request->all())->save();

            //Agregando la imágenes nuevas 
            if($result)
            {
                //Actualizando la imágen predeterminada                
                if(isset($request->imagenes_id))
                {
                    foreach($request->imagenes_id as $imagen_id)
                    {
                        $imagen = ImagenesProducto::find($imagen_id);
                        if($imagen != null)
                        {
                            $imagen->default = ($request->imagen_predeterminada == $imagen->nombre_archivo ? 1 : 0);
                            $result = $imagen->save();
                            if(!$result)
                            {
                                throw new Exception('Error al intentar actualizar las imágenes.');  
                            }
                        }
                        
                    }
                }


                //Agregando imágenes nuevas
                if(isset($request->imagenes))
                {
                    foreach($request->imagenes as $fileName)
                    {
                        $imagen = new ImagenesProducto();
                    
                        $imagen->url = 'productos/'.$id.'/'.$fileName;  //Creará una carpeta con el nombre del producto
                        $imagen->nombre_archivo = $fileName;  //Nombre del archivo de imágen
                        $imagen->producto_id = $id;  
                        $imagen->default = ($request->imagen_predeterminada == $fileName ? 1 : 0);
                        $result = $imagen->save();
                        if(!$result)
                        {
                            throw new Exception('Error al intentar registrar las imágenes.');  
                        }
                        
                    }
                }
            }

            //Eliminando imágenes
            if(isset($request->eliminadas))
            {
                foreach($request->eliminadas as $imagen_id)
                {
                    $imagen = ImagenesProducto::find($imagen_id);
                    $result = $imagen->delete();
                    if(!$result)
                    {
                        throw new Exception('Error al intentar eliminar imágenes.');  
                    }
                }
            } 
            DB::commit();

            $mensaje =  "El producto ha sido actualizado";
            $tipo = "success";
            
        }catch(Exception $ex){
            DB::rollback();
            $mensaje = "Error al intentar actualizar el producto: ".$ex->getMessage(); 
            $tipo = "danger";
            $result = false;
        }
        
        return Redirect::to('/admin/productos')->with('message',$mensaje)->with('type-message',$tipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $producto = Producto::find($id);
            $result = $producto->delete();
            $result = ImagenesProducto::where('producto_id','=',$id)->delete();
            
            if(!$result)
            {
                throw new Exception('Error al intentar eliminar el registro.');
            }
            //while($result)
            //{
            //    $result = false;
            //    $imagen = ImagenesProducto::where('producto_id','=',$id)->first()->get();
            //    if(!is_null($imagen))
            //    {
            //        $result = $imagen->delete();
            //    }
            //}
            DB::commit();

            $mensaje = "El producto ha sido eliminado.";
            $tipo = "success";

        }catch(Exception $ex){
            DB::rollback();
            $mensaje = "Error al intentar eliminar el registro: ".$ex->getMessage();
            $tipo = "danger";
        }

        return Redirect::to('/admin/productos')->with('message',$mensaje)->with('type-message',$tipo);
    }


    public function filtrar(Request $request)
    {
        $filtro = $request->filtro;
        if($filtro == "")
        {
            return Redirect::to('/admin/productos')->with('filtro');
        }
        $productos = Producto::where('nombre','Like','%'.$filtro.'%')
                            ->orWhere('descripcion','Like','%'.$filtro.'%')
                            ->paginate(15);

        return view('admin.productos.grid', compact('productos','filtro'));
    }


    private function uploadFile($path, $carpeta, $destino = 'local', $sobreescribir = true){
        $name = "";
        if(!empty($path)){
            $name = ($sobreescribir ? "" : Carbon::now()->second).$path->getClientOriginalName();
            //$this->attributes['afiche'] = $name;    //Asigna automáticamente el nombre al cargar los datos en el controlador, con la función fill($request->all())
            \Storage::disk($destino)->put($carpeta."/".$name, \File::get($path));            
        }
        return $name;   //En el caso de no cargar los datos con la función fill($request->all()), se debuelve el nombre generado para el archivo. 
    }
    
    /*
    private function validaDatos(Request $request)
    {
        $validator = $request->validate([
            
        ]);

        $messages = [
            
        ];
        dd($validator);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       }
    }
    */  
}
