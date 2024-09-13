<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>


<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('秒数指定') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <form action="{{ route('extractions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="start_time" class="block text-sm font-medium text-gray-700">開始時間 (秒)</label>
              <input type="number" name="start_time" id="start_time" class="mt-1 block w-full" required>
            </div>
            <div class="mb-4">
              <label for="end_time" class="block text-sm font-medium text-gray-700">終了時間 (秒)</label>
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