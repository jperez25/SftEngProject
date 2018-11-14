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
                    <li v-if= "group_owner == current_user"><a :href="'/delete_group/'+ group_id" onclick="return confirm('Are you sure you want to delete this group?');">Delete group</a></li>
                    <li v-if= "group_owner == current_user"><a data-toggle="modal" data-target="#exampleModalCenter"  @click.prevent="getFriends()">Add more members</a></li>
                    <li v-if= "group_owner == current_user"><a data-toggle="modal" data-target="#Delete_Friends" @click.prevent="getMembersOfGroup()">Delete members</a></li>
                    <li v-if= "group_owner != current_user"><a>Leave</a></li>
                </ul>
            </div>

            <!-- Modal for Add friends -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add more friends to this group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <select multiple id="friends">
                                    <option v-for="user in friends" :value="user.id" :key="user.id">
                                        {{ user.name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" @click.prevent="addFriends()" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Delete Friends -->
            <div class="modal fade" id="Delete_Friends" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Members of this Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <select multiple id="Members">
                                    <option v-for="user in membersOfGroup" :value="user.id" :key="user.id">
                                        {{ user.name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  @click.prevent="deleteGroupMemebers()" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
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
        props: ['group',],

        data() {
            return {
                conversations: [],
                friends: [],
                membersOfGroup: [],
                message: '',
                group_id: this.group.id,
                group_owner: "",
                current_user: "",
            }
        },

        mounted() {
            this.listenForNewMessage();

            this.getMessage();  
            
            this.getOwner();   
            
            this.getUser();
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
            getUser() {
                axios.get('/getCurrentUser' )
                .then((response) => {                    
                    this.current_user = response.data.id;                    
                });
            },
            getFriends() {
                axios.get('/getFriends')
                .then((response) => {
                    //console.log(response.data);
                    this.friends = [];
                    for (var key in response.data) {
                            //alert(response.data[key]);
                            this.friends.push(response.data[key]);
                    }
                });
            },
            getMembersOfGroup() {
                axios.get('/getMembersOfGroup/' + this.group_id)
                .then((response) => {
                    //console.log(response.data);
                    this.membersOfGroup = [];
                    for (var key in response.data) {
                            //alert(response.data[key]);
                            //console.log(response.data[key]);
                            this.membersOfGroup.push(response.data[key]);
                    }
                });
            },
            addFriends() {
                axios.post('/addFriends', {group_id: this.group_id, friends: this.friends})
                .then((response) => {
                                       
                });
            },
             deleteGroupMembers() {
                axios.post('/deleteGroupMembers', {group_id: this.group_id, friends: this.friends})
                .then((response) => {
                                       
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
