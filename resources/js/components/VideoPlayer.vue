<template>
  <div>
     <video ref="videoJsPlayer" class="video-js vjs-defaultskin"></video>
  </div>
</template>
<script>

import axios from 'axios';
import videojs from 'video.js';
  export default {
     name: 'VideoJsPlayer',
     props: {
        videoSource: {
           type: String,
           default() {
               return null;
           } 
        }
     },
     data() {
        return {
             player: null,
             viewLogged: false,
             btnReload: null,
             options: {
                  autoplay: true,
                  controls: true,
                  preload: true,
                  fluid: true,
                  width: 640,
                  height: 268,
                  sources: {
                    src: null,
                    type: 'application/x-mpegURL'
                  }
             }
     }
  },
  // initializing the video player
  // when the component is being mounted
  created() {
      this.options.sources.src = this.videoSource
  },
  mounted() {
   this.player = videojs(this.$refs.videoJsPlayer, this.options,() => {
          const videoPlay = this.player;
          videoPlay.on('timeupdate', function() {
                var percentagePlayed = Math.ceil(videoPlay.currentTime() / videoPlay.duration() * 100)
                if(percentagePlayed > 5 && !this.viewLogged) {
                      axios.put('/videos/' + window.CURRENT_VIDEO)
                      this.viewLogged = true;
                }
          })
          this.btnReload  = document.querySelector(".vjs-play-control");
          this.btnReload.addEventListener('click', this.handleReloadButtonClick)
   });
  },

  methods: {
   handleReloadButtonClick() {
         if(this.btnReload.title === 'Replay') {
            let viewReload = true
            const videoPlay = this.player;
            videoPlay.on('timeupdate', function() {
                var percentagePlayed = Math.ceil(videoPlay.currentTime() / videoPlay.duration() * 100)
                if(percentagePlayed > 5 && viewReload) {
                      axios.put('/videos/' + window.CURRENT_VIDEO)
                      viewReload = false
                }
           })
         }
        
      }  
  },
  
  // destroying the video player
  // when the component is being destroyed
  beforeDestroy() {
     if (this.player) {
        this.player.dispose();
     }
  }
}
</script>


    