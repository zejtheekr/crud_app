<?php

namespace App\Http\Controllers;

use App\Applicant;
use Illuminate\Http\Request;
use DB;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applicant ['applicants'] = Applicant::OrderBy('id','asc')->paginate(10);

        return view('applicant.index', $applicant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $applicant = array(
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'gender' => $request->gender,
          'position' => $request->position,
          'about' => $request->about
        );

        Applicant::create($applicant);

        return redirect()->route('applicant.index')->with('success', 'Applicant Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $applicant = array(
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'gender' => $request->gender,
        'position' => $request->position,
        'about' => $request->about
      );

      // echo "<pre>"; print_r($applicant); die;

      Applicant::findOrfail($request->applicant_id)->update($applicant);
      return redirect()->route('applicant.index')->with('success', 'Information Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $applicant)
    {
        $delete = $applicant->all();
        $delete_applicant= Applicant::findOrfail($applicant->applicant_id);
        $delete_applicant->delete();
        return redirect()->route('applicant.index')->with('success', 'Information Deleted Successfully');
    }

}
