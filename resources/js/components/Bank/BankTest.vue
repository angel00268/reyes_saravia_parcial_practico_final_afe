<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <div v-if="$can('user read')" >Permiso concedido.</div>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="bank.id" />
          </div>
          <div class="col-md-4 pt-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" type="text" v-model="bank.name_bank" />
            <div v-if="errors && errors.name_bank" class="text-danger">{{ errors.name_bank[0] }}</div>
          </div>
          <div class="col-md-12 pt-3">
            <a href="#" style="background-color: #63B4B8"
                        class="btn mr-2 my-2 text-white" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
          </div>

          <!-- Table -->
          <bank-table
            :data="banks"
            :headers="headers"
            @delete="deleteP($event)"
            @edit="edit($event)"
          />
        </div>
      </template>
      <template v-else>
        <alert />
      </template>
    </div>
  </div>
</template>

<script>
import ui from "../../libs/ui";
import Swal from "sweetalert2";

export default {
  data: () => {
    return {
      bank: {
        name_bank: "",
      },
      banks: [],
      grades: [],
      headers: ["#", "Nombre","Acciones"],
      textButton: "Guardar",
      loading: false,
      errors: {},
      allerrors: []
    };
  },

  mounted() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;

      let res = await axios.get("api/bank");
      this.banks = res.data.banks;
      this.loading = false;
      this.errors = {};
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/bank", this.bank).catch((e) => {
              if (e.response.status === 422) {
                this.errors = e.response.data.errors;
              }
          });

          if (res.data.message == "success") {
            this.banks = res.data.banks;
            ui.alert("Registro creado correctamente.");
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/bank/${this.bank.id}`, this.bank)
            .catch((e) => {
              ui.alert(
                "Registro no pudo ser actualizado correctamente.",
                "error"
              );
            });

          if (res.data.message == "success") {
            ui.alert("Registro modificado correctamente.");
          }
          break;
      }
      this.initialize();
      this.cleanInputs();
    },

    edit(id) {
      this.bank = this.banks.find((bank) => bank.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      Swal.fire({
        title: "¿Estás seguro de eliminar este registro?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Confimar",
      }).then(async (result) => {
        if (result.isConfirmed) {
          const res = await axios.delete(`api/bank/${id}`).catch((e) => {
            ui.alert("Registro no pudo ser eliminado correctamente.", "error");
          });

          if (res.data.message == "success") {
            ui.alert("Registro eliminado correctamente.");
            this.initialize();
            this.cleanInputs();
          }
        }
      });
    },

    cleanInputs() {
      this.bank = {
        name_bank: "",
        account_number: "",
        initial_amount: "0.00",
      };
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
