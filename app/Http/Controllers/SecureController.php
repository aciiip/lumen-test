<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecureController extends Controller
{
	public function profile(Request $request)
	{
        return response()->json([
            'status' => true,
            'data' => Auth::user()
        ]);
	}
}
