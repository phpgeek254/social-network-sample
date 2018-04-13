<script>
    export default {
      mounted(){

      },
        data() {
            return {
                post: '',
                not_working: true
            }
        },

        watch: {
          post() {
              if(this.post.length > 0)
                  this.not_working = false
              else
                  this.not_working = true
          }
        },
        methods: {
            create_post(){
                    axios.post('/post', {content: this.post}).then(response => {
                      console.log(response.data);
                        this.$store.commit('ADD_POST', response.data)
                            this.post = ''
                            new Noty({
                                layout: 'bottomLeft',
                                type: 'info',
                                text: 'Post Published',
                            }).show()
                    })
                }
            },
    }

</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> <h3>Your Wall</h3> </div>

                    <div class="panel-body">
                        <h4> Create Post</h4>
                        <textarea class="form-control"
                                  v-model="post">

                        </textarea> <br>

                        <button
                                :disabled="not_working"
                                @click="create_post()" class="btn btn-success pull-right">
                            Create Post
                             </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

</style>
