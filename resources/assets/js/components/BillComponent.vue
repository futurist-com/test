<template>
    <div class="container">
                    <div class="card-header">На вашем счете {{bill['balance']}} р</div>
    </div>
</template>

<script>
export default {
  data: function() {
    return {
      bill: []
    };
  },
  mounted() {
    this.$root.$on("onUpdateBalance", (resp)=> {
      this.updateBill();
    });
    this.updateBill();
  }, 
   methods:{
     updateBill(){
       axios
      .get("/api/bill")
      .then((resp)=> {
        this.bill= resp.data;
      })
      .catch(function(resp) {
        alert("Не удалось загрузить данные о счете");
      });
     }
   }
};
</script>
