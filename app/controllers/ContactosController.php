<?php 
namespace App\Controllers;
use App\Models\Contactos;
use Leaf\Http\Request;
use Leaf\Http\Response;
use Leaf\Controller;
class ContactosController extends Controller{
    //Este método es para acceder a todos los registros de la tabla de contactos
    public function index(){
       $datosContactos= Contactos::all();
       response()->json($datosContactos);
       //response()->json(['message' => 'Aqui vamos a entrar al modelo contactos']);    
    }
    //Este método es para acceder a un registro de la tabla de contactos a partir del id
    public function consultar($id){
        $datosContactos= Contactos::find($id);
        response()->json($datosContactos);
        //response()->json(['message' => 'Aqui vamos a entrar al modelo contactos']);    
     }
      //Este método es para agragar un registro de la tabla de contactos a partir de parámetros de entrada
     public function agregar(){
        $contacto= new Contactos;
        //echo app()->request()->get('nombre');
        $contacto->id=app()->request()->get('id');
        $contacto->nombre=app()->request()->get('nombre');
        $contacto->primerapellido=app()->request()->get('primerapellido');
        $contacto->segundoapellido=app()->request()->get('segundoapellido');
        $contacto->correo=app()->request()->get('correo');
        $contacto->contraseña=app()->request()->get('contraseña');
        $contacto->save();
        response()->json(['message'=>'Registro agregado']);
      }
      public function borrar($id){
         Contactos::destroy($id);
         response()->json(['message'=>'Registro borrado',$id]);
      
      }
      public function actualizar($id){
        $nombre=app()->request()->get('nombre');
        $primerapellido=app()->request()->get('primerapellido');
        $segundoapellido=app()->request()->get('segundoapellido');
        $correo=app()->request()->get('correo');
        $contraseña=app()->request()->get('contraseña');
        $contacto=Contactos::findOrFail($id);
        $contacto->nombre=($nombre!="")?$nombre:$contacto->nombre;
        $contacto->primerapellido=($primerapellido!="")?$primerapellido:$contacto->primerapellido;
        $contacto->segundoapellido=($segundoapellido!="")?$segundoapellido:$contacto->segundoapellido;
        $contacto->correo=($correo!="")?$correo:$contacto->correo;
        $contacto->contraseña=($contraseña!="")?$contraseña:$contacto->contraseña;
        $contacto->update();
         response()->json(['message'=>'Registro actualizado',$id]); 
      }
      public function verificar($id, $contraseñaIngresada){
        // Buscar el registro con el ID proporcionado
        $datosContactos = Contactos::find($id);
    
        if ($datosContactos) {
            // Comparar la contraseña proporcionada con la almacenada en texto plano
            if ($contraseñaIngresada === $datosContactos->contraseña) {
                // Si la contraseña es correcta, devolver una respuesta JSON con el mensaje y los datos
                return response()->json(['message' => 'Registro Encontrado y Contraseña Correcta', 'data' => $datosContactos]);
            } else {
                // Si la contraseña no es correcta, devolver una respuesta JSON con un mensaje de error
                return response()->json(['message' => 'Contraseña Incorrecta'], 404);
            }
        } else {
            // Si no se encuentra el registro, devolver una respuesta JSON con un mensaje de error
            return response()->json(['message' => 'Registro No Encontrado'], 404);
        }
    }
}