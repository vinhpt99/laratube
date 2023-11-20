<template>
  <div>
          <img :src="thumbsUpIconPath" alt="Thumbs Up Icon" class="thumbs-up" @click="vote('up')" :class="{ 'thumbs-up-active': upvoted }">
              {{ upvotes_count }}
          <img :src="thumbsDownIconPath" alt="Thumbs Down Icon" class="thumbs-down"  @click="vote('down')" :class="{ 'thumbs-down-active': downvoted }">     
              {{ downvotes_count }}
</div>
</template>

<script>
  import numeral from 'numeral'
  import axios from 'axios'
  import thumbsUpIcon from '@/thumbs-up.svg';
  import thumbsDownIcon from '@/thumbs-dow.svg';
  export default {
      name: "Vote",
      props: {
          default_votes: {
              required: true,
              default: null,
          },
          entity_owner: {
              required: true,
              default: null
          },
          entity_id : {
            required: true,
            default: null
          },
          
      },
      data() {
          return {
              votes: this.isObjectCheck(this.default_votes) ? [] : this.default_votes,
              thumbsUpIconPath: thumbsUpIcon,
              thumbsDownIconPath: thumbsDownIcon
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
           isObjectCheck(value) {
               if(value !== null && typeof value === 'object' && !Array.isArray(value)) 
                   return true
               return false
          },
          vote(type) {
              if (! __auth() ) {
                  return alert('Please login to vote.')
              }
              if( __auth().id === this.entity_owner) {
                 return alert('You can not vote this item.')
              }
              if (type === 'up' && this.upvoted) return
              if (type === 'down' && this.downvoted) return

              axios.post(`/votes/${this.entity_id}/${type}`).then(({data}) => {
                 if(this.upvoted || this.downvoted) {
                     this.votes = this.votes.map(vote => {
                        if(vote.user_id === __auth().id) {
                              return data;
                        }
                        return vote
                     })
                 }
                 else {
                    this.votes = [
                        ...this.votes,
                        data
                    ]
                 }

              })
           
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