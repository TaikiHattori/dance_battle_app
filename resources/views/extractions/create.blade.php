<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>


<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('抽出') }}
    </h2>
  </x-slot>

  <style>
    html, body {
      background-color: #1f1f1f; /* 背景色を#1f1f1fに設定 */
      color: #ffffff; /* テキスト色を白に */
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .bg-white {
      background-color: #1f1f1f !important; /* カードの背景色を#1f1f1fに設定 */
    }

    .text-gray-800, .text-gray-900, .dark\:text-gray-100 {
      color: #ffffff !important; /* テキスト色を白に */
    }

    .dark\:bg-gray-800 {
      background-color: #1f1f1f !important; /* ダークモードの背景色を#1f1f1fに設定 */
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

    .py-12 {
      background-color: #1f1f1f; /* py-12クラスの背景色を#1f1f1fに設定 */
    }

    .min-h-screen {
      min-height: 100vh; /* 画面全体の高さを確保 */
      background-color: #1f1f1f; /* 背景色を#1f1f1fに設定 */
    }

    .bg-gray-100 {
      background-color: #1f1f1f !important; /* 背景色を#1f1f1fに設定 */
    }

    .dark\:bg-gray-900 {
      background-color: #1f1f1f !important; /* ダークモードの背景色を#1f1f1fに設定 */
    }

    .text-gray-600, .dark\:text-gray-400 {
      color: #cccccc !important; /* テキスト色を薄いグレーに設定 */
    }

    .text-blue-500 {
      color: #1e90ff !important; /* リンクのテキスト色を青に設定 */
    }

    .hover\:text-blue-700:hover {
      color: #1c86ee !important; /* リンクのホバー時のテキスト色を濃い青に設定 */
    }

    .border-white {
      border: 1px solid #ffffff !important; /* 枠線の色を白に設定 */
    }
  </style>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form action="{{ route('extractions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="start_time" class="block text-sm font-medium text-white-700">開始時間 (秒)</label>
              <input type="number" name="start_time" id="start_time" class="mt-1 block w-full" required>
            </div>
            <div class="mb-4">
              <label for="end_time" class="block text-sm font-medium text-white-700">終了時間 (秒)</label>
              <input type="number" name="end_time" id="end_time" class="mt-1 block w-full" required>
            </div>
            <input type="hidden" name="upload_id" value="{{ $upload->id }}">
            <div class="flex justify-end">
              <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">抽出</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>