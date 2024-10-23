<?php

namespace App\Http\Controllers;

use App\Events\TodoCreated;
use App\Events\TodoDeleted;
use App\Events\TodoUpdated;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoCommandController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->user_id = auth()->id();
        $todo->save();

         // Création de la todo
        event(new TodoCreated($todo));

        return response()->json($todo);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['error' => 'Pas autorisé'], 403);
        }

        $todo->update($request->all());

        // Mettre à jour la todo
        event(new TodoUpdated($todo));

        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== auth()->id()) {
            return response()->json(['error' => 'Pas autorisé'], 403);
        }

        $todo->delete();

        // Supprimer la Todo
        event(new TodoDeleted($todo));

        return response()->json(['message' => 'Todo supprimé avec succès']);
    }
}
