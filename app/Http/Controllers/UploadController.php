<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;

// 🔽 追加
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    // 現在のユーザーのアップロードのみを取得
        $uploads = Auth::user()->uploads;
    return view('uploads.index', compact('uploads'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      // 🔽 追加
    Gate::authorize('create', Upload::class);
        // 🔽 追加
    return view('uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 🔽 追加
    Gate::authorize('create', Upload::class);
        
        $request->validate([
            'file' => 'required|mimes:mp3',
            
        ]);


        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // S3にアップロード
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        $bucket = env('AWS_BUCKET');
        $key =  $fileName;

        // dd($key);  ファイル名取得できている

        try {
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => $key,
                'SourceFile' => $file->getPathname(),
                
            ]);

            // アップロードされたファイルのURLを取得
            $s3Url = $result['ObjectURL'];


            // データベースに保存
            $request->user()->uploads()->create([
                'title' => $fileName, // ファイル名をタイトルとして保存
                'mp3_url' => $s3Url,
            ]);

//dd($fileName); ファイル名取得できている

            return redirect()->route('uploads.index')->with('s3_url', $s3Url);
        } catch (AwsException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        // 🔽 追加
    Gate::authorize('view', $upload);

        return view('uploads.show', compact('upload'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        // 🔽 追加
    Gate::authorize('delete', $upload);
        $upload->delete();

    return redirect()->route('uploads.index');
    }
}
