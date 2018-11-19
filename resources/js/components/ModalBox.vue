<template>
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{title}}</h5>
                <button type="button" class="close" @click="$emit('close')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
                <form v-if="displaySelect">
                    <div v-if="action === 'add_members'" class="form-group">
                        <select v-if="friends.length > 0" multiple id="friends" v-model="selected_friends" @change="getSelectedFriends()">
                            <option v-for="user in friends" :value="user.id" :key="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <div v-else>
                            <p>
                                You have no friends
                            </p>
                        </div>
                    </div>
                     <div v-if="action === 'delete_members'" class="form-group">
                        <select v-if="membersOfGroup.length > 0" multiple id="members" v-model="selected_friends" @change="getSelectedFriends()">
                            <option v-for="user in membersOfGroup" :value="user.id" :key="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                        <div v-else>
                            <p>
                                You are the only one in this group
                            </p>
                        </div>
                    </div>
                </form>
                <p v-else>{{body_text}}</p>
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">Close</button>
                <button v-if="action === 'delete_group'" type="submit"  @click.prevent="deleteGroup()" class="btn btn-primary">Yes!</button>
                <button v-if="action === 'add_members'" type="submit"  @click.prevent="add_members()" class="btn btn-primary">Save Changes</button>
                <button v-if="action === 'delete_members'" type="submit"  @click.prevent="deleteGroupMembers()" class="btn btn-primary">Confirm</button>
            </slot>
          </div>
        </div>
      </div>
    </div>   
</template>

<script>
    export default {
        props: ['group_id', 'title', 'displaySelect', 'body_text', 'action'],

        data() {
            return {
                friends: [],
                membersOfGroup: [],

                selected_friends: [],
            }              
        },

        mounted() {
            this.getFriends();

            this.getMembersOfGroup();
        },

        methods: {
            getFriends() {
                axios.get('/getFriends', {group_id: this.group_id})
                .then((response) => {
                    //console.log(response.data);
                    this.friends = [];
                    for (var key in response.data) {
                            //alert(response.data[key]);
                            console.log(response.data[key]);
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
                            this.membersOfGroup.push(response.data[key]);
                    }
                });
            },
            getSelectedFriends(){
                //console.log(this.selected_friends);
            },
            add_members() {
                axios.post('/addFriends', {group_id: this.group_id, friends: this.selected_friends})
                .then((response) => {
                    location.reload(true);
                });
            },
             deleteGroupMembers() {
                axios.post('/deleteGroupMembers', {group_id: this.group_id, friends: this.selected_friends})
                .then((response) => {
                        //console.log(response);
                        location.reload(true);
                });
            },
            deleteGroup() {
                axios.post('/delete_group/' + this.group_id)
                .then((response) => {
                    //console.log(this.group_id); 
                    //console.log(response.data);
                    location.reload(true);          
                });
            },
            
        }
    }
</script>
