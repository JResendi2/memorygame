<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Games;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    public function game()
    {
        $query = Card::all();

        $cards = array_fill(0, 64, null);
        $positionsWithNull = array_fill(0, 64, null);
        $positionsWithValue = [];

        $total = 0;
        $i = 0;

        while ($total < 25) {
            $randomCard = $query->random();
            $query = $query->reject(function ($card) use ($randomCard) {
                return $card->id === $randomCard->id; // Eliminar la card seleccionada
            });

            $randomPosition = array_rand($positionsWithNull); // Tomar un indice aleatorio
            unset($positionsWithNull[$randomPosition]);
            $positionsWithValue[] = $randomPosition;
            $cards[$randomPosition] = [
                'id' => $i,
                'num' => $total,
                'svg' => $randomCard->svg
            ];
            $i++;

            $randomPosition = array_rand($positionsWithNull); // Tomar un indice aleatorio
            unset($positionsWithNull[$randomPosition]);
            $positionsWithValue[] = $randomPosition;
            $cards[$randomPosition] = [
                'id' => $i,
                'num' => $total,
                'svg' => $randomCard->svg
            ];
            $i++;
            $total++;
        }

        while ($total < 32) {
            $randomPositionWithValue = array_rand($positionsWithValue); // Tomar un indice aleatorio para leer un carta que ya se almaceno

            $randomPosition = array_rand($positionsWithNull); // Tomar un indice aleatorio para almacenar la carta
            unset($positionsWithNull[$randomPosition]);
            $cards[$randomPosition] = [
                'id' => $i,
                'num' => $cards[$positionsWithValue[$randomPositionWithValue]]['num'],
                'svg' => $cards[$positionsWithValue[$randomPositionWithValue]]['svg']
            ];
            $i++;

             $randomPosition = array_rand($positionsWithNull); // Tomar un indice aleatorio para almacenar la pareja de la carta anterior
            unset($positionsWithNull[$randomPosition]);
            $cards[$randomPosition] = [
                'id' => $i,
                'num' => $cards[$positionsWithValue[$randomPositionWithValue]]['num'],
                'svg' => $cards[$positionsWithValue[$randomPositionWithValue]]['svg']
            ];

            $i++;
            $total++;
        }

        return view('game', compact('cards', 'total'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }

        $cards = Card::get();
        return view('admin.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }
        $request->validate([
            'name' => ['required', 'string'],
            'svg' => ['required', 'string']
        ]);

        $card = new Card();
        $card->name = $request->all()['name'];
        $card->svg = $request->all()['svg'];
        $card->save();

        return to_route('cards.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }
        return view('admin.edit', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, Card $card)
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }
        $request->validate([
            'name' => ['required', 'string'],
            'svg' => ['required', 'string']
        ]);

        $card->name = $request->all()['name'];
        $card->svg = $request->all()['svg'];
        $card->update();

        return to_route('cards.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        if (!Auth::check()) {
            return redirect()->route('cards.game'); 
        }
        $card->delete();
        return response()->json(['ok'], 200);
    }
}
