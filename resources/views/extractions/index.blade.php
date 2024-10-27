<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>


<x-app-layout>
  <x-slot name="header">
    <!-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('抽出一覧') }}
    </h2> -->
  </x-slot>

<style>
    html, body {
      color: #ffffff; /* テキスト色を白に */
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .text-gray-800, .text-gray-900, .dark\:text-gray-100 {
      color: #ffffff !important; /* テキスト色を白に */
    }

    .bg-blue-500 {
      background-color: #333333 !important; /* ボタンの背景色を#333333に設定 */
    }

    .hover\:bg-blue-700:hover {
      background-color: #444444 !important; /* ボタンのホバー時の背景色を#444444に設定 */
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

    .min-h-screen {
      min-height: 100vh; /* 画面全体の高さを確保 */
    }

    .bg-gray-100 {
      background-color: #1f1f1f !important; /* 背景色を#1f1f1fに設定 */
      border: 1px solid #ffffff !important; /* 枠線の色を白に設定 */
    }

    .dark\:bg-gray-900 {
      background-color: #1f1f1f !important; /* ダークモードの背景色を#1f1f1fに設定 */
    }

    .text-blue-500 {
      color: #1e90ff !important; /* リンクのテキスト色を青に設定 */
    }

    .hover\:text-blue-700:hover {
      color: #1c86ee !important; /* リンクのホバー時のテキスト色を濃い青に設定 */
    }
  </style>

  {{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @foreach ($extractions as $extraction)
          <div class="mb-4 p-4 rounded-lg">
            <p class="text-gray-800 dark:text-gray-300">タイトル: {{ $extraction->upload->title }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">抽出開始: {{ $extraction->start }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">抽出終了: {{ $extraction->end }}</p>
            <a href="{{ route('extractions.show', $extraction) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>

            <a href="{{ route('memos.create', $extraction) }}" class="ml-4 text-blue-500 hover:text-blue-700">メモ作成</a>


          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div> --}}

  <div class="py-12 px-4">
    @foreach ($extractions as $extraction)
    <div class="flex max-w-md mx-auto overflow-hidden rounded-lg shadow-lg mb-4" style="box-shadow: 0px 0px 30px 10px rgb(255 255 255 / 80%);">
        <div class="w-1/3 bg-cover" style="background-image: url('{{ asset('images/tsuki.png') }}')"></div>
    
        <div class="w-2/3 p-4 md:p-4">
            <p class="text-xm font-bold text-white">{{ $extraction->upload->title }}</p>
            <p class="text-gray-400 text-sm">開始: {{ $extraction->start }}</p>
            <p class="text-gray-400 text-sm">終了: {{ $extraction->end }}</p>

            <div class="flex justify-between mt-3 item-center">
                <a href="{{ route('extractions.show', $extraction) }}" class="text-sm hover:text-gray-200">詳細を見る</a>
                <a href="{{ route('memos.create', $extraction) }}" class="border-solid border border-white px-2 py-1 font-bold text-white uppercase transition-colors duration-300 transform rounded hover:bg-gray-700 focus:outline-none focus:bg-gray-700">メモ作成</a>
            </div>
        </div>
    </div>
    @endforeach
  </div>

</x-app-layout>