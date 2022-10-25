<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * User's Favorite places list page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
   {
       $favourites = auth()->user()->favorites;
       return view('pages.favourites')->with([
           'favourites' => $favourites
       ]);
   }

    /**
     * Store new favourite place
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
   {
       Auth::user()->favorites()->create($request->all());
       return redirect('/favourites');
   }
}
