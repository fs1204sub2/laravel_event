<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivewireTestController extends Controller
{
    public function index() {
        return view('livewire-test.index');
    }

    public function register()
    {
        return view('livewire-test.register');
    }
}
