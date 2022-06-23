<?php

namespace App\Http\Controllers;

class HolaController extends Controller
{
    public function index(string $name): string
    {
        return "Hola {$name}";
    }
}
