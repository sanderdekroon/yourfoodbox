<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::latest()->get();
        return view('bestellen.city-select', compact('cities'));
    }

    public function setCity($name, Request $request)
    {
        $city_id = City::where('name', $name)->firstOrFail();
        $request->session()->put('selectedCity', $city_id);

        return redirect('bestelling');
    }
}
