<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Extraction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;


class PlaylistController extends Controller
{
    public function play($filename)
    {
        $filePath = storage_path('app/public/uploads/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        $response = new StreamedResponse(function() use ($filePath) {
            $stream = fopen($filePath, 'rb');
            fpassthru($stream);
            fclose($stream);
        });

        $response->headers->set('Content-Type', 'audio/mpeg');
        $response->headers->set('Content-Disposition', 'inline; filename="' . $filename . '"');

        return $response;
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        // リレーションを使用してextractionsと関連するuploadsを取得
        $extractions = Extraction::with('upload')->orderBy('id')->get();

        return view('playlists.create', compact('extractions'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Playlist $playlist)
    {
        //
    }

    public function edit(Playlist $playlist)
    {
        //
    }

    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    public function destroy(Playlist $playlist)
    {
        //
    }
}







//--------------------------------------------
//S3からの音声ファイルのストリーミング
//--------------------------------------------
// namespace App\Http\Controllers;

// use App\Models\Upload;
// use App\Models\Extraction;

// use Illuminate\Http\Request;
// use Aws\S3\S3Client;
// use Symfony\Component\HttpFoundation\StreamedResponse;

// use Illuminate\Support\Facades\Gate;


// class PlaylistController extends Controller
// {
//     public function play($id)
//     {
//         // Extractionデータを取得
//         $extraction = Extraction::findOrFail($id);

//         // アクセス制御
//         if (!Gate::allows('view', $extraction)) {
//             abort(403, 'Unauthorized action.');
//         }
        
//         $upload = Upload::findOrFail($extraction->upload_id);

//         // S3クライアントの設定
//         $s3 = new S3Client([
//             'version' => 'latest',
//             'region' => config('filesystems.disks.s3.region'),
//             'credentials' => [
//                 'key' => config('filesystems.disks.s3.key'),
//                 'secret' => config('filesystems.disks.s3.secret'),
//             ],
//         ]);

//         // オブジェクトの取得
//         $bucket = config('filesystems.disks.s3.bucket');
//         $key = ltrim(urldecode(parse_url($upload->mp3_url, PHP_URL_PATH)), '/');
//         $s3Url = $s3->getObjectUrl($bucket, $key);


//         // FFmpegを使用して指定された範囲を抽出
//         $start_seconds = strtotime($extraction->start) - strtotime('TODAY');
//         $end_seconds = strtotime($extraction->end) - strtotime('TODAY');
//         $duration_seconds = $end_seconds - $start_seconds;


//  // ストリーミングレスポンスの作成
//         $response = new StreamedResponse(function() use ($s3Url, $start_seconds, $duration_seconds) {
//             $ffmpegCommand = "ffmpeg -ss $start_seconds -t $duration_seconds -i \"$s3Url\" -f mp3 -";
//             passthru($ffmpegCommand);
//         });



    
//         $response->headers->set('Content-Type', 'audio/mpeg');
//         $response->headers->set('Content-Disposition', 'inline; filename="extracted.mp3"');

//         return $response;
//     }

    


//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create(Request $request)
//     {
//         //すべてのExtractionを取得
//         $extractions = Extraction::orderBy('id')->get();
        
//         return view('playlists.create', compact('extractions'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Playlist $playlist)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Playlist $playlist)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Playlist $playlist)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Playlist $playlist)
//     {
//         //
//     }
// }
