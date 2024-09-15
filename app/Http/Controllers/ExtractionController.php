<?php

namespace App\Http\Controllers;

use App\Models\Upload; // ここでUploadモデルをインポート
use App\Models\Extraction;
use Illuminate\Http\Request;

use FFMpeg;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
//         $request->validate([
//             'start_time' => 'required|integer',
//             'end_time' => 'required|integer',
//             'upload_id' => 'required|exists:uploads,id',
//         ]);

//          $upload = Upload::find($request->upload_id);
//         $start_time = $request->start_time;
//         $end_time = $request->end_time;
//         $duration = $end_time - $start_time;

// 絶対パスから相対パスを抽出
//         $absolute_url = $upload->mp3_url;
//         $parsed_url = parse_url($absolute_url);
//         $relative_path = ltrim($parsed_url['path'], '/');

// //dd($relative_path); "01%20One%20More%20Time.mp3"

// // S3のプリサインドURLを取得
//         $s3 = Storage::disk('s3');
//         $s3_url = $s3->temporaryUrl($relative_path, now()->addMinutes(5));

        
// dd($s3_url);


//         // 一時ファイルのパスを生成
//         $local_path = storage_path('app/temp/' . basename($relative_path));

// // S3から一時ファイルにダウンロード
//  $file_contents = @file_get_contents($s3_url);
//         if ($file_contents === false) {
//             return response()->json(['error' => 'Failed to download file from S3: ' . $s3_url], 404);
//         }

//         Storage::disk('local')->put('temp/' . basename($relative_path), $file_contents);

//         if (!file_exists($local_path)) {
//             return response()->json(['error' => 'File not found: ' . $local_path], 404);
//         }


        

        


//         $response = new StreamedResponse(function() use ($local_path, $start_time, $duration) {
//             $process = FFMpeg::fromDisk('local')
//                 ->open('temp/' . basename($local_path))
//                 ->export()
//                 ->toDisk('local')
//                 ->inFormat(new \FFMpeg\Format\Audio\Mp3)
//                 ->addFilter(['-ss', $start_time, '-t', $duration])
//                 ->getProcess();

//             $process->run(function ($type, $buffer) {
//                 echo $buffer;
//                 ob_flush();
//                 flush();
//             });

// // 処理後に一時ファイルを削除
//             unlink($local_path);

//         });

//         $response->headers->set('Content-Type', 'audio/mpeg');
//         $response->headers->set('Content-Disposition', 'inline; filename="extracted.mp3"');

//         return $response;
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
