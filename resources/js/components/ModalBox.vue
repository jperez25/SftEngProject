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
                    <div class="form-group">
                        <select multiple id="Members">
                            <option v-for="user in membersOfGroup" :value="user.id" :key="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                </form>
                <p v-else>{{body_text}}</p>
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">Close</button>
                <button v-if="action === 'delete_group'" type="submit"  @click.prevent="deleteGroup()" class="btn btn-primary">Yes!</button>
                <button v-if="action === 'add_members'" type="submit"  @click.prevent="deleteGroupMembers()" class="btn btn-primary">Save Changes</button>
                <button v-if="action === 'delete_members'" type="submit"  @click.prevent="deleteGroupMembers()" class="btn btn-primary">Save Changes</button>
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
            }              
        },

        mounted() {
            this.getFriends();

            this.getMembersOfGroup();
        },

        methods: {
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
            deleteGroup() {
                axios.post('/delete_group/' + this.group_id)
                .then((response) => {
                    console.log(this.group_id); 
                    console.log(response.data);
                    //location.reload(true);          
                });
            },
            
        }
    }
</script>
