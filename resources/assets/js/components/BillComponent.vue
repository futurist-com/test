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
    var app = this;
    axios
      .get("/api/bill")
      .then(function(resp) {
        app.bill = resp.data;
        console.log(app);
      })
      .catch(function(resp) {
        console.log(resp);
        alert("Не удалось загрузить данные о счете");
      });
  }
};
</script>
