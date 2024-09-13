<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>


<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('抽出一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @if(isset($extracted_files))
            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
              <p class="text-gray-800 dark:text-gray-300">{{ $extracted_files['file_name'] }}</p>
              <audio controls>
                <source src="{{ $extracted_files['url'] }}" type="audio/mpeg">
                Your browser does not support the audio element.
              </audio>
            </div>
          @else
            <p>抽出されたファイルはありません。</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>