<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller
{
    /**
     * @return RedirectResponse|Response
     */
    public function index()
    {
        if (\Auth::check()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
