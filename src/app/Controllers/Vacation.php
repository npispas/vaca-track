<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\Vacation as VacationModel;

class Vacation extends Controller
{
    public function index(): void
    {
        $vacations = VacationModel::with('user')->get();

        View::render('vacations/index', compact('vacations'));
    }

    public function create(): void
    {
        View::render('vacations/create');
    }

    public function store(): void
    {
        $errors = Request::validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'reason' => ['required', 'max' => 255],
        ]);

        if ($errors) {
            Response::redirect('/vacations/create')->with('errors', $errors)->send();
        }

        $data = Request::all();
        $data['user_id'] = Auth::user()->id;

        $vacation = new VacationModel();
        $vacation->fill($data);

        if (Auth::user()->remaining_vacation_days < $vacation->duration) {
            Response::redirect('/vacations/create')->with('errors', ['vacation' => ['You do not have enough vacation time!']])->send();
        }

        $vacation->save();

        Response::redirect('/vacations')->with('success', 'Vacation created successfully!')->send();
    }

    public function delete(int $id): void
    {
        $vacation = VacationModel::find($id);

        if ($vacation->status !== 'pending') {
            Response::redirect('/vacations')->with('error', 'You cannot delete this vacation!')->send();
        }

        $vacation->delete();

        Response::redirect('/vacations')->with('success', 'Vacation deleted successfully!')->send();
    }

    public function approve(int $id): void
    {
        $vacation = VacationModel::find($id);

        if (Auth::user()->remaining_vacation_days < $vacation->duration) {
            Response::redirect('/vacations')->with('error', 'User does not have enough vacation time!')->send();
        }

        $vacation->approve();

        Response::redirect('/vacations')->with('success', 'Vacation approved successfully!')->send();
    }

    public function reject(int $id): void
    {
        $vacation = VacationModel::find($id);
        $vacation->reject();

        Response::redirect('/vacations')->with('success', 'Vacation rejected successfully!')->send();
    }
}
