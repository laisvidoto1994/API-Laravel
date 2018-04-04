<?php namespace App\Http\Controllers; 
// namespace App\Http\Controllers-> rota onde está salva os controladores

use App\User; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller 
{  

  public function showUser($id)
  { 
    // retorne um json do usuario com os dados do id informado, senão mostre erro por não achar-lo
    return User::findOrFail($id); 
  } 


  public function cadastroUser(Request $request)
  {
    //mostra para o desenvolvedor como está sendo feita, e todos os registros do request.
    \Log::debug($request->all());

    $data = [
              "name"     => $request->get('name'),//passando o parametro da request para name
              "email"    => $request->get('email'),
              "password" => bcrypt($request->get('password'))//bcrypt mostra senha criptografia
            ];

    try
    {
      $user = User::create($data); //criando usuario no banco de dados

      if( empty($user) ) //se vazio
      {
        throw new \Exception('usuario vazio, não cadastrado');
      }
      return response()->json(['error' => false, 'message' => 'usuario criado com sucesso!'], 200); 
    }
    catch (\Exception $e)
    {
      // retorna um erro que foi passado no throw
      return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
    }
  }


  public function updateUser(Request $request)
  {
    //o que será/o que pode ser atualizado
    $data = 
    [
      "name"     => $request->get('name'),//passando o parametro da request para name
      "email"    => $request->get('email'),
      "password" => bcrypt($request->get('password'))
    ];

    try
    {
      $user = User::where('id', $request->get('id') )->update($data);
    
      \Log::debug($user);

      if( !$user )
      {
        throw new \Exception('usuario vazio, não atualizado');
      }
      return response()->json(['error' => false,'message' => 'usuario atualizado com sucesso!'], 200);
    }
    catch (\Exception $e)
    {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
    }
  }
  
  
  public function deleteUser(Request $request)
  {

    $data = 
    [
      "name"     => $request->get('name'),//passando o parametro da request para name
      "email"    => $request->get('email'),
      "password" => bcrypt($request->get('password'))
    ];

    try
    {
      $user = User::where('id', $request->get('id') )->delete();

      if( !$user )
      {
        throw new \Exception('usuario inesistente, informe outro usuario!');
      }
      return response()->json(['error' => false,'message' => 'usuario excluido com sucesso!'], 200);
    }
    catch (\Exception $e)
    {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
    }
  }

  public function listAllUser(Request $request)
  {
    try
    {
      
      $user = User::all();
     //$user = User::all('name');

      if( !$user )
      {
        throw new \Exception('não há usuarios!');
      }
      return $user;
      //return response()->json(['error' => false,'message' => 'Listagem de usuarios!'], 200);
      
    }
    catch (\Exception $e)
    {
      return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
    }


  }


} 
