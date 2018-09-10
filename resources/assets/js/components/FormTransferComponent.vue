<template>
     <div class="panel panel-default">
        <div class="panel-body">
             <form v-on:submit="saveForm()">
             <div class="row">
                <div class="col-xs-12 form-group">
                  <label class="control-label">Номер пользователя</label>
                  <input type="text" v-model="transfer.user_id" class="form-control">
                  <ul>
                  <li v-for="error in errors.get('user_id')">{{ error }}</li>
                  </ul>
                
                 
                
                </div>
                
                 <div class="col-xs-12 form-group">
                    <label class="control-label">Сумма</label>
                    <input type="text" v-model="transfer.summ"  class="form-control" >
                    <ul>
                  <li v-for="error in errors.get('summ')">{{ error }}</li>
                  </ul>
                 </div>
                           
                 <div class="col-xs-12 form-group">
                    <label class="control-label"> </label>
                    <button class="btn btn-success">Перевести</button>
                 </div>
              </div>
             </form>
        </div>
        <hr>
    </div>
</template>

<script>
class Errors {
  constructor() {
    this.errors = {};
  }
  get(field) {
    if (this.errors[field]) {
      //console.log(this.errors[field]);
      return this.errors[field];
    }
  }

  record(errors) {
    this.errors = errors.errors;
    console.log(this.errors);
  }
}

export default {
  data: function() {
    return {
      transfer: {
        user_id: null,
        summ: null
      },
      errors: new Errors()
      //errors:[]
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    saveForm() {
      event.preventDefault();
      var app = this;
      var newTransfer = app.transfer;
      axios
        .post("/api/transfer", newTransfer)
        .then(function(resp) {
          //console.log(resp);
          app.$root.$emit('onSubmitForm', resp);
          //app.$router.push({path: '/'});
        })
        .catch(error => {
          this.errors.record(error.response.data);
        });
    }
  }
};
</script>
