<template>

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span>
            <span class="badge">{{ friendReqs.length }}</span>
        </a>

        <ul class="dropdown-menu">
            <li v-for="friendReq in friendReqs" :key="friendReq.id">
                <div class="container">
                    <div class="col-sm-6" >
                        {{ friendReq.name}}
                    </div>
                    <div class="col-sm-4">
                        <a :href="'acceptFriendReq/' + friendReq.id" ><button type="button" class="btn btn-success">Add friend</button></a> 
                    </div>             
                </div>
            </li>
        </ul>
    </li>
    
    
</template>

<script>
    export default {
        props: ['reqs'],

        data() {
            return {
                friendReqs: []
            }
        },

        mounted() {
            //this.listenForReq();

            this.getReqs();
        },

        methods: {
            getReqs(){
                axios.get('/fetchReqs')
                .then((response) => {
                    //console.log(response.data);                    
                    for (var key in response.data) {
                            //alert(response.data[key]);
                            
                            
                            this.friendReqs.push(response.data[key]);
                    };
                }
            )}
        }
    }
</script>

