<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>


<!-- resources/views/tweets/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('アップロード作成') }}
    </h2> -->
  </x-slot>

  <style>
    html, body {
      background-color: #121212; /* 背景色を黒っぽく */
      color: #ffffff; /* テキスト色を白に */
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .bg-white {
      background-color: #1f1f1f !important; /* カードの背景色を黒っぽく */
    }

    .text-gray-800, .text-gray-900, .dark\:text-gray-100 {
      color: #ffffff !important; /* テキスト色を白に */
    }

    .dark\:bg-gray-800 {
      background-color: #1f1f1f !important; /* ダークモードの背景色を黒っぽく */
    }

    .bg-blue-500 {
      background-color: #333333 !important; /* ボタンの背景色を黒っぽく */
    }

    .hover\:bg-blue-700:hover {
      background-color: #444444 !important; /* ボタンのホバー時の背景色を黒っぽく */
    }

    .text-white {
      color: #ffffff !important; /* ボタンのテキスト色を白に */
    }

    .container {
      min-height: 100vh; /* コンテナの高さを画面全体に */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .py-12 {
      background-color: #1f1f1f; /* py-12クラスの背景色を黒っぽく */
    }

    .min-h-screen {
      min-height: 100vh; /* 画面全体の高さを確保 */
      background-color: #1f1f1f; /* 背景色を黒っぽく */
    }

    .bg-gray-100 {
      background-color: #1f1f1f !important; /* 背景色を黒っぽく */
    }

    .dark\:bg-gray-900 {
      background-color: #1f1f1f !important; /* ダークモードの背景色を黒っぽく */
    }
  </style>

  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-white-700 dark:text-gray-300">mp3ファイルを選択</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full" required>
                        </div>
                        
                        @error('upload')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                        @enderror
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                アップロード
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
