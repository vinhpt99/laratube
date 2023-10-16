<template>
  <div>
     <video ref="videoJsPlayer" class="video-js vjs-defaultskin"></video>
  </div>
</template>
<script>
  // Importing video-js
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
        this.player.log('video player ready', this);
     });
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
<style>
.vjs-default-skin {
    width: 100%;
}
</style>

    