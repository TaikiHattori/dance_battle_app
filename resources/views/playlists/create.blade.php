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
                
                        <audio id="audioPlayer" controls ></audio>

            <div class="flex justify-center items-center h-screen flex-col">
              <!-- 再生バー -->
              <div class="w-full max-w-xl bg-gray-300 rounded-full h-4 mb-4">
                <div id="progressBar" class="bg-[#4EA1D5] h-4 rounded-full" style="width: 0%;"></div>
              </div>

              <!-- 再生ボタン -->
              <button id="playButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center justify-center w-32 h-32">
                <svg class="w-16 h-16 fill-current text-white" viewBox="0 0 24 24">
                  <polygon points="5,3 19,12 5,21" />
                </svg>
              </button>
            </div>


                        

                        <!-- <audio id="audioPlayer1" controls></audio>
                        <audio id="audioPlayer2" controls style="display:none;"></audio>
                        <button id="playButton">再生</button> -->



                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const extractions = @json($extractions);
                            const audioPlayer = document.getElementById('audioPlayer');
                            const playButton = document.getElementById('playButton');
                            const progressBar = document.getElementById('progressBar');
                            const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）


                            // const audioPlayer1 = document.getElementById('audioPlayer1');
                            // const audioPlayer2 = document.getElementById('audioPlayer2');

                            // let currentAudioPlayer = audioPlayer1;
                            // let nextAudioPlayer = audioPlayer2;


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
                      //let fadeOutTimeout; // fadeOutTimeout をグローバルスコープで定義


                        function fadeOut(audio, duration) {
                  const step = audio.volume / (duration * 100);
                  const fade = setInterval(() => {
                    if (audio.volume > step) {
                      audio.volume -= step;
                    } else {
                      clearInterval(fade);
                      audio.volume = 0;
                //if (callback) callback();
                    playNext();

                    }
                  }, 10); // 10ミリ秒ごとに音量を減少させる
                }




                    function fadeIn(audio, duration) {
                  audio.volume = 0;
                  const step = 1 / (duration * 100);
                  const fade = setInterval(() => {
                    if (audio.volume < 1 - step) {
                      audio.volume += step;
                    } else {
                      clearInterval(fade);
                      audio.volume = 1;
                    }
                  }, 10); // 10ミリ秒ごとに音量を増加させる
                }


                       

                        function playNext() {
                            if (currentIndex < shuffledExtractions.length) {
                            const extraction = shuffledExtractions[currentIndex];
                            audioPlayer.src = `{{ url('/playlist/play') }}/${extraction.id}`;
                            audioPlayer.volume = currentIndex === 0 ? 1 : 0; // 1曲目は音量を最大に設定、2曲目以降は0に設定（フェードイン用）
                            audioPlayer.play();



                          // function playNext() {
                          //   if (currentIndex < shuffledExtractions.length) {
                          //   const extraction = shuffledExtractions[currentIndex];
                          //   nextAudioPlayer.src = `{{ url('/playlist/play') }}/${extraction.id}`;
                          //   nextAudioPlayer.volume = 0; // 次の曲はフェードインで開始
                            
                          //   nextAudioPlayer.addEventListener('canplaythrough', function onCanPlayThrough() {
                          //   nextAudioPlayer.removeEventListener('canplaythrough', onCanPlayThrough);
                          //   nextAudioPlayer.play();
                          //   fadeIn(nextAudioPlayer, fadeDuration); // フェードインを開始
                          // });




                            const endSeconds = timeToSeconds(extraction.end);
                            const startSeconds = timeToSeconds(extraction.start);
                            songDuration = endSeconds - startSeconds; // songDuration を更新
                        
                        //console.log('Extraction End:', extraction.end);
                        //console.log('Extraction Start:', extraction.start);
                        //console.log('endSeconds:', endSeconds);
                        //console.log('startSeconds:', startSeconds);
                        //console.log('songDuration:', songDuration);

                            if (currentIndex !== 0) {
                            fadeIn(audioPlayer, fadeDuration); // 2曲目以降はフェードインを開始
                            }


                            currentIndex++;
                            }
                        }


                        //フェードアウトの要点
                        audioPlayer.addEventListener('play', () => {
                            fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer, fadeDuration), (songDuration - fadeDuration) * 1000);

                        });

                    
                // audioPlayer.addEventListener('timeupdate', () => {
                //   if (audioPlayer.currentTime >= songDuration - fadeDuration) {
                //     clearTimeout(fadeOutTimeout);
                //     fadeOutTimeout = setTimeout(() => {
                //       fadeOut(audioPlayer, fadeDuration);
                //       playNext(); // フェードアウトと同時に次の曲を再生
                //     }, (songDuration - audioPlayer.currentTime) * 1000);
                //   }
                // });



                  // currentAudioPlayer.addEventListener('timeupdate', () => {
                  //   if (currentAudioPlayer.currentTime >= songDuration - fadeDuration) {
                  //   clearTimeout(fadeOutTimeout);
                  //   fadeOutTimeout = setTimeout(() => {
                  //     fadeOut(currentAudioPlayer, fadeDuration, () => {
                  //       playNext(); // フェードアウトと同時に次の曲を再生
                  //       // プレイヤーを切り替える
                  //       [currentAudioPlayer, nextAudioPlayer] = [nextAudioPlayer, currentAudioPlayer];
                  //     });
                  //   }, (songDuration - currentAudioPlayer.currentTime) * 1000);
                  // }
                  // });

// 再生バーの更新
                audioPlayer.addEventListener('timeupdate', () => {
                  const progress = (audioPlayer.currentTime / songDuration) * 100;
                  progressBar.style.width = `${progress}%`;
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