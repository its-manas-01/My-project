<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    private $snakes = [
        16 => 6, 47 => 26, 49 => 11, 56 => 53,
        62 => 19, 64 => 60, 87 => 24, 93 => 73,
        95 => 75, 98 => 78
    ];

    private $ladders = [
        1 => 38, 4 => 14, 9 => 31, 21 => 42,
        28 => 84, 36 => 44, 51 => 67, 71 => 91,
        80 => 100
    ];

    public function index()
    {
        return view('welcome', [
            'started' => Session::has('positions'),
            'message' => Session::get('message'),
            'playerNames' => Session::get('player_names'),
            'positions' => Session::get('positions'),
            'currentPlayer' => Session::get('currentPlayer'),
        ]);
    }

    public function startGame(Request $request)
    {
        $request->validate([
            'player1' => 'required|string|max:20',
            'player2' => 'required|string|max:20',
        ]);

        Session::put('player_names', [$request->player1, $request->player2]);
        Session::put('positions', [0, 0]);
        Session::put('currentPlayer', 0);
        Session::put('message', "Game started! {$request->player1} vs {$request->player2}");

        return redirect()->route('game.index');
    }

    public function rollDice(Request $request)
    {
        if (!Session::has('positions')) {
            return response()->json(['error' => 'Game not started.']);
        }

        $positions = Session::get('positions');
        $currentPlayer = Session::get('currentPlayer');
        $playerNames = Session::get('player_names');

        $roll = rand(1, 6);
        $newPos = $positions[$currentPlayer] + $roll;
        $message = "{$playerNames[$currentPlayer]} rolled a $roll.";

        // Snakes and ladders logic here...
        // Update position, switch player, etc.

        Session::put('positions', $positions);
        Session::put('currentPlayer', 1 - $currentPlayer);
        Session::put('message', $message);

        return response()->json([
            'message' => $message,
            'positions' => $positions,
            'currentPlayer' => Session::get('currentPlayer')
        ]);
    }


    public function resetGame()
    {
        Session::flush();
        return redirect()->route('game.index');
    }
}
