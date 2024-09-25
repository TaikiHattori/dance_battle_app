<?php

namespace App\Http\Controllers;

use App\Models\Extraction;
use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memos = Memo::with('extraction')->get();
        return view('memos.index', compact('memos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Extraction $extraction)
    {
        return view('memos.create', compact('extraction'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Extraction $extraction)
    {
        $request->validate([
      'memo' => 'required|max:255',
    ]);


// データベースに保存
        $memo = new Memo();
        $memo->extraction_id = $extraction->id; // Extraction IDを設定
        dump($extraction->id); 
        //nullになっててデータ取得できてなかったが
        //Route::post('/memos/{extraction}', と
        //create.bladeの<form method="POST" action="{{ route('memos.store', ['extraction' => $extraction->id]) }}">
        //で解決

        $memo->text = $request->input('memo'); // メモのテキストを設定
        $memo->save();

    return redirect()->route('memos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Memo $memo)
    {
        return view('memos.show', compact('memo'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memo $memo)
    {
        return view('memos.edit', compact('memo'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extraction $extraction)
    {
        $request->validate([
      'memo' => 'required|max:255',
    ]);

    // データベースに保存
        $memo = new Memo();
        $memo->extraction_id = $extraction->id;
        dd($extraction->id); 
        $memo->text = $request->input('memo');
        $memo->save();

    return redirect()->route('memos.show', $memo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();

    return redirect()->route('memos.index');
    }
}
