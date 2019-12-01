<?php


namespace Rentit\Controllers;


use Rentit\Controller;
use Rentit\Models\Rent;
use Rentit\Request;
use Rentit\Session;

final class RentController extends Controller
{
    public function delete(Request $request): string
    {
        $rent = new Rent();
        $rentId = $request->getParams()['id'];
        $userId = Session::get('user_id');
        $rentData = $rent->findById($rentId);

        if ($rentData === null || $rentData['user_id'] !== $userId) {
            header('Location: /');

            return '';
        }

        $rent->delete($rentId);
        header('Location: /');

        return '';
    }

    public function publish(Request $request): string
    {
        $view = $this->view('rent/publish');

        if ($request->isPost()) {
            $name = trim($request->getParams()['name']);
            $description = trim($request->getParams()['description']);
            $price = (float)trim($request->getParams()['price']);
            $user_id = Session::get('user_id');

            if ($name === '' || $description === '' || $price === '') {
                $view->assign('message', 'Hay datos incorrectos');
            } else {
                $rent = new Rent();

                $rent->publish($name, $description, $price, $user_id);
                header('Location: /');
                return '';
            }
        }

        return $view->show();
    }

    public function modify(Request $request): string
    {
        $view = $this->view('rent/modify');

        $rent = new Rent();
        $rentId = $request->getParams()['id'];
        $userId = Session::get('user_id');
        $rentData = $rent->findById($rentId);

        if ($rentData === null || $rentData['user_id'] !== $userId) {
            header('Location: /');

            return '';
        }

        if ($request->isPost()) {
            $name = trim($request->getParams()['name']);
            $description = trim($request->getParams()['description']);
            $price = (float)trim($request->getParams()['price']);

            if ($name === '' || $description === '' || $price === '') {
                $view->assign('message', 'Hay datos incorrectos');
            } else {
                $rent->modify($rentId, $name, $description, $price);
                header('Location: /');
                return '';
            }
        }

        return $view->assign('rent', $rentData)
            ->show();
    }
}