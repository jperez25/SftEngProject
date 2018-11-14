<template>
    <div>
        <group-chat v-for="group in groups" :group="group" :key="group.id" :id="group.id"></group-chat>
    </div>
</template>

<script>
    export default {
        props: ['initialGroups', 'user'],

        data() {
            return {
                groups: [],
                
            }
        },

        mounted() {
            this.groups = this.initialGroups;

            Bus.$on('groupCreated', (group) => {
                this.groups.push(group);
            });

            this.listenForNewGroups();
            this.listenForDeletedGroups();
        },

        methods: {
            listenForNewGroups() {
                Echo.private('users.' + this.user.id)
                    .listen('GroupCreated', (e) => {
                        this.groups.push(e);
                        //console.log(e);
                    });
            },

            listenForDeletedGroups() {
                Echo.private('users.' + this.user.id)
                    .listen('GroupDeleted', (e) => {
                        this.groups.push(e);
                        //console.log(e);
                    });
            },
        }
    }
</script>