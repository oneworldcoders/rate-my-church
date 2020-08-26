<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Church;
use App\Question;
use App\Address;
use App\Religion;
use App\Survey;
use App\Rating;
use App\ChurchQuestion;
use Illuminate\Http\Request;
use App\Http\Requests\ChurchRequest;

class ChurchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->authorize('viewAny', Church::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Church::class);
        $user = auth()->user();
        if ($request->search){
          $religions = Religion::where('name', 'ilike', '%'.$request->search.'%')->get();
        }
        else if ($user->is_admin){
          $religions = Religion::all();
        } else {
          $religions = Religion::where('id', $user->religion->id)->get();
        }

        $religions->load('churches');

        return view('admin.church.index', compact('religions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Church::class);
        $religions = Religion::all();
        return view('admin.church.create', compact('religions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChurchRequest $request)
    {
        $church = Church::create($request->all());
        $church->address()->create($request->get('address'));
        return redirect()->route('churches.index')
                         ->with('success', __('messages.add_success', ['item' => 'church']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Church  $church
     * @return \Illuminate\Http\Response
     */
    public function show(Church $church)
    {
      $survey = Survey::all()->last();
      $church_questions = ChurchQuestion::where(['church_id' => $church->id, 'survey_id' => $survey->id])->get();

      return view('admin.church.show', compact('church', 'church_questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Church  $church
     * @return \Illuminate\Http\Response
     */
    public function edit(Church $church)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Church  $church
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Church $church)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Church  $church
     * @return \Illuminate\Http\Response
     */
    public function destroy(Church $church)
    {
        //
    }
}
