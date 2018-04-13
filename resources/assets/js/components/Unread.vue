<script>
    export default {
        mounted() {
            this.get_unread();
        },
        computed: {
            count_notifications(){
                return this.$store.getters.count_notifications
            }
        },
        methods: {
            get_unread() {
                axios.get('/get_unread').then(response => {
                    console.log(response.data)
                    response.data.forEach((note) => {
                        this.$store.commit('ADD_NOTE', note)
                    })
                })
            }
        }
    }
</script>

<template>
    <li>
        <a href="/notifications">
            Unread Notifications
            <span class="badge"> {{ count_notifications }} </span>
        </a>
    </li>
</template>

<style>

</style>