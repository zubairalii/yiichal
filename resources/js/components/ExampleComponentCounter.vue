<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: {
            user: {},
        },
        mounted() {
            console.log('Counter mounted.');    
          //  console.log(this.$userId)   
            this.getUserId();
            this.listen();   
            
           
        },
        methods: {
            getUserId() {
                axios.get('/getUserId').then( (res) => {
                    console.log(res);
                    this.user = res;
                    this.listenToYours(); 
                });
            },
            listen() {
                console.log('event listen');
                Echo.channel('newtest')
                    .listen('sendCounter', (eve) => {
                        console.log(eve);
                        
                    });
            },

            listenToYours() {
                console.log('event listen yours');
                // Echo.private('user.'+this.user.data.id)
                //     .listen('sendSpecific', (eve) => {
                //         console.log(eve);
                //     });
            }
        },
    }
</script>
