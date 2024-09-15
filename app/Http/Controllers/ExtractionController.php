<?php

namespace App\Http\Controllers;

use App\Models\Upload; // ここでUploadモデルをインポート
use App\Models\Extraction;
use Illuminate\Http\Request;



class ExtractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 抽出結果を表示するための処理
        return view('extractions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Upload $upload)
    {
        return view('extractions.create', compact('upload'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'start_time' => 'required|integer',
        'end_time' => 'required|integer',
        'upload_id' => 'required|exists:uploads,id',
    ]);

    // データベースに保存
    $extraction = new Extraction();
    $extraction->upload_id = $request->upload_id;
    $extraction->start = gmdate("H:i:s", $request->start_time); // 秒数を時:分:秒に変換
    $extraction->end = gmdate("H:i:s", $request->end_time); // 秒数を時:分:秒に変換
    $extraction->save();

    return response()->json(['message' => 'Extraction data saved successfully.']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Extraction $extraction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Extraction $extraction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Extraction $extraction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extraction $extraction)
    {
        //
    }
}
