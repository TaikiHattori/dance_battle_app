<div>
    <!--- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
</div>

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
                    @if ($extractions->isEmpty())
                        <p>再生可能なextractionがありません。</p>
                    @else   
                
                        <audio id="audioPlayer" controls></audio>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        const extractions = @json($extractions);
                        const audioPlayer = document.getElementById('audioPlayer');

                        function shuffle(array) {
                            for (let i = array.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [array[i], array[j]] = [array[j], array[i]];
                            }
                            return array;
                            }

                        const shuffledExtractions = shuffle(extractions);
                        let currentIndex = 0;

                        function playNext() {
                            if (currentIndex < shuffledExtractions.length) {
                            const extraction = shuffledExtractions[currentIndex];
                            audioPlayer.src = `{{ url('/playlist/play') }}/${extraction.id}`;
                            audioPlayer.play();
                            currentIndex++;
                            }
                            }

                        audioPlayer.addEventListener('ended', playNext);

                        // 最初の再生を開始
                        playNext();
                        });
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
