<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
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
    public function create(Request $request, Game $game)
    {
        $this->authorize("create", [Event::class, $game]);
        $players = collect()
            ->merge($game->away->players)
            ->merge($game->home->players)
            ->sortBy("number")
            ->sortBy("team.name");

        return view("events.create", [
            "game" => $game,
            "players" => $players,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Game $game)
    {
        $this->authorize("create", [Event::class, $game]);
        $validated = $request->validate([
            "type" => "required|in:GOAL,SELF_GOAL,YELLOW_CARD,RED_CARD",
            "minute" => "required|integer|min:1|max:90",
            "player_id" => "required|integer|exists:players,id",
        ], [
            "type.required" => "Az esemény típusának megadása kötelező!",
            "type.in" => "Az esemény csak gól, öngól, sárga lap vagy piros lap lehet!",
            "minute" => "A perc megadása kötelező!",
            "minute.min" => "Az eseménynek legalább az első percben kell történnie!",
            "minute.max" => "A percnek maximum 90-nek kell lennie!",
            "player_id.required" => "A játékos megadása kötelező!",
            "player_id.integer" => "A játékos azonosítónak egy számnak kell lennie!",
            "player_id.exists" => "Valódi játékost adj meg!"
        ]);

        $player = Player::find($validated["player_id"]);
        $validated["game_id"] = $game->id;
        $validated["team_id"] = $player->team->id;

        Event::create($validated);
        Session::flash("event-created");
        
        return to_route("games.show", [
            "game" => $game,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game, Event $event)
    {
        $this->authorize("delete", [$event]);
        $event->delete();

        Session::flash("event-deleted");

        return to_route("games.show", [
            "game" => $event->game,
        ]);
    }
}
