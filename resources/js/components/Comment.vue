<template>
  <div class="media my-3">
    <avatar :name="comment.user.name" :size="30" class="mr-3"/>
    <div class="media-body">
      <h6 class="mt-0">
           {{comment.name }}
      </h6>
      <small>
         {{ comment.body }}
      </small>
      <div class="d-flex">
              <vote :default_votes="comment.votes" :entity_id="comment.id" :entity_owner="comment.user.id" ></vote>
              <button @click.stop="showReplyBox" class="btn btn-sm ml-2" style="margin-left: 8px;" :class="{'btn-default': !addingReply, 'btn-warning': addingReply}">
                {{ addingReply ? 'Cancel' : 'Add Reply' }}
              </button>
      </div>
      <div v-if="addingReply" class="form-inline my-4 w-full">
          <input v-model="body" type="text" class="form-control form-control-sm w-80">
           <button @click.stop="addReply" class="btn btn-sm btn-primary mt-2">
               <small>Add reply</small>
           </button>
      </div>
      <replies ref='replies'  :comment="comment"></replies>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Avatar from "vue3-avatar";
export default {
 name: "Comment",
 components: {
    avatar: Avatar
 },
 data() {
   return {
      body: '',
      addingReply: false
   }
 },
 props: {
    comment: {
      required: true,
      default: () => ({})
    },
    video: {
       required: true,
       default: () => ({})
    }
 },
 methods: {
    addReply() {
      event.preventDefault();
       if(! this.body) return
       axios.post(`/comments/${this.video.id}`, {
          comment_id: this.comment.id,
          body: this.body
       }).then(({ data }) => {
           this.body = '',
           this.addingReply = false,
           this.$refs.replies.addReply(data);
       }) 
    },
    showReplyBox() {
      event.preventDefault();
      this.addingReply = !this.addingReply
    }
 }

}
</script>