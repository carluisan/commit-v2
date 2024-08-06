<?php
use App\Controllers\ContactosController;
app()->get('/', function () {
    response()->json(['message' => 'Congratulaciones!! Usted ha accedido al aplicativo de Leaf API']);
});
//consulta todos los registros (verbo GET)
app()->get('/contactos','ContactosController@index');
//consulta un registro específico de acuerdo al id (verbo GET)
app()->get('/contactos/{id}','ContactosController@consultar');
//agrega un registro específico de acuerdo a los parametros del request (verbo POST)
app()->post('/contactos','ContactosController@agregar');
//borra un registro específico (verbo DELETE)
app()->delete('/contactos/{id}','ContactosController@borrar');
//actualiza un registro específico (verbo PUT)
app()->put('/contactos/{id}','ContactosController@actualizar');
app()->get("/app",function(){
    //app() returns $app
    response()->json(app()->routes());
});
//app()->get('/verificar/{id}', 'ContactosController@verificar');
app()->get('/verificar/{id}/{contraseña}', 'ContactosController@verificar');

