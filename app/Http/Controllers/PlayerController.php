<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $player = Player::where('mail', '=', $request->input('email'))->first();

        if ($player) {
            $player->name = $request->input('name');
            $player->save(); // Usa save() para actualizar
        } else {
            $player = new Player();
            $player->name = $request->input('name');
            $player->mail = $request->input('email');
            $player->save();
        }

        $game = new Games();
        $game->start_time = $request->input('start-time');
        $game->end_time = $request->input('end-time');
        $game->player()->associate($player); 
        $game->save();

        return response()->json(['response', 'OK'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
