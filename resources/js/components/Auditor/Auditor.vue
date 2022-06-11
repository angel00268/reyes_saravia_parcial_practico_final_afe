<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <div class="row">
                    <!-- Form -->
                    <div class="col-md-6 d-none">
                        <input class="form-control" type="text" v-model="auditor.id" />
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" v-model="auditor.name" />
                        <div v-if="errors && errors.name" class="text-danger">
                            {{ errors.name[0] }}
                        </div>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Correo electrónico</label>
                        <input class="form-control" type="email" v-model="auditor.email" />
                        <div v-if="errors && errors.email" class="text-danger">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Contraseña</label>
                        <input class="form-control" type="password" v-model="auditor.password" />
                        <div v-if="errors && errors.password" class="text-danger">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="col-md-6 pt-3">
                        <label class="form-label">Confirmación Contraseña</label>
                        <input class="form-control" type="password" v-model="auditor.password_confirmation" />
                        <div v-if="errors && errors.password_confirmation" class="text-danger">
                            {{ errors.password_confirmation[0] }}
                        </div>
                    </div>
                    <div class="col-md-12 pt-3">
                        <a href="#" style="background-color: #63b4b8" class="btn mr-2 my-2 text-white" @click="save()">
                            <i class="fa fa-save"></i> {{ textButton }}</a>
                    </div>

                    <!-- Table -->
                    <auditor-table :data="auditors" :headers="headers" />
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
            auditor: {
                name: "",
                email: "",
            },
            auditors: [],
            headers: ["#", "Nombre", "Correo electrónico"],
            textButton: "Guardar",
            loading: false,
            errors: {},
        };
    },

    mounted() {
        this.initialize();
    },

    methods: {
        async initialize() {
            this.loading = true;

            let res = await axios.get("api/auditores");
            this.auditors = res.data.auditors;
            this.loading = false;
            this.errors = {};
        },

        async save() {
            let res;
            switch (this.textButton) {
                case "Guardar":
                    res = await axios.post("api/auditores", this.auditor).catch((e) => {
                        if (e.response.status === 422) {
                            this.errors = e.response.data.errors;
                        }
                    });

                    if (res.data.message == "success") {
                        this.auditors = res.data.auditors;
                        ui.alert("Registro creado correctamente.");
                    }
                    break;
                case "Modificar":
                    res = await axios
                        .put(`api/auditor/${this.auditor.id}`, this.auditor)
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
            this.auditor = this.auditors.find((auditor) => auditor.id == id);
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
                    const res = await axios.delete(`api/auditor/${id}`).catch((e) => {
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
            this.auditor = {
                name: "",
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
