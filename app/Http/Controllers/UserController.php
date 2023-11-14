<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'success' => true
        ]);
    }

    public function switchCountry(Request $request)
    {
        $country = Country::find($request->id);

        $user = $request->user();

        if (!$user && $country) {
            return response()->json([
                'message' => 'user or country not exist',
                'success' => false
            ]);
        }

        $user->country_id = $country->id;
        $user->save();

        return response()->json([
            'message' => 'success',
            'success' => true
        ]);
    }
}
