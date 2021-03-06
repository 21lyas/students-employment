<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;
use Session;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employers = Employer::all();
        return view('employers.index',compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'org_name' => 'required',
            'position' => 'required',
            'title' => 'required',
            'requirements' => 'required',
            'category' => 'required',
            'min_salary' => 'required'
        ]);

        $employer = new Employer([
            'org_name' => $request->get('org_name'),
            'position' => $request->get('position'),
            'title' => $request->get('title'),
            'requirements' => $request->get('requirements'),
            'category' => $request->get('category'),
            'min_salary' => $request->get('min_salary')

        ]);
        $employer->save();
        return redirect('/employers')->with('success', 'Employer Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $empid = Session::get('user_id');

        $employer = Employer::where('user_id', $empid)->first();
        //dd($empid);
        return view('employers.show', compact('employer'));
    }
/**
    function showById($id) {
        $employer = Employer::find($id);
        return view('employers.show', compact('employer'));
    }
*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employer = Employer::find($id);
        return view('employers.edit', compact('employer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'org_name'=>'required',
            'position'=>'required',
            'title'=>'required',
            'requirements'=>'required',
            'category'=>'required',
            'min_salary'=>'required',
            'max_salary'=>'required'
        ]);

        $employer = Employer::find($id);
        $employer->org_name =  $request->get('org_name');
        $employer->position = $request->get('position');
        $employer->title = $request->get('title');
        $employer->requirements = $request->get('requirements');
        $employer->category = $request->get('category');
        $employer->min_salary = $request->get('min_salary');
        $employer->max_salary = $request->get('max_salary');
        $employer->save();

        return redirect('/employers')->with('success', 'Employer updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employer = Employer::find($id);
        $employer->delete();

        return redirect('/employers')->with('success', 'Employer deleted!');
    }
}
