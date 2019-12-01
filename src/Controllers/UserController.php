<?php


namespace Rentit\Controllers;


use Rentit\Controller;
use Rentit\Models\User;
use Rentit\Request;
use Rentit\Session;

class UserController extends Controller
{
    public function login(Request $request): string
    {
        $view = $this->view('user/login');

        if ($request->isPost()) {
            $user = new User();
            $username = $request->getParams()['username'];
            $password = $request->getParams()['pw1'];

            if ($user->login($username, $password)) {
                $userData = $user->findByUsername($username);
                Session::set('user_id', $userData['id']);
                Session::set('username', $username);
                header('Location: /');
                return '';
            } else {
                $view->assign('message', 'User or password invalid');
            }
        }

        return $view->show();
    }

    public function register(Request $request): string
    {
        $view = $this->view('user/register');

        if ($request->isPost()) {
            $username = $request->getParams()['username'];
            $password1 = $request->getParams()['pw1'];
            $password2 = $request->getParams()['pw2'];

            if ($password1 !== $password2) {
                $view->assign('message', 'Contraseñas no coinciden');
            } else {
                $user = new User();

                if ($user->register($username, $password1)) {
                    $view->assign('message', 'Registro completo');
                } else {
                    $view->assign('message', 'Usuario ya existente');
                }
            }
        }

        return $view->show();
    }

    public function logout(Request $request): string
    {
        Session::destroy();
        header('Location: /');

        return '';
    }
}