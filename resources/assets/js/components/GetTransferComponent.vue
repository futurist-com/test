<template>
    <div >
        <div class="panel panel-default">
      <div class="panel-heading">Список ваших неподтвержденных  переводов</div>
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
    var app = this;
    this.$root.$on("onSubmitForm", (resp)=> {
      this.getTransfer();
    });
    //var app = this;
    this.getTransfer();
  },
  methods: {
    deleteEntry(id, index) {
      if (confirm("Вы действительно хотите удалить перевод?")) {
        var app = this;
        axios
          .delete("/api/transfer/" + id)
          .then((resp)=> {
            //app.transfers = resp.data;
            this.getTransfer();
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
          .put("/api/transfer/" + id)
          .then((resp)=> {
            //this.transfers = resp.data;
             this.getTransfer();
             this.$root.$emit("onUpdateBalance", resp);
          })
          .catch(function(resp) {
          if(resp.response.status == 401)
            alert(
              "Не удалось подтвердить перевод. У вас не достаточно средств"
            );
          });
      }
      },
      getTransfer(){
      axios.get("/api/transfer")
      .then((resp)=> {
        this.transfers = resp.data;
      })
      .catch(function(resp) {});
      }
  }
};
</script>
