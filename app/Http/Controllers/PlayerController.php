<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function create(Team $team)
    {
        $this->authorize("create", Player::class);
        return view("players.create", [
            "team" => $team,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Team $team)
    {
        $this->authorize("create", Player::class);
        $validated = $request->validate([
            "name" => "required|string|min:3",
            "birthdate" => "required|date|before:-16years",
            "number" => "required|integer|min:1",
        ], [
            "name.required" => "A név megadása kötelező!",
            "name.string" => "A névnek szövegnek kell lennie!",
            "name.min" => "A névnek legalább 3 karakter hosszúnak kell lennie!",
            "birthdate.required" => "A születésnap megadása kötelező!",
            "birthdate.date" => "A születésnapnak dátumnak kell lennie!",
            "birthdate.before" => "A játékosnak legalább 16 évesnek kell lennie!",
            "number.required" => "A mezszám megadása kötelező!",
            "number.integer" => "A mezszámnak egy számnak kell lennie!",
            "number.min" => "A mezszámnak legalább egyesnek kell lennie!",
        ]);

        Player::create([
            "name" => $validated["name"],
            "birthdate" => $validated["birthdate"],
            "number" => $validated["number"],
            "team_id" => $team->id,
        ]);

        Session::flash("player-created");
        return to_route("teams.show", [
            "team" => $team,
        ]);
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
    public function destroy(Team $team, Player $player)
    {
        $this->authorize("delete", $player);
        $player->delete();
        Session::flash("player-deleted");
        return to_route("teams.show", [
            "team" => $player->team,
        ]);
    }
}
