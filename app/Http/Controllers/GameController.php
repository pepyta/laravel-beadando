<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scheduled = Game::query()
            ->where("finished", false)
            ->where("start", ">", now())
            ->with("home")
            ->with("away")
            ->with("events")
            ->orderByDesc("start")
            ->get();

        $finished = Game::query()
            ->where("finished", true)
            ->with("home")
            ->with("away")
            ->with("events")
            ->orderByDesc("start")
            ->paginate(15);

        $ongoing = Game::query()
            ->where("finished", false)
            ->where("start", "<=", now())
            ->with("home")
            ->with("away")
            ->with("events")
            ->orderByDesc("start")
            ->get();

        return view("games.index", [
            "scheduled" => $scheduled,
            "finished" => $finished,
            "ongoing" => $ongoing,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Game::class);
        $teams = Team::all();
        return view("games.create", [
            "teams" => $teams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", Game::class);
        $validated = $request->validate([
            "home_team_id" => "required|integer|exists:teams,id",
            "away_team_id" => "required|integer|exists:teams,id|different:home_team_id",
            "start" => "required|date|after:now",
        ], [
            "home_team_id.required" => "A hazai csapat megadása kötelező!",
            "home_team_id.interger" => "A hazai csapat azonosítójának egész számnak kell lennie!",
            "home_team_id.exists" => "Létező csapatot kell megadnod, mint hazai csapat!",
            "away_team_id.required" => "Az ellenfél csapat megadása kötelező!",
            "away_team_id.interger" => "A ellenfél csapat azonosítójának egész számnak kell lennie!",
            "away_team_id.exists" => "Létező csapatot kell megadnod, mint ellenfél csapat!", 
            "start.required" => "A kezdés időpontjának megadása kötelező!",
            "start.date" => "A kezdés időpontjának egy dátumnak kell lennie!",
            "start.after" => "A kezdés időpontjának egy jövőbeli dátumnak kell lennie!",
            "away_team_id.different" => "Az ellenfél csapat nem egyezhet meg a hazai csapattal!",
        ]);

        $validated["finished"] = false;
        $game = Game::create($validated);
        Session::flash("game-created");

        return to_route("games.show", [
            "game" => $game,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view("games.show", [
            "game" => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $this->authorize("update", $game);
        $teams = Team::all();
        return view("games.edit", [
            "game" => $game,
            "teams" => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $this->authorize("update", $game);

        $validated = $request->validate([
            "home_team_id" => "required|integer|exists:teams,id",
            "away_team_id" => "required|integer|exists:teams,id|different:home_team_id",
            "start" => "required|date",
        ], [
            "home_team_id.required" => "A hazai csapat megadása kötelező!",
            "home_team_id.interger" => "A hazai csapat azonosítójának egész számnak kell lennie!",
            "home_team_id.exists" => "Létező csapatot kell megadnod, mint hazai csapat!",
            "away_team_id.required" => "Az ellenfél csapat megadása kötelező!",
            "away_team_id.interger" => "A ellenfél csapat azonosítójának egész számnak kell lennie!",
            "away_team_id.exists" => "Létező csapatot kell megadnod, mint ellenfél csapat!", 
            "start.required" => "A kezdés időpontjának megadása kötelező!",
            "start.date" => "A kezdés időpontjának egy dátumnak kell lennie!",
            "start.after" => "A kezdés időpontjának egy jövőbeli dátumnak kell lennie!",
            "away_team_id.different" => "Az ellenfél csapat nem egyezhet meg a hazai csapattal!",
        ]);

        $validated["finished"] = isset($request->finished);
        $game->update($validated);
        Session::flash("game-updated");

        return to_route("games.show", [
            "game" => $game,
        ]);
    }

    public function finish(Request $request, Game $game) {
        $this->authorize("update", $game);
        $game->update(["finished" => true]);
        Session::flash("game-updated");
        return to_route("games.show", [
            "game" => $game,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $this->authorize("delete", $game);
        $game->delete();
        Session::flash("game-deleted");
        return to_route("games.index");
    }
}
