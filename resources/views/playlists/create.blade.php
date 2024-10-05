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
          </script>








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