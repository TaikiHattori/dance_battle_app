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
                        <button id="playButton">再生</button>


                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const extractions = @json($extractions);
                            const audioPlayer = document.getElementById('audioPlayer');
                            const playButton = document.getElementById('playButton');
                            const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）


                        function shuffle(array) {
                            for (let i = array.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [array[i], array[j]] = [array[j], array[i]];
                            }
                            return array;
                        }


                       function timeToSeconds(time) {
                            const parts = time.split(':').map(part => parseInt(part, 10));
                            let seconds = 0;
                            if (parts.length === 3) {
                            // 時:分:秒
                            seconds = parts[0] * 3600 + parts[1] * 60 + parts[2];
                            } else if (parts.length === 2) {
                            // 分:秒
                            seconds = parts[0] * 60 + parts[1];
                            }
                            return seconds;
                        }


                        const shuffledExtractions = shuffle(extractions);
                        let currentIndex = 0;
                        let songDuration = 0; // songDuration をplayNext関数の外で定義(=グローバルスコープで定義する)


                        function fadeOut(audio, duration) {
                            const step = audio.volume / (duration * 100);
                            const fade = setInterval(() => {
                            if (audio.volume > step) {
                            audio.volume -= step;
                            } else {
                            clearInterval(fade);
                            audio.volume = 0;
                            playNext();
                            }
                            }, 10);
                        }


                       

                        function playNext() {
                            if (currentIndex < shuffledExtractions.length) {
                            const extraction = shuffledExtractions[currentIndex];
                            audioPlayer.src = `{{ url('/playlist/play') }}/${extraction.id}`;
                            audioPlayer.volume = 1; // 次の曲の音量を最大に設定
                            audioPlayer.play();

                            const endSeconds = timeToSeconds(extraction.end);
                            const startSeconds = timeToSeconds(extraction.start);
                            songDuration = endSeconds - startSeconds; // songDuration を更新
                        
                        console.log('Extraction End:', extraction.end);
                        console.log('Extraction Start:', extraction.start);
                        console.log('endSeconds:', endSeconds);
                        console.log('startSeconds:', startSeconds);
                        console.log('songDuration:', songDuration);

                            currentIndex++;
                            }
                        }


                        audioPlayer.addEventListener('play', () => {
                            fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer, fadeDuration), (songDuration - fadeDuration) * 1000);

                        });

                    
                        // ボタンがクリックされたときに再生を開始
                        playButton.addEventListener('click', () => {
                            playNext();
                        });
                        
                    });
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>