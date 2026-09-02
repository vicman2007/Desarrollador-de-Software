<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Home extends BaseController
{
    public function index()
    {
        return view('home/index', ['productos' => (new ProductoModel())->where('estado', 1)->findAll(6)]);
    }

    public function catalogo()
    {
        return view('home/catalogo', ['productos' => (new ProductoModel())->where('estado', 1)->findAll()]);
    }

    public function acerca() { return view('home/acerca'); }
    public function contacto() { return view('home/contacto'); }
    public function misionVision() { return view('home/mision_vision'); }
}
