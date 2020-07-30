<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <button @click.prevent = "sendNotification()">Send Notification </button>
                    </div>
                     <div class="card-body">
                        <button @click.prevent = "sendNotificationSpecific(3)">Send Notification To Waqas</button>
                    </div>
                     <div class="card-body">
                        <button @click.prevent = "sendNotificationSpecific(1)">Send Notification To Alan</button>
                    </div>
                    <div class="card-body">
                        <button @click.prevent = "sendNotificationSpecific(2)">Send Notification To Sara</button>
                    </div>
                     <div class="card-body">
                        <button @click.prevent = "sendNotificationSpecific(4)">Send Notification Wiki</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            
            Echo.join(`test`)
            .here((users) => {
                //
                console.log('here');
            })
            .joining((user) => {
                console.log('joining');
                console.log(user.name);
                
            })
            .leaving((user) => {
                console.log('leaving');
                console.log(user.name);
            });
        },
        methods: {
            sendNotification() {
                let url = 'sendCounter'
                axios.get(url).then( (response) => {
                    console.log(response);
                    console.log('response received');
                });
            },
            sendNotificationSpecific(id) {
                let url = 'sendToSpecific/'+id;
                axios.get(url).then( (response) => {
                    console.log(response);
                    console.log('response received');
                });
            },
        }
    }
</script>
