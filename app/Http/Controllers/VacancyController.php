<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Vacancy;
use Illuminate\Http\Request;
use Session;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Session::get('user_id');
        $vacancies = Employer::where('user_id', $user_id)->first()->vacancies;
        return view('vacancies.index',compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employer = Employer::where('user_id', Session::get('user_id'))->first();
        return view('vacancies.create', compact('employer'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $emp_id = Employer::where('user_id', Session::get('user_id'))->first()->id;

        $request->validate([
            'title' => 'required',
            'position' => 'required',
            'responsibilities' => 'required',
            'requirements' => 'required',
            'terms' => 'required',
            'min_salary' => 'required',
            'max_salary' => 'required',
            'skills' => 'required'
        ]);

        $vacancy = new Vacancy([
            'title' => $request->get('title'),
            'position' => $request->get('position'),
            'responsibilities' => $request->get('responsibilities'),
            'requirements' => $request->get('requirements'),
            'terms' => $request->get('terms'),
            'min_salary' => $request->get('min_salary'),
            'max_salary' => $request->get('max_salary'),
            'skills' => $request->get('skills'),
            'employer_id' => $emp_id


        ]);
        $vacancy->save();
        return redirect('/vacancies/all')->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function showAll(Vacancy $vacancy)
    {
        //
        $vacancies = $vacancy::all();
        //dd($empid);
        return view('vacancies.showAll', compact('vacancies'));
    }

    public function show($id) {
        $vacancy = Vacancy::where('id', $id)->first();
        return view('vacancies.show', compact('vacancy'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
