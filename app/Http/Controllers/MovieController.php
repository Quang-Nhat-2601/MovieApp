<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class MovieController extends Controller
{
    //

    public function create(Request $request)
    {
        $user = JWTAuth::toUser($request->bearerToken());

        $validator = Validator::make($request->all(), [
            'adult' => 'required|boolean',
            'title' => 'required|string',
            'tagline' => 'required|string',
            'overview' => 'required|string',
            'status' => 'required|string',
            'poster_path' => 'required|string',
            'language' => 'required|string',
            'popularity' => 'required|double',
            'vote_average' => 'required|numeric',
            'vote_count' => 'required|integer',
            'revenue' => 'required|integer',
            'comment' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Create Movie Failed',
                'error' => $validator->errors()->toArray(),
            ]);
        }

        $movie = Movie::query()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $movie,
        ]);
    }

    public function update(Request $request, Movie $movie)
    {

        $user = JWTAuth::toUser($request->bearerToken());

        $movie = Movie::findOrFail($movie);
        $validator = Validator::make($request->all(), [
            'adult' => 'boolean',
            'title' => 'string',
            'tagline' => 'string',
            'overview' => 'string',
            'status' => 'string',
            'poster_path' => 'string',
            'language' => 'string',
            'popularity' => 'double',
            'vote_average' => 'numeric',
            'vote_count' => 'integer',
            'revenue' => 'integer',
            'comment' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data is not correct!',
            ]);
        }

        $movie->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $movie,
        ]);
    }

    public function destroy(Request $request, Movie $movie)
    {
        $movie->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function show(Request $request, Movie $movie)
    {
        return response()->json([
            'data' => $movie,
            'success' => true,
        ]);
    }

    public function showAll(Request $request)
    {
        return response()->json([
            'data' => Movie::all(),
            'success' => true,
        ]);
    }
}
