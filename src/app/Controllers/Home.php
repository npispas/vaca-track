<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Models\Vacation;

class Home extends Controller
{
    public function index(): void
    {
        $user = Session::get('user');
        $data = [];

        if ($user->role->name === 'Manager') {
            $vacationModel = new Vacation();

            $data['total_employees'] = $user->totalEmployees();
            $data['pending_vacations'] = $vacationModel->totalPendingVacations();
        } else {
            $data['remaining_vacation_days'] = $user->remaining_vacation_days;
        }

        View::render('home/index', compact('data'));
    }
}
