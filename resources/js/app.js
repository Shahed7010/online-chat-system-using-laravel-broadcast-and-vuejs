/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
//vue toaster
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
//for auto scroll
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat-component', require('./components/ChatComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data(){
        return{
            message:'',
            chat:{
                message:[],
                user:[],
                color:[],
                time:[],
            },
            typing:'',
            activeNow:0,
        }
    },
    methods:{
        send(){
            if (this.message.length > 0){
                axios.post('/send',{
                    message: this.message
                }).then(response => {
                    console.log(response)
                }).catch(error =>{
                    console.log(error)
                });
                // console.log(this.message)
                this.chat.message.push(this.message)
                this.chat.user.push('you')
                this.chat.color.push('success')
                this.chat.time.push(this.getTime())
                this.message=''
            }
        },
        getTime(){
            let time = new Date();
            return ' at '+time.toLocaleTimeString()
        }
    },
    watch:{
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }

    },
    mounted(){
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message)
                this.chat.user.push(e.user)
                this.chat.color.push('warning')
                this.chat.time.push(this.getTime())
                // console.log(e);
            })
            .listenForWhisper('typing', (e) => {
                if (e.name != ''){
                    this.typing = 'typing...'
                }else {
                    this.typing =''
                }
            })
        Echo.join(`chat`)
            .here((users) => {
                this.activeNow = users.length
            })
            .joining((user) => {
                this.activeNow += 1;
                this.$toaster.success(user.name+' Just Join to Chat Room')

            })
            .leaving((user) => {
                this.activeNow -= 1;
                this.$toaster.warning(user.name+' Just Leave to Chat Room')
            });
    }
});
