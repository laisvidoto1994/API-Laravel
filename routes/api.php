<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Aqui é onde registra as rotas da API para o aplicativo. 
| Estas rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| é atribuído o grupo de middleware "api".
auth:api é o nome do arquivo
*/
 
Route::middleware('auth:api')->group(function()
{
    /** Rota 1
    * http://127.0.0.1:8000/api/user
    * get -> forma de identificar como quer realizar á comunicação(post,get,put)
    * '/user'-> 
    *  function -> direciona para o metodo o qual queria execultar algo
    */
    Route::get('/user', function (Request $request) 
    {
        return $request->user();
    });
 
    //post é para cadastro. e NÃO é passado via http. necessita de altenticação

    /** Rota 2
     * http://127.0.0.1:8000/api/user/1
     * get -> forma de identificar como quer realizar á comunicação(post,get,put)
     * 'user'-> 
     * /{id}-> parametro de busca por id
     *  UserController -> nome da classe controladora de metodos de requisição
     * @showUser-> nome do metodo o qual estou me referindo
     */
    Route::get('user/{id}', 'UserController@showUser');

    // rota de Cadastro dos dados no banco
    Route::post('/user/create', 'UserController@cadastroUser');

    // rota de Atualização dos dados do banco
    Route::post('/user/update', 'UserController@updateUser');

    // rota de Delete dos dados do banco
    Route::post('/user/delete', 'UserController@deleteUser');  

     // rota de Listagem dos dados do banco
     Route::post('/user/lista', 'UserController@listAllUser');  

});