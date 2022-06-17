<?php
namespace App\Http\Controllers;

class HolaController extends Controller{
    public function __invoke(string $name)
    {
        // TODO: Implement __invoke() method.
        return "Hola {$name}";
    }
}
