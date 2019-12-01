<?php


namespace Rentit\Controllers;


use Rentit\Controller;
use Rentit\Models\Rent;
use Rentit\Request;
use Rentit\Session;

final class DefaultController extends Controller
{
    public function index(Request $request): string
    {
        $rent = new Rent();
        $rents = $rent->rents();

        return $this->view('index')
            ->assign('rents', $rents)
            ->show();
    }
}