<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function destroy(Request $request)
    { 
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
