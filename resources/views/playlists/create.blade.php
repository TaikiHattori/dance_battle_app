<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('再生') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <audio id="audioPlayer" controls></audio>
          <button id="playButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            再生
          </button>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const audioPlayer = document.getElementById('audioPlayer');
              const playButton = document.getElementById('playButton');

              playButton.addEventListener('click', () => {
                audioPlayer.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                audioPlayer.play();
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>