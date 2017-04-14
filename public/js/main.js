Vue.component('wt-notification', {
    props: ['type'],
    
    template: `
    <div class="notification" v-show="isVisible">
        <button class="delete" @click="isVisible = false"></button>
        <slot></slot>
    </div>
    `,
    data: function () {
        return {
            isVisible: true
        };
    }
    
});

var app = new Vue({
  el: '#app',
  
  data: {
    message: 'Hello Vue!'
  }, 
  
})