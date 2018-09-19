<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="noty" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-lg"></i>
            <sup>
                <span class="badge badge-pill badge-danger bg-danger text-white">{{ all_nots_count }}</span>
            </sup>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="noty">
            <div class="py-2 pl-3 border-bottom">
                <h6>Notifications</h6>
            </div>
            <div id="notifications" class="list-group list-group-flush">
                <a v-for="not in notifications" href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <small>{{ not.created_at }}</small>
                    </div>
                    <div class="mb-1">
                        <strong>{{ not.name }}</strong> {{ not.message }}
                    </div>
                    <small>Donec id elit non mi porta.</small>
                </a>
            </div>
            <div class="py-2 text-center border-top">
                <a href="#">View all</a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        mounted() {
            this.get_unread(),
            this.get_notifications()
        },
        methods: {
            get_unread() {
                axios.get('/get_unread')
                    .then((notification) => {
                        notification.data.forEach((notification) => {
                            this.$store.commit('add_not', notification)
                        })
                    })
            },
            get_notifications() {
                axios.get('/get_notifications')
                    .then((response) => {
                        response.data.forEach((response) => {
                            this.$store.commit('add_notification', response.data)
                        })
                    });
            }
        },
        computed: {
            all_nots_count() {
                return this.$store.getters.all_nots_count
            },
            notifications() {
                return this.$store.getters.all_notifications
            }
        }
    }
</script>
