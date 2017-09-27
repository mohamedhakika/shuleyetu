<template>
    <div class="alert alert-success col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 alert-flash" role="alert" v-show="show">
        <p>
        <strong> Success - </strong> {{ body }}
        </p>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data(){
            return{
                body: '',
                show: false
            }
        },

        created() {
            if(this.message){
                this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });
        },

        methods: {
            flash(message){
                this.body = this.message;
                this.show = true;

                this.hide();
            },
            hide(){
                setTimeout(() => {
                   this.show = false;
                }, 5000);
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        z-index: 999;
        margin-top: 4%;
        top: 0;
    }
</style>
