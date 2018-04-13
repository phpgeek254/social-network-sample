<template>
    <div>
        <p class="text-center" v-for="like in post.likes">

            <img :src="like.user.avatar" width="40px" height="40">
        </p>
        <hr>
        <button class="btn btn-primary" v-if="!auth_user_likes_post" @click="like()"> Like </button>
        <button class="btn btn-danger" v-else @click="unlike()"> Unlike </button>
    </div>
</template>

<script>
    export default {
        props: ['id', 'feed', 'likes'],
        mounted() {

        },
        computed: {
            post() {
                return this.$store.state.posts.find((post) => {
                    return post.id === this.id
                })
            },

            likers() {
                let likers = []
                this.post.likes.forEach((like) => {
                    likers.push(like.user.id)
                })
                return likers
                console.log(likers);
            },
            auth_user_likes_post() {
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                )
                if (check_index == -1)
                    return false
                else
                    return true
            }
        },

        methods: {
            like(){
                axios.post('/like', {
                    post_id: this.post.id,
                    user_id: this.$store.state.auth_user.id
                }).then( resp => {
                    this.$store.commit('UPDATE_POST_LIKES', {
                        id: this.id,
                        like: resp.data
                })

                  // new Noty({
                  //     type: 'success',
                  //     layout: 'bottomLeft',
                  //     text: 'You successfully liked this post!'
                  // })
                })
            },
            unlike(){
                axios.get('/unlike/' + this.feed.id).then((response) => {
                    console.log(response)
                    this.$store.commit('UNLIKE_POST', {
                        post_id: this.feed.id,
                        like_id: response.data
                    })
                    // new Noty({
                    //     type: 'success',
                    //     layout: 'bottomLeft',
                    //     text: 'You successfully unliked this post!'
                    // })
                })
            }
        }
    }
</script>
