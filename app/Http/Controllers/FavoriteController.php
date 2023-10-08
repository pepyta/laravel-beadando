<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", Favorite::class);
        $favorites = Favorite::query()
            ->where("favorites.user_id", "=", Auth::user()->id)
            ->get("team_id");
        
        $games = Game::query()
            ->whereIn("home_team_id", $favorites)
            ->orWhereIn("away_team_id", $favorites)
            ->orderBy("start", "desc")
            ->get();

        return view("favorites.index", [
            "games" => $games,
        ]);
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
        $this->authorize("create", Favorite::class);

        $validated = $request->validate([
            "team_id" => "required|integer|exists:teams,id",
        ], [
            "team_id.required" => "A csapat azonosítójának megadása kötelező!",
            "team_id.integer" => "A csapat azonosítójának számnak kell lennie!",
            "team_id.exists" => "Létező csapatot adj meg!", 
        ]);

        Favorite::create([
            "team_id" => $validated["team_id"],
            "user_id" => Auth::user()->id,
        ]);

        Session::flash("favorite-created");
        return to_route("favorites.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team, Favorite $favorite)
    {
        $this->authorize("delete", $favorite);
        $favorite->delete();
        Session::flash("favorite-deleted");
        return to_route("favorites.index");
    }
}
