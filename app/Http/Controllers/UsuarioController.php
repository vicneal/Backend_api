<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Rol;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login', 'register']]);
    }
    /**
     * Intenta autenticar al usuario y devuelve un token en caso de éxito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $user = Usuario::where('email', $credentials['email'])->first();
            $user->makeVisible('contrasena');
            // $credentials['password'] = bcrypt($request->password);
            //$token = auth()->attempt($credentials);
            //$token = JWTAuth::fromUser($user);

            // if (!$token = JWTAuth::attempt($credentials)) {
            //     return response()->json(['error' => 'Unauthorized'], 401);
            // }
            if (Hash::check($request->password, $user->contrasena)) {
                // Autenticación exitosa
                //return response()->json(['message' => JWTAuth::fromUser($user)]);
                $token = JWTAuth::fromUser($user);
                return response()->json([
                    'message' => 'Usuario registrado exitosamente!',
                    //'user' => $usuario,
                    'access_token' => $token
                ], 201);
            } else {
                // Credenciales incorrectas
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            // return $this->respondWithToken($token);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Devuelve la información del usuario autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Cierra la sesión del usuario (Invalida el token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Sesión cerrada exitosamente']);
    }

    /**
     * Refresca un token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    /**
     * Devuelve la estructura del array de token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:100|unique:usuarios',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $persona = Persona::create([
                'primernombre' => 'Nombre',
                'segundonombre' => 'Segundo Nombre',
                'primerapellido' => 'Apellido',
                'segundoapellido' => 'Segundo Apellido',
                'usuariocreacion' => 'usuario_creacion',
            ]);
            // Obtener el id de la persona recién creada
            $idPersona = $persona->id;

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $usuario = Usuario::create(array_merge(
                $validator->validate(),
                [
                    'email' => $request->input('email'),
                    'contrasena' => bcrypt($request->password),//Hash::make($request->password),//
                    'idpersona' => $idPersona,
                    'habilitado' => true,
                    'fecha' => Carbon::now(),
                    'idrol' => 1,
                ]
            ));
            $token = JWTAuth::fromUser($usuario);
            return response()->json([
                'message' => 'Usuario registrado exitosamente!',
                'user' => $usuario,
                'token' => $token
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(['error' => $e->errors()], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(['error' => 'No se encontró el modelo solicitado.'], 404);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Usuario::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }
    /**
     * getUser obtiene el email del usuario.
     */
    public function getUser(string $email)
    {
        $usuario = Usuario::where('email', $email)->first();
        if (!$usuario) {
            return response()->json([
                'error' => 'Usuario no encontrado',
            ], 404);
        }


        return response()->json([
            'contrasena' => $usuario->contrasena,
            'email' => $usuario->email,
        ]);
    }

    public function updateEstado(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        try {
            $request->validate([
                'estado' => 'required|boolean',
            ]);

            $usuario->habilitado = $request->input('estado');
            $usuario->touch();
            $usuario->save();

            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
