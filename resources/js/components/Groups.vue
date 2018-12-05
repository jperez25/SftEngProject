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
            Bus.$on('groupDeleted', (group) => {
                this.groups.splice(group, 1);
            });

            this.listenForNewGroups();
            this.listenForDeletedGroups();
        },

        methods: {
            listenForNewGroups() {
                Echo.private('users.' + this.user.id)
                    .listen('GroupCreated', (e) => {
                        this.groups.push(e);
                    });
            },

            listenForDeletedGroups() {
                Echo.private('users.' + this.user.id)
                    .listen('GroupDeleted', (e) => {
                        //console.log(e);
                        this.groups.splice(e, 1);
                    });
            },
        }
    }
</script>