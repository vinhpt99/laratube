<template>
  <div class="mt-5 p-5">
    <!-- <div class="media" v-for="comment in comments.data"> -->
        <div v-if="auth" class="form-inline my-4 w-full">
            <input v-model="newComment" type="text" class="form-control form-control-sm w-80">
            <button @click="addComment"  class="btn btn-sm btn-primary mt-2">
                <small>Add comment</small>
            </button>
        </div>
        <comment  v-for='comment in comments.data' :key="comment.id" :comment="comment" :video="video" ></comment>
    </div>
    <div class="text-center">
        <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-success">
                Load More
        </button>
        <span v-else>No more comments to show :)</span>
    </div>
<!-- </div> -->
</template>
<script>
import axios from 'axios'
import Avatar from "vue3-avatar";

export default {
  name: "Comments",
  components: {
    avatar: Avatar
  },
  props: {
         video: {
           type: Object,
           required: true,
           default: () => ([])
         }
  },
  mounted() {
      this.fetchComments();
  },
  computed: {
     auth() {
       return __auth();
     }
     
  },
  data: function() {
        return {
          comments: {
              data: []
          },
          newComment: ''
        }
  },
  methods: {
    fetchComments() {
      const url = this.comments.next_page_url ? this.comments.next_page_url : `/video/${this.video.id}/comments`
      axios.get(url).then(({data}) => {
          this.comments = {
            ...data,
            data: [
              ...this.comments.data,
              ...data.data
            ]
          }
      })
    },
    addComment() {
      console.log(11111)
      event.preventDefault();
       if(! this.newComment) return
       axios.post(`/comments/${this.video.id}`, {
             body: this.newComment
       }).then(({ data }) => {
           this.comments = {
              ...this.comments,
              data: [
                data,
                ...this.comments.data
              ]
           }

       })
    }
  
  }

  

}
</script>
