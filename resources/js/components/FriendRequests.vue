<template>

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="glyphicon glyphicon-user"></span>
            <span class="badge" v-if="friendReqs.length">{{ friendReqs.length }}</span>
        </a>

        <ul class="dropdown-menu" v-if="friendReqs.length">
            <li v-for="friendReq in friendReqs" :key="friendReq.id">
                <div class="container">
                    <div class="col-sm-6" >
                        {{ friendReq.name}}
                    </div>
                    <div class="col-sm-4">
                        <a :href="'acceptFriendReq/' + friendReq.id" ><button type="button" class="btn btn-success">Add friend</button></a> 
                        <a :href="'deleteFriendReq/' + friendReq.id" ><button type="button" class="btn btn-success">Decline</button></a> 
                    </div>             
                </div>
            </li>
        </ul>
        <ul class="dropdown-menu" v-else>
            <li>
                <div class="container">
                    <div class="col-sm-6" >
                        Nothing to show
                    </div>
                </div>
            </li>
        </ul>
        <audio id="myAudio">
            <source src="sounds/exquisite.ogg" type="audio/mpeg">
            <source src="sounds/exquisite.m4r" type="audio/mpeg">
            <source src="sounds/exquisite.mp3" type="audio/mpeg">
        </audio>
        
    </li>
    

</template>

<script>
    export default {
        props: ['reqs'],

        authEndpoint: "broadcasting/auth",

        data() {
            return {
                friendReqs: [],
                user_id: document.getElementById('user_id').value
            }
        },

        mounted() {

            this.getReqs();

            this.listenForRequests();
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
            )},

            listenForRequests() {
                Echo.private("Requests." + this.user_id)
                    .listen('NewRequest', (e) => {
                        //console.log(e);
                        //alert(e[1].name);
                        this.friendReqs.push(e);
                        var audio = document.getElementById("myAudio");
                        audio.play();                        
                    });
            }
        }
    }
</script>

