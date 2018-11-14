<template>
    <div>
    <div class="panel panel-primary">
            <div class="panel-heading" id="accordion">
                <span class="glyphicon glyphicon-comment"></span> {{ group.name }}
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-default btn-xs" @click.prevent="setMessagesAtBottom()" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne" :href="'#collapseOne-' + group.id">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne" :href="'#menu-' + group.id">
                        <span class="options"></span>
                    </a>
                </div>
            </div>
            
            <div class="panel-collapse collapse" :id="'menu-' + group.id">
                <ul style="list-style-type:none">
                    <li v-if= group_owner><a :href="'/delete_group/'+ group_id">Delete group</a></li>
                    <li v-if= group_owner><a>Add more members</a></li>
                    <li v-if= group_owner><a>Delete members</a></li>
                    <li v-if= !group_owner><a>Leave</a></li>
                </ul>
            </div>

            
            <div class="panel-collapse collapse" :id="'collapseOne-' + group.id">
                <div class="panel-body chat-panel scroll scroll-chat" id="chatBox">
                    <ul style="list-style-type:none" class="chat">
                        <li v-for="conversation in conversations" :key="conversation.id">
                            <span class="chat-img pull-left">
                                <img v-if= conversation.user_picture :src= "'data:conversation.user_picture_type;base64,'+conversation.user_picture" width="50" height="50" alt="User Avatar" class="img-circle" />

                                <img v-else src="/images/blankProfile.png" width="50" height="50" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong v-if= conversation.name class="primary-font" >{{  conversation.name }}</strong>

                                    <strong v-else class="primary-font" >{{  conversation.user.name }}</strong>
                                </div>
                                <p>
                                    {{ conversation.message }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="message" @keyup.enter="store()" autofocus />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat" @click.prevent="store()">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['group'],

        data() {
            return {
                conversations: [],
                message: '',
                group_id: this.group.id,
                group_owner: ""
            }
        },

        mounted() {
            this.listenForNewMessage();

            this.getMessage();  
            
            this.getOwner();          
        },

        methods: {
            store() {
                axios.post('/conversations', {message: this.message, group_id: this.group.id})
                .then((response) => {
                    console.log(this.conversations);                   
                    this.message = '';
                    this.conversations.push(response.data);
                });
            },
            getMessage() {
                axios.get('/conversation/' + this.group.id, {message: this.message, group_id: this.group.id})
                .then((response) => {
                    console.log(response.data);
                    this.message = '';
                    for (var key in response.data) {
                            //alert(response.data[key]);
                            
                            
                            this.conversations.push(response.data[key]);
                        };
                    //console.log(this.group_id);  
                });
                /*$.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/conversation',
                    dataType : 'json',
                    type: 'GET',
                    data: {group_id: this.group.id},
                    contentType: false,
                    processData: false,
                    success:function(response) {
                        console.log(response);
                        
                        for (var data in response) {
                            alert(this.conversations);
                            
                            
                            //this.conversations.push(data);
                        };
                        
                    }
                });*/
            },
            setMessagesAtBottom(){
                var messageBody = document.getElementById('chatBox');
                if (messageBody.scrollHeight === 0) {
                    messageBody.scrollTop = 314;
                } else {
                    messageBody.scrollTop = messageBody.scrollHeight;
                }                
            },

            getOwner() {
                axios.get('/getOwner/' + this.group.id )
                .then((response) => {
                    this.group_owner = response.data[0].user_id;                    
                });
            },

            listenForNewMessage() {
                Echo.private('groups.' + this.group.id)
                    .listen('NewMessage', (e) => {
                        //console.log(e);
                        this.conversations.push(e);
                    });
            }
        }
    }
</script>
