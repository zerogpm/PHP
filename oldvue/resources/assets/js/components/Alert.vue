<template>
    <div :class="alertClasses" v-show="show">
        <slot></slot>
        <span class="Alert__close" @click="show = false">X</span>
    </div>
</template>


<script>
    export default {
        props:['type'],
        data() {
            return {
               show: true
            };
        },
        computed: {
            alertClasses() {
                var type = this.type;

                return {
                    'Alert' : true,
                    'Alert--Success' : type == 'success',
                    'Alert--Error' : type == 'error'
                };
            }
        }
    };
</script>

<style lang="stylus">
.Alert
  position: relative
  background: #ddd
  border: 1px solid darken(#ddd, 10%)
  padding: 1em

.Alert--Success
  background: lighten(green, 70%)
  border: 1px solid lighten(green, 30%)

.Alert--Error
  background: lighten(red, 70%)
  border: 1px solid lighten(red, 30%)

.Alert__close
  position: absolute
  top: 1em
  right: 1em
  font-weight: bold
  cursor: pointer
</style>