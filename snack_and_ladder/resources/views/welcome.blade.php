<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snakes and Ladders</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <h1>Snakes and Ladders</h1>

    @if (!session('positions'))
        {{-- Show name input form --}}
        <form method="POST" action="{{ route('game.start') }}">
            @csrf
            <label for="player1">Player 1 Name:</label>
            <input type="text" name="player1" id="player1" required><br>
            <label for="player2">Player 2 Name:</label>
            <input type="text" name="player2" id="player2" required><br>
            <button type="submit">Start Game</button>
        </form>
    @else
        {{-- Show game board --}}
        <p id="message">{{ session('message') }}</p>
        <button onclick="rollDice()">
            <i class="fas fa-dice"></i> Roll Dice for {{ session('player_names')[session('currentPlayer')] }}
        </button>
        <form method="POST" action="{{ route('game.reset') }}" style="display: inline;">
            @csrf
            <button type="submit">Reset Game</button>
        </form>

        <table>
            @php $number = 100; @endphp
            @for ($row = 0; $row < 10; $row++)
                <tr>
                    @for ($col = 0; $col < 10; $col++)
                        @php
                            $cell = $row % 2 == 0 ? ($number - $col) : ($number - (9 - $col));
                            $cellContent = $cell;

                            $snakes = [16 => 6, 47 => 26, 49 => 11, 56 => 53, 62 => 19, 64 => 60, 87 => 24, 93 => 73, 95 => 75, 98 => 78];
                            $ladders = [1 => 38, 4 => 14, 9 => 31, 21 => 42, 28 => 84, 36 => 44, 51 => 67, 71 => 91, 80 => 100];

                            if (array_key_exists($cell, $snakes)) {
                                $cellContent .= "<br><i class='fas fa-skull-crossbones' style='color: red;' title='Snake!'></i>";
                            } elseif (array_key_exists($cell, $ladders)) {
                                $cellContent .= "<br><i class='fas fa-arrow-up' style='color: green;' title='Ladder!'></i>";
                            }

                            if (session()->has('positions') && in_array($cell, session('positions'))) {
                                $index = array_search($cell, session('positions'));
                                $cellContent .= "<br><span class='player'><i class='fas fa-user'></i> " . e(session('player_names')[$index]) . "</span>";
                            }
                        @endphp
                        <td>{!! $cellContent !!}</td>
                    @endfor
                    @php $number -= 10; @endphp
                </tr>
            @endfor

        </table>
    @endif

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
