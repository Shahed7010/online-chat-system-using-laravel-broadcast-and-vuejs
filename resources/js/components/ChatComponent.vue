<template>
    <div>
        <div :class="user === 'you' ? 'float-right' : 'float-left'">
        <li class="list-group-item" :class="colorClass"><slot></slot></li>
        <small class="badge badge-secondary float-right">{{user}}, {{time}}</small>
        </div>
        <div>{{activeUsers}}</div>
    </div>
</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time',
            'activeUsers'
        ],
        computed:{
          colorClass(){
              return 'list-group-item-'+this.color
          }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
