<template lang="html">

</template>


<script>
    export default {
        mounted(){
        this.get_auth_user()
        },
        methods: {
            get_auth_user(){
                axios.get('/auth_user').then(resp => {
                    this.$store.commit('AUTH_USER', resp.data)
                })
            }
        }
    }
</script>
