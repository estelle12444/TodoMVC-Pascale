<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Todo::get();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(['error' => 'Todo pas trouvé'], 404);
        }

        return response()->json($todo);
    }


}
