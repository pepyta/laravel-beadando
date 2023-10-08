<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all()->sortBy("name");
        return view("teams.index", [
            "teams" => $teams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $this->authorize("create", Team::class);
       return view("teams.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create", Team::class);
        $validated = $request->validate([
            "name" => "required|string|min:3",
            "shortname" => "required|string|min:2|max:5",
            "image" => "image|nullable",
        ], [
            "name.required" => "A név megadása kötelező!",
            "name.string" => "A névnek szövegnek kell lennie!",
            "name.min" => "A névnek legalább 3 karakter hosszúnak kell lennie!",
            "shortname.required" => "A rövidítés megadása kötelező!",
            "shortname.string" => "A rövidítésnek szövegnek kell lennie!",
            "shortname.min" => "A rövidítésnek legalább két karakter hosszúnak kell lennie!",
            "shortname.max" => "A rövidítés legfeljebb öt karakter hosszú lehet!",
            "image.image" => "A logónak egy képnek kell lennie!",
        ]);

        if($request->hasFile("image")) {
            $file = $request->file("image");
            $filename = $file->hashName();
            Storage::disk("public")->put("images/".$filename, $file->get());
            $validated["image"] = $filename;
        }
        
        $team = Team::create($validated);
        Session::flash("team-created");
        return to_route("teams.show", [
            "team" => $team,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view("teams.show", [
            "team" => $team,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $this->authorize("update", $team);
        return view("teams.edit", [
            "team" => $team,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize("update", $team);

        $validated = $request->validate([
            "name" => "required|string|min:3",
            "shortname" => "required|string|min:2|max:5",
            "image" => "image|nullable",
        ], [
            "name.required" => "A név megadása kötelező!",
            "name.string" => "A névnek szövegnek kell lennie!",
            "name.min" => "A névnek legalább 3 karakter hosszúnak kell lennie!",
            "shortname.required" => "A rövidítés megadása kötelező!",
            "shortname.string" => "A rövidítésnek szövegnek kell lennie!",
            "shortname.min" => "A rövidítésnek legalább két karakter hosszúnak kell lennie!",
            "shortname.max" => "A rövidítés legfeljebb öt karakter hosszú lehet!",
            "image.image" => "A logónak egy képnek kell lennie!",
        ]);

        if($request->hasFile("image")) {
            $file = $request->file("image");
            $filename = $file->hashName();
            Storage::disk("public")->put("images/".$filename, $file->get());
            $validated["image"] = $filename;
        }
        
        $team->update($validated);
        Session::flash("team-updated");
        return to_route("teams.show", [
            "team" => $team,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
