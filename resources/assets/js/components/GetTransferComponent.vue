<template>
    <div class="container">
   
 
  <div class="panel panel-default">
   <div class="panel-heading">Список ваших переводов</div>
   <div class="panel-body">
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Кому Перевод</th>
       <th>Сумма</th>
       <th>Статус</th>
       
       <th width="100">&nbsp;</th>
       <th width="100">&nbsp;</th>
      </tr>
     </thead>
     <tbody>
     <tr v-for="transfer, index in transfers">
       <td>{{ transfer.name }}</td>
       <td>{{ transfer.summ }} р.</td>
       <td v-if="transfer.status==1">Выполненно</td>
       <td v-if="transfer.status==0">Не выполненно</td>
        <td v-if="transfer.status==0">
        <a href="#"
                class="btn btn-xs btn-danger"
                v-on:click="deleteEntry(transfer.id, index)">
       Удалить
      </a></td>
      <td v-if="transfer.status==0">
        <a href="#"
                class="btn btn-xs btn-success"
                v-on:click="updateEntry(transfer.id, index)">
       Подтвердить
      </a></td>

     </tr>
    </tbody>
   </table>
   </div>
 </div>       
    </div>
</template>

<script>
export default {
  data: function() {
    return {
      transfers: []
    };
  },
  mounted() {
    this.$root.$on('onSubmitForm', function (resp) {
      var app = this;
      axios
      .get("/api/gettransfer")
      .then(function(resp) {
        app.transfers = resp.data;
        //console.log(app);
      })
      .catch(function(resp) {});
      });
    var app = this;
    axios
      .get("/api/gettransfer")
      .then(function(resp) {
        app.transfers = resp.data;
        //console.log(app);
      })
      .catch(function(resp) {});
  },
  methods: {
    deleteEntry(id, index) {
      if (confirm("Вы действительно хотите удалить перевод?")) {
        var app = this;
        axios
          .delete("/api/gettransferdel/" + id)
          .then(function(resp) {
            app.transfers = resp.data;
          })
          .catch(function(resp) {
            alert("Не удалось удалить перевод");
          });
      }
    },
    updateEntry(id, index) {
      if (confirm("Вы действительно хотите подтвердить перевод?")) {
        var app = this;
        axios
          .put("/api/gettransferput/" + id)
          .then(function(resp) {
            app.transfers = resp.data;
            //app.transfers.splice(index, 1);
          })
          .catch(function(resp) {
            alert("Не удалось подтвердить перевод. Скорее всего у вас не достаточно средств");
          });
      }
      /*var app = this;
    axios
      .get("/api/gettransfer")
      .then(function(resp) {
        app.transfers = resp.data;
        console.log(app);
      })
      .catch(function(resp) {});*/
    }
  }
};
</script>
