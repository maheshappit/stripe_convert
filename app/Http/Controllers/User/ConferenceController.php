<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\ConferencesData;
use App\Models\User;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function add()
    {
        $all_conferences = ConferencesData::all();

        return view('user.conference.add',compact('all_conferences'));
    }


    public function index()
    {
        $conferences = ConferencesData::all();
        $countries = Conference::distinct()->pluck('country',)->toArray();
        $users = User::all();
        return view('user.conference.index',compact('conferences','countries','users'));
    }


    public function showUpload(){

        $all_conferences = ConferencesData::all();

        return view('user.conference.upload',compact('all_conferences'));
       }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
