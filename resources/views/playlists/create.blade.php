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
              <!-- <div class="w-full max-w-xl bg-gray-300 rounded-full h-4 mb-4">
                <div id="progressBar" class="bg-[#4EA1D5] h-4 rounded-full" style="width: 0%;"></div>
              </div> -->

              <!-- 再生ボタン -->
              <button id="playButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full flex items-center justify-center w-32 h-32">
                <svg class="w-16 h-16 fill-current text-white" viewBox="0 0 24 24">
                  <polygon points="5,3 19,12 5,21" />
                </svg>
              </button>
            </div>


                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const extractions = @json($extractions);
                            const audioPlayer = document.getElementById('audioPlayer');
                            const playButton = document.getElementById('playButton');
                            const progressBar = document.getElementById('progressBar');
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



                            const endSeconds = timeToSeconds(extraction.end);
                            const startSeconds = timeToSeconds(extraction.start);
                            songDuration = endSeconds - startSeconds; // songDuration を更新
                       
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

                    
// 再生バーの更新
                // audioPlayer.addEventListener('timeupdate', () => {
                //   const progress = (audioPlayer.currentTime / songDuration) * 100;
                //   progressBar.style.width = `${progress}%`;
                // });

                        // ボタンがクリックされたときに再生を開始
                        playButton.addEventListener('click', () => {
                            playNext();
                        });
                        
                    });
                    </script>
                    @endif
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <!-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <audio id="audioPlayer1" controls></audio>
          <audio id="audioPlayer2" controls></audio>
          <audio id="audioPlayer3" controls></audio>
          <audio id="audioPlayer4" controls></audio>
          <button id="playButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            再生
          </button>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const extractions = @json($extractions);
              const audioPlayer1 = document.getElementById('audioPlayer1');
              const audioPlayer2 = document.getElementById('audioPlayer2');
              const audioPlayer3 = document.getElementById('audioPlayer3');
              const audioPlayer4 = document.getElementById('audioPlayer4');
              const playButton = document.getElementById('playButton');
              const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）

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

              function fadeOut(audio, duration, callback) {
                const step = audio.volume / (duration * 100);
                const fade = setInterval(() => {
                  if (audio.volume > step) {
                    audio.volume -= step;
                  } else {
                    clearInterval(fade);
                    audio.volume = 0;
                    audio.pause();
                    if (callback) callback();
                  }
                }, 10); // 10ミリ秒ごとに音量を減少させる
              }

              function playTrack1() {
                const extraction = extractions[0]; // 1曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer1.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                audioPlayer1.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer1.onloadeddata = () => {
                  audioPlayer1.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer1, fadeDuration, playTrack2), (fadeOutStart - audioPlayer1.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer1.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                      playTrack2(); // 次の曲を再生
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              function playTrack2() {
                const extraction = extractions[1]; // 2曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer2.src = `{{ url('/playlist/play/02 September.mp3') }}`;
                audioPlayer2.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer2.onloadeddata = () => {
                  audioPlayer2.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer2, fadeDuration, playTrack3), (fadeOutStart - audioPlayer2.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer2.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                      playTrack3(); // 次の曲を再生
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              function playTrack3() {
                const extraction = extractions[2]; // 3曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer3.src = `{{ url('/playlist/play/06 Virtual Insanity.mp3') }}`;
                audioPlayer3.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer3.onloadeddata = () => {
                  audioPlayer3.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer3, fadeDuration, playTrack4), (fadeOutStart - audioPlayer3.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer3.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                      playTrack4(); // 次の曲を再生
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              function playTrack4() {
                const extraction = extractions[3]; // 4曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer4.src = `{{ url('/playlist/play/11 Canned Heat.mp3') }}`;
                audioPlayer4.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer4.onloadeddata = () => {
                  audioPlayer4.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer4, fadeDuration), (fadeOutStart - audioPlayer4.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer4.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              // ボタンがクリックされたときに再生を開始
              playButton.addEventListener('click', () => {
                playTrack1();
              });
            });
          </script> -->














  <!-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <audio id="audioPlayer1" controls></audio>
          <audio id="audioPlayer2" controls></audio>
          <button id="playButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            再生
          </button>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const extractions = @json($extractions);
              const audioPlayer1 = document.getElementById('audioPlayer1');
              const audioPlayer2 = document.getElementById('audioPlayer2');
              const playButton = document.getElementById('playButton');
              const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）

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

              function fadeOut(audio, duration, callback) {
                const step = audio.volume / (duration * 100);
                const fade = setInterval(() => {
                  if (audio.volume > step) {
                    audio.volume -= step;
                  } else {
                    clearInterval(fade);
                    audio.volume = 0;
                    audio.pause();
                    if (callback) callback();
                  }
                }, 10); // 10ミリ秒ごとに音量を減少させる
              }

              function playTrack1() {
                const extraction = extractions[0]; // 1曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer1.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                audioPlayer1.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer1.onloadeddata = () => {
                  audioPlayer1.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer1, fadeDuration, playTrack2), (fadeOutStart - audioPlayer1.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer1.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                      playTrack2(); // 次の曲を再生
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              function playTrack2() {
                const extraction = extractions[1]; // 2曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer2.src = `{{ url('/playlist/play/02 September.mp3') }}`;
                audioPlayer2.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer2.onloadeddata = () => {
                  audioPlayer2.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer2, fadeDuration), (fadeOutStart - audioPlayer2.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer2.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              // ボタンがクリックされたときに再生を開始
              playButton.addEventListener('click', () => {
                playTrack1();
              });
            });
          </script> -->








          <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
              const extractions = @json($extractions);
              const audioPlayer1 = document.getElementById('audioPlayer1');
              const audioPlayer2 = document.getElementById('audioPlayer2');
              const playButton = document.getElementById('playButton');
              const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）

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

              function fadeOut(audio, duration, callback) {
                const step = audio.volume / (duration * 100);
                const fade = setInterval(() => {
                  if (audio.volume > step) {
                    audio.volume -= step;
                  } else {
                    clearInterval(fade);
                    audio.volume = 0;
                    audio.pause();
                    if (callback) callback();
                  }
                }, 10); // 10ミリ秒ごとに音量を減少させる
              }

              function playTrack1() {
                const extraction = extractions[0]; // 1曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer1.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                audioPlayer1.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer1.onloadeddata = () => {
                  audioPlayer1.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer1, fadeDuration, playTrack2), (fadeOutStart - audioPlayer1.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer1.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                      playTrack2(); // 次の曲を再生
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              function playTrack2() {
                const extraction = extractions[1]; // 2曲目のextractionを使用
                const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                audioPlayer2.src = `{{ url('/playlist/play/02 September.mp3') }}`;
                audioPlayer2.load(); // 追加: srcを設定した後にloadを呼び出す

                audioPlayer2.onloadeddata = () => {
                  audioPlayer2.play().then(() => {
                    // フェードアウトを開始するタイミングを設定
                    const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer2, fadeDuration), (fadeOutStart - audioPlayer2.currentTime) * 1000);

                    // 再生が終了したらタイマーをクリア
                    audioPlayer2.addEventListener('ended', () => {
                      clearTimeout(fadeOutTimeout);
                    });
                  }).catch(error => {
                    console.error('再生エラー:', error);
                  });
                };
              }

              // ボタンがクリックされたときに再生を開始
              playButton.addEventListener('click', () => {
                playTrack1();
              });
            });
          </script> -->






          <!-- <script>//end指定フェードアウト＆DBからmp3_url取得して1曲再生：成功
            document.addEventListener('DOMContentLoaded', function() {
              const extractions = @json($extractions);
              const audioPlayer = document.getElementById('audioPlayer');
              const playButton = document.getElementById('playButton');
              const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）

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

              function fadeOut(audio, duration) {
                const step = audio.volume / (duration * 100);
                const fade = setInterval(() => {
                  if (audio.volume > step) {
                    audio.volume -= step;
                  } else {
                    clearInterval(fade);
                    audio.volume = 0;
                    audio.pause();
                  }
                }, 10); // 10ミリ秒ごとに音量を減少させる
              }

              function playNext() {
                if (extractions.length > 0) {
                  const extraction = extractions[0]; // 最初のextractionを使用
                  const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                  const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                 // extraction.upload.mp3_urlを使用して音声ファイルのURLを設定
                  audioPlayer.src = extraction.upload.mp3_url;
                  console.log(audioPlayer.src);

                  audioPlayer.load(); // 追加: srcを設定した後にloadを呼び出す

                  audioPlayer.onloadeddata = () => {
                    audioPlayer.play().then(() => {
                      // フェードアウトを開始するタイミングを設定
                      const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer, fadeDuration), (fadeOutStart - audioPlayer.currentTime) * 1000);

                      // 再生が終了したらタイマーをクリア
                      audioPlayer.addEventListener('ended', () => {
                        clearTimeout(fadeOutTimeout);
                      });
                    }).catch(error => {
                      console.error('再生エラー:', error);
                    });
                  };
                }
              }

              // ボタンがクリックされたときに再生を開始
              playButton.addEventListener('click', () => {
                playNext();
              });
            });
          </script> -->







          <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
              const extractions = @json($extractions);
              const audioPlayer = document.getElementById('audioPlayer');
              const playButton = document.getElementById('playButton');
              const fadeDuration = 5; // フェードイン・フェードアウトの時間（秒）
//end指定フェードアウト：成功
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

              function fadeOut(audio, duration) {
                const step = audio.volume / (duration * 100);
                const fade = setInterval(() => {
                  if (audio.volume > step) {
                    audio.volume -= step;
                  } else {
                    clearInterval(fade);
                    audio.volume = 0;
                    audio.pause();
                  }
                }, 10); // 10ミリ秒ごとに音量を減少させる
              }

              function playNext() {
                if (extractions.length > 0) {
                  const extraction = extractions[0]; // 最初のextractionを使用
                  const endSeconds = timeToSeconds(extraction.end); // 再生終了秒数
                  const fadeOutStart = endSeconds - fadeDuration; // フェードアウト開始時間（秒）

                  audioPlayer.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                  audioPlayer.load(); // 追加: srcを設定した後にloadを呼び出す

                  audioPlayer.onloadeddata = () => {
                    audioPlayer.play().then(() => {
                      // フェードアウトを開始するタイミングを設定
                      const fadeOutTimeout = setTimeout(() => fadeOut(audioPlayer, fadeDuration), (fadeOutStart - audioPlayer.currentTime) * 1000);

                      // 再生が終了したらタイマーをクリア
                      audioPlayer.addEventListener('ended', () => {
                        clearTimeout(fadeOutTimeout);
                      });
                    }).catch(error => {
                      console.error('再生エラー:', error);
                    });
                  };
                }
              }

              // ボタンがクリックされたときに再生を開始
              playButton.addEventListener('click', () => {
                playNext();
              });
            });
          </script> -->




          <!-- <script>
            document.addEventListener('DOMContentLoaded', function() {
              const audioPlayer = document.getElementById('audioPlayer');
              const playButton = document.getElementById('playButton');

              playButton.addEventListener('click', () => {
                audioPlayer.src = `{{ url('/playlist/play/14 Shining Star.mp3') }}`;
                audioPlayer.play();

              // 5秒後にフェードアウトを開始
                setTimeout(() => {
                  const fadeOutDuration = 5000; // フェードアウトの期間（ミリ秒）
                  const fadeOutInterval = 50; // フェードアウトの間隔（ミリ秒）
                  const fadeOutStep = audioPlayer.volume / (fadeOutDuration / fadeOutInterval);

                  const fadeOut = setInterval(() => {
                    if (audioPlayer.volume > 0) {
                      audioPlayer.volume = Math.max(0, audioPlayer.volume - fadeOutStep);
                    } else {
                      clearInterval(fadeOut);
                      audioPlayer.pause();
                    }
                  }, fadeOutInterval);
                }, 5000); // 再生開始から5秒後にフェードアウトを開始:成功

              });
            });
          </script> -->
        </div>
      </div>
    </div>
  </div>
</x-app-layout>