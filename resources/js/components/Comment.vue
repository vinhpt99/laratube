<template>
  <div class="mt-5 p-5">
    <div class="media" v-for="comment in comments.data">
        <avatar :name="comment.name" :size="30" class="mr-3"/>
        <div class="media-body">
            <h6 class="mt-0">
                 {{comment.name }}
            </h6>
            <small>
               {{ comment.body }}
            </small>
            <div class="form-inline my-3 w-full">
                    <input type="text" class="form-control form-control-sm w-80">
                    <button class="btn btn-sm btn-primary mt-2">
                        <small>Add comment</small>
                    </button>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-success">
                Load More
        </button>
    </div>
</div>
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
      axios.get(`/video/${this.video.id}/comments`).then(({data}) => {
          this.comments = data
      })
    }
  
  }

  

}
</script>
