<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Personne;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonneController;
use App\Models\Commande;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function findOneUser($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  User $user, Personne $personne)
    {
        User::find($user->id)->update([
            'email' => $request->email,
            'password' => $request->password,
            'dateOuverture' => $request->dateOuverture,
            'roleCompte' => $request->roleCompte,
            'personne_id' => Personne::latest()->first()->id,
        ]);
        Personne::find($personne->id)->update([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);
        

       
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       
    }


 

    public function register(Request $request)
    {
        // $personne = PersonneController->store($request);
        $personne = Personne::create([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);


        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dateOuverture' => $request->dateOuverture,
            'roleCompte' => $request->roleCompte,
            'personne_id' => Personne::latest()->first()->id,

        ]);

        // $user = User::update([
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'dateOuverture' => $request->dateOuverture,
        //     'roleCompte' => $request->roleCompte,
        //     'personne_id' => Personne::latest()->first()->id,
        // ])


        // $token = $user->createToken('MyApp')->accessToken;

        // return response()->json([
        //     'token' => $token,
        //     'user' => $user
        // ], 201);
    }



    public function login(Request $request)
    {
        $user = new User();
        $token = $user->createToken('MyApp')->accessToken;
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'dateOuverture' => $request->dateOuverture,
            'token'=>$token,
        ];

        if (auth()->attempt($data)) {
            $user = User::user();
            $token = $user->createToken('myToken')->accessToken;
            // $token = auth()->user()->createToken('MyApp')->accessToken;
            return response()->json(['token'=>$token], 200);
        }else{
            return response()->json(['error'=>'unauthorized'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['user'=>$user], 200);
    }
}
