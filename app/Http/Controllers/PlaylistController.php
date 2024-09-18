<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Extraction;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PlaylistController extends Controller
{
    public function play($id)
    {
        // Extractionデータを取得
        $extraction = Extraction::findOrFail($id);
        $upload = Upload::findOrFail($extraction->upload_id);

        // データの取得
        $start_seconds = strtotime($extraction->start) - strtotime('TODAY');
        $end_seconds = strtotime($extraction->end) - strtotime('TODAY');
        $duration_seconds = $end_seconds - $start_seconds;

 // サンプルレート、ビット深度、チャンネル数を設定
        $sample_rate = 44100;  // 例: 44.1kHz
        $bit_depth = 16;       // 例: 16ビット
        $channels = 2;         // 例: ステレオ

        // 秒数位置をバイト位置に変換
        $start_bytes = $this->seconds_to_bytes($start_seconds, $sample_rate, $bit_depth, $channels);
        $end_bytes = $this->seconds_to_bytes($end_seconds, $sample_rate, $bit_depth, $channels);


        // S3クライアントの設定
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        // オブジェクトの取得
        $bucket = config('filesystems.disks.s3.bucket');
        $key = ltrim(urldecode(parse_url($upload->mp3_url, PHP_URL_PATH)), '/');

//dd($upload->mp3_url); きちんと取得できている
//https://dance-battle1.s3.ap-northeast-3.amazonaws.com/01%20One%20More%20Time.mp3


 // オブジェクトのメタデータを取得してファイルサイズを確認
        $headObject = $s3->headObject([
            'Bucket' => $bucket,
            'Key' => $key,
        ]);
        $file_size = $headObject['ContentLength'];

        // リクエストする範囲がファイルサイズを超えないように調整
        if ($end_bytes >= $file_size) {
            $end_bytes = $file_size - 1;
        }

        
        // ストリーミングレスポンスの作成
 $response = new StreamedResponse(function() use ($s3, $bucket, $key, $start_bytes, $end_bytes) {
            $range = "bytes={$start_bytes}-{$end_bytes}";

            $result = $s3->getObject([
            'Bucket' => $bucket,
            'Key' => $key,
            'Range' => $range,

        ]);

         echo $result['Body'];
            ob_flush();
            flush();
    });

        $response->headers->set('Content-Type', 'audio/mpeg');
        $response->headers->set('Content-Disposition', 'inline; filename="extracted.mp3"');

        return $response;
    }

    private function seconds_to_bytes($seconds, $sample_rate, $bit_depth, $channels) {
        $bytes_per_sample = $bit_depth / 8;
        $bytes_per_second = $sample_rate * $bytes_per_sample * $channels;
        return intval($seconds * $bytes_per_second);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 例として、最初のExtractionを取得
    $extraction = Extraction::first();

    return view('playlists.create', compact('extraction'));
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
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
