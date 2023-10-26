<template>
  <div>
          <img :src="getUrlIconSvg('thumbs-up')" alt="Thumbs Up Icon" class="thumbs-up" @click="vote('up')" :class="{ 'thumbs-up-active': upvoted }">
              {{ upvotes_count }}
          <img :src="getUrlIconSvg('thumbs-dow')" alt="Thumbs Down Icon" class="thumbs-down"  @click="vote('down')" :class="{ 'thumbs-down-active': downvoted }">     
              {{ downvotes_count }}
</div>
</template>

<script>
  import numeral from 'numeral'
  export default {
      name: "Vote",
      props: {
          baseUrl: {
            type: String,
            default() {
                return null;
            } 
          },
          default_votes: {
              required: true,
              default: () => []
          },
          entity_owner: {
              required: true,
              default: () => ({})
          },
         
      },
      data() {
          return {
              votes: this.default_votes,
          }
      },
      computed: {
          upvotes() {
              return this.votes.filter(v => v.type === 'up')
          },
          downvotes() {
              return this.votes.filter(v => v.type === 'down')
          },
          upvotes_count() {
              return numeral(this.upvotes.length).format('0a')
          },
          downvotes_count() {
              return numeral(this.downvotes.length).format('0a')
          },
          upvoted() {
              if (! __auth()) return false
              return !!this.upvotes.find(v => v.user_id === __auth().id)
          },
          downvoted() {
              if (! __auth()) return false
              
              return !!this.downvotes.find(v => v.user_id === __auth().id)
          }
      },
      methods: {
          vote(type) {
              if (__auth() && __auth().id === this.entity_owner) {
                  return alert('You cannot vote this item.')
              }
              if (type === 'up' && this.upvoted) return
              if (type === 'down' && this.downvoted) return
          },
          getUrlIconSvg(name) {
              return `${this.baseUrl}/${name}.svg`
          }
      }
  }
</script>
<style>
.thumbs-up, .thumbs-down {
  width: 20px;
  height: 20px;
  cursor: pointer;
  fill: currentColor;
}
.thumbs-down-active, .thumbs-up-active {
  color: #3EA6FF;
}
.thumbs-down {
  margin-left: 1rem;
}
</style>