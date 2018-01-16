<template>

          <div>
                <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add friend</button>
                <button class="btn btn-success" v-if="status == 'pending'">Accept friend</button>
                <span class="text-success" v-if="status == 'waiting'">waiting for response</span>
                 <span class="text-success" v-if="status == 'friends'">Friends</span>
           </div> 

</template>

<script>
    export default {
        mounted() {
            axios.get('/check_relationship/' + this.profile_user_id)

            .then( (resp) => {
                console.log(resp)

                this.status = resp.data.status
            })
        },

        props: ['profile_user_id'],

        data()
        {
            return {
                status: '',
                loading: true
            }
        },

        methods:
        {
            add_friend(){
                axios.get('add_friend' + this.profile_user_id)

                .then((r) => {
                    if(this.data == 1)
                        this.status = 'waiting'
                })
            }
        }
    }
</script>
