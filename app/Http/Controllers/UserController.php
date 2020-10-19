<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // check "with" parameter
        $relations = $request->query('with');
        $with_arr = [];
        foreach (explode(',', $relations) AS $with) {
            if ($with = trim($with)) {
                // check if relation exists
                if (!method_exists(User::class, $with)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Undefined relation [' . $with . ']'
                    ], 403);
                } else {
                    $with_arr[] = $with;
                }
            }
        }
        // get user data
        $users = User::with($with_arr)->get();
        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function view(Request $request, string $user)
    {
        return response()->json([
            'status' => true,
            'data' => User::where('id', $user)->first()
        ]);
    }
}
