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
    message: '',
    clear: false
  }, 
  
  mounted: function () {
    this.clear = store.get('clear');  
    this.message = store.get('message');
    
    this.clearText();
  },
  
  methods: {
      saveText: function(e) {
          this.message = e.target.value;
          store.set('message', this.message);
      },
      setClear: function() {
        store.set('clear',true); 
        this.clear = true;
      },
      clearText: function() {
        if(this.clear) {
            store.set('message', '');
            this.message = '';
            store.set('clear',false);
            this.clear = false;
        }
        else {
            this.clear = false;
        }
      },
      confirmDelete: function(e) {
        console.log('delete');
        var answer = confirm('Are you sure you want to delete this?');
        
        if(! answer) {
          e.preventDefault();
        }
        
      }
  }
  
})