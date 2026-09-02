<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login() { return view('auth/login'); }
    public function registro() { return view('auth/registro'); }

    public function procesarLogin()
    {
        $rules = ['correo' => 'required|valid_email', 'contrasena' => 'required|min_length[6]'];
        if (! $this->validate($rules)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $usuario = (new UsuarioModel())->porCorreo($this->request->getPost('correo'));
        if (! $usuario || ! password_verify((string) $this->request->getPost('contrasena'), $usuario['contrasena'])) {
            return redirect()->back()->withInput()->with('error', 'Correo o contraseña incorrectos.');
        }
        session()->regenerate(true);
        session()->set(['logueado' => true, 'idUsuario' => $usuario['idUsuario'], 'idRol' => $usuario['idRol'], 'nombre' => $usuario['nombre'], 'correo' => $usuario['correo']]);
        return redirect()->to('/dashboard')->with('success', 'Bienvenido, ' . $usuario['nombre'] . '.');
    }

    public function procesarRegistro()
    {
        $rules = ['nombre' => 'required|min_length[2]|max_length[80]', 'apellido' => 'required|max_length[80]', 'correo' => 'required|valid_email|is_unique[usuario.correo]', 'contrasena' => 'required|min_length[6]', 'confirmar' => 'required|matches[contrasena]'];
        if (! $this->validate($rules)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        (new UsuarioModel())->insert(['nombre' => trim($this->request->getPost('nombre')), 'apellido' => trim($this->request->getPost('apellido')), 'correo' => strtolower(trim($this->request->getPost('correo'))), 'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT), 'idRol' => 1, 'estado' => 1]);
        return redirect()->to('/login')->with('success', 'Cuenta creada correctamente.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada.');
    }
}
