<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Storage;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/demo', function () use ($router) {
    return response()->json(['name' => 'Abigail', 'state' => 'CA']);
});

$router->get('/pokemon', function () use ($router) {
    
    $vals = explode("\n", Storage::disk('local')->get('pokemon.csv'));

    $pokemons = [];
    $num = 0;
    foreach($vals as $data) {

        $data = explode(",", $data);

        if (count($data) == 1){
            continue;
        }

        if ($data[1] == "Name"){
            continue;
        }

        /*
            0: "No."
            1: "Name"
            2: "Type 1"
            3: "Type 2"
            4: "Total"
            5: "HP"
            6: "Attack"
            7: "Defense"
            8: "Sp. Atk"
            9: "Sp. Def"
            10: "Speed"
            11: "Generation"
            12: "Legendary"
        */
        $pokemon = [
            "No." => $num,
            "Name" => $data[1],
            "Type 1" => $data[2],
            "Type 2" => $data[3],
            "Total" => $data[4],
            "HP" => $data[5],
            "Attack" => $data[6],
            "Defense" => $data[7],
            "Special Atk" => $data[8],
            "Special Def" => $data[9],
            "Speed" => $data[10],
            "Generation" => $data[11],
            "Legendary" => $data[12]
        ];

        array_push($pokemons, $pokemon);
        $num++;
    }

    return response()->json($pokemons);
});

$router->get('/check-beanstalk', function () use ($router) {
    return response()->json(['name' => 'Elastic Beanstalk', 'region' => 'us-east-1']);
});