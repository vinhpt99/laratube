<template>
  <div>
    <div class="card">
      <div class="media my-3" style="margin-left: 20px;" v-for="reply in replies.data">
        <a class="mr-3" href="#">
             <avatar :name="reply.user.name" class="mr-3" :size="30"></avatar>
        </a>
        <div class="media-body">
            <h6 class="mt-0">{{ reply.user.name }}</h6>
            <small>
                {{ reply.body }}
            </small>
            <vote :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user.id"></vote>
        </div>
  </div>
    </div>
    
    <div v-if="comment.repliesCount > 0 && replies.next_page_url" class="text-center">
       <button @click="fetchReplies" class="btn btn-info btn-sm mt-1">Load Replies</button>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Avatar from "vue3-avatar";
export default {
  name: "Replies",
  components: {
    avatar: Avatar
  },
  props: {
          comment: {
            type: Object,
            default() {
                return null;
            } 
          },
      },
  data() {
    return {
       replies: {
         data: [],
         next_page_url: `comments/${this.comment.id}/replies`
       }
    }
  },
  mounted() {
       
  },
  methods: {
    fetchReplies() {
       axios.get(this.replies.next_page_url).then(({data}) => {
            this.replies = {
              ...data,
              data: [
                ...this.replies.data,
                ...data.data
              ]

            }
       })
    },
    addReply(reply) {
      this.replies = {
        ...this.replies,
        data: [
          reply,
          ...this.replies.data
        ]
      }
    }
  }
}

</script>