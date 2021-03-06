<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyThemeRequest;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use App\Models\Theme;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Themes', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'themes' => Theme::with(['comments' => function ($query) {
                $query->where('comment_id', '=', null)->with(['comments' => function ($query) {
                    $query->with('user')->orderBy('created_at', 'desc');
                }, 'user'])->orderBy('created_at', 'desc')->paginate(10);
            }])->orderBy('created_at', 'desc')->get()->map(function ($theme) {
                $theme->canControl = $theme->user_id == Auth::id();
                return $theme;
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreThemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThemeRequest $request)
    {
        User::find(Auth::id())->themes()->create($request->validated());
        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThemeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThemeRequest $request, $id)
    {
        $theme = Theme::find($id);
        $theme->content = $request->validated()['content'];
        $theme->save();
        return Redirect::route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::id() == Theme::find($id)->user->id) {
            Theme::destroy($id);
        }
        return Redirect::route('home');
    }
}
