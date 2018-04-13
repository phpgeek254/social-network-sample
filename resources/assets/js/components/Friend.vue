<template>
       <div class="row">
           <p class="text-center" v-if="loading">
               Loading ....
           </p>
           <p class="text-center" v-if="!loading">
               <button class="btn btn-success" v-if="status == 0" @click="add_friend()"> Add Friend</button>
               <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend()"> Accept Friend</button>
               <span class="text-center" v-if="status == 'waiting'"> Friend Request Sent</span>
               <span class="text-center" v-if="status == 'friends'"> Friends</span>
           </p>

    </div>
</template>

<script>
    const Alert = require('alertifyjs');
    export default {

        props: [
          'profile_user_id'
        ],

        data() {
            return {
            status: null,
            loading: true,
            }
        },

        mounted() {
            // Send Ajax request to get all the users.
            axios.get('/check-relationship-status/' + this.profile_user_id).then(res => {
                console.log(res);
                this.status = res.data.status


                this.loading = false
            })
        },
        methods: {
            add_friend(){
                this.loading = true;
                axios.get('/add-friend/'+ this.profile_user_id).then(res => {
                   if(res.data === 1){
                       this.status = 'waiting';
                       new  Noty({
                           layout: 'bottomLeft',
                           type: 'info',
                           text: 'Friend Request Sent.',
                       }).show()
                       document.getElementById('noty_audio').play()
                   }
                   this.loading = false;
                });
            },
            accept_friend(){
                this.loading = true
                axios.get('/accept-friend/' + this.profile_user_id).then(res => {
                    if( res.data ===1 ){
                        this.status = 'friends'
                    }
                    this.loading = false
                })
            }
        }
    }
</script>
