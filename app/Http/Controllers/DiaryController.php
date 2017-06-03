<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{

    /**
     * DiaryController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=>['create', 'store', 'update', 'edit']]);
    }

    public function index()
    {
        $diaries = Diary::latest()->take(10)->get();
//        dd($diaries[0]->user->avatar);
        return view('diary.index', compact('diaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EditDiaryRequest $request)
    {
//        dd($request->except('_token'));
        $data = [
            'avatar' => '/images/avatar.png',
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $diary = Diary::create(array_merge($request->except('_token'), $data));
//        return redirect('/diaries/'.$request->id);
//        dd(array_merge($request->except('_token'), $data));
        return redirect()->action('DiaryController@show', ['id'=>$diary->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diary = Diary::findOrFail($id);
        return view('diary.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $diary = Diary::findOrFail($id);
        if(Auth::user()->id != $diary->created_by) {
            return redirect('/');
        }
        return view('diary.edit', compact('diary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EditDiaryRequest $request, $id)
    {
        $diary = Diary::findOrFail($id);
        $data = [
            'created_by' => $diary->created_by,
            'updated_by' => Auth::user()->id,
        ];
//        dd(array_merge($request->all(), $data));

        $diary->update(array_merge($request->all(), $data));
        return redirect()->action('DiaryController@show', ['id'=>$diary->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
