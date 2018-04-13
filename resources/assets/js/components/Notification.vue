<script>
    import Noty from 'noty';

    export default {
        props: ['id'],
        mounted() {
            this.listen()
        },
        methods: {

            listen() {
            Echo.private('App.User.' + this.id)
                .notification((notification) => {
                new Noty({
                    layout: 'bottomLeft',
                    type: 'info',
                    text: notification.message,
                }).show()
                    document.getElementById('noty_audio').play()
                    this.$store.commit('ADD_NOTE', notification)
                console.log(notification)
                })
            },
        }
    }
</script>
<template>
</template>
