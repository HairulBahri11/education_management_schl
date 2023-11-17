<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class programController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $token = Auth::user()->token;
        dd($token);
        $header = ['Authorization' => 'Bearer ' . $token];
    }


    public function index()
    {

        $token = Auth::user()->token;
        dd($token);

        return view('program');

        // $data = Http::withHeaders($header)->get('http://127.0.0.1:8000/api/program');

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
