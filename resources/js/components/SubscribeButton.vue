<template>
    <div>
        <button  class="btn btn-danger" @click="toggleSubscription">
                               {{ owner ? '' : subscribed ? 'Unsubscribe': 'Subscribe' }}  {{ count }} {{owner ? 'Subscribers': '' }}
        </button>
    </div>
</template>
<script>
import Numeral from "numeral";
export default {
    name: "SubscribeButton",
    props: {
       chanel: {
         type: Object,
         required: true,
         default: () => ({

         })
       },
       initialSubscriptions: {
          type: Array,
          required: true,
          default: () => []
       },
       
    },
    data: function() {
        return {
            subscriptions: this.initialSubscriptions
        }
    },
    computed: {
        subscribed() {
            if(! __auth() || this.chanel.user_id === __auth().id) 
                return false;
            return !!this.subscription;
          
        },
        owner() {
            if(__auth() && this.chanel.user_id === __auth().id) return true;
                    return false;
        },

        subscription() {
            if(!__auth()) 
                return null
            // debugger
            return this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        }, 

        count() {
          return Numeral(this.subscriptions.length).format('0a')
        }
    },
    methods: {
        toggleSubscription() {
            console.log('subscription()', this.subscription, this.subscriptions);
            if(!__auth()) {
                alert("Please login to subrice");
            }
           
            if(this.owner) {
                return alert("You can not subscribe to your channel."); 
            }

            if(this.subscribed) {
                axios.delete(`/channels/${this.chanel.id}/subscriptions/${this.subscription.id}`)
                     .then(() => {
                          this.subscriptions = this.subscriptions.filter(item => item.id === this.subscription.id);
                     })
            }
            else {
                axios.post(`/channels/${this.chanel.id}/subscriptions`)
                     .then(response => {
                        this.subscriptions = [
                            ...this.subscription,
                            response.data
                        ]
                     })
            }
        }
    }

}
</script>