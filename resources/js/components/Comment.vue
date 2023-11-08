<template>
  <div class="mt-5 p-5">
    <!-- <div class="media" v-for="comment in comments.data"> -->
        <div class="form-inline my-4 w-full">
            <input type="text" class="form-control form-control-sm w-80">
            <button class="btn btn-sm btn-primary mt-2">
                <small>Add comment</small>
            </button>
        </div>
        <div class="media my-3" v-for="comment in comments.data">
          <avatar :name="comment.user.name" :size="30" class="mr-3"/>
          <div class="media-body">
            <h6 class="mt-0">
                 {{comment.name }}
            </h6>
            <small>
               {{ comment.body }}
            </small>
            <replies :comment="comment"></replies>
          </div>
        </div>
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
  name: "Comment",
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
     
  },
  data: function() {
        return {
          comments: {
              data: []
          }
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
    }
  
  }

  

}
</script>
