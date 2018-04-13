<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default" v-for="post in posts">
                    <div class="panel-heading">
                        <h4> {{ post.user.name }} </h4>
                        <img :src="post.user.avatar" width="50px" height="50px" class="post-avatar">
                        <span class="pull-right">
                                {{ post.created_at }}
                            </span>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{ post.content }}
                        </p>
                    </div>
                    <div class="panel-footer">
                        <span class="pull-right">
                            {{ post.created_at }}
                        </span>
                        <h4>Likes</h4>
                        <Like :id="post.id" :feed="post" :likes="post.likes"></Like>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Like from './Like.vue'

    export default {
        components: {
        Like
        },

        mounted() {
            this.get_posts()
        },

        computed: {
            posts() {
                return this.$store.getters.all_posts
            }
        },
        methods: {
            get_posts() {
                axios.get('/post').then(response => {
                    response.data.forEach( (post) => {
                        this.$store.commit('ADD_POST', post)
                    })

                })
            }
        },
    }
</script>

<style>
    .post-avatar {
        border-radius: 50%;
    }
</style>
