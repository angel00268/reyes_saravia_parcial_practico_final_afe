<template>
    <div>
        <div class="container">
            <template v-if="!loading">
                <template v-if="!showOpen">
                    <div class="row">
                        <!-- Form -->
                        <div class="col-md-6 d-none">
                            <input class="form-control" type="text" v-model="product.id" />
                        </div>
                        <div class="col-md-6 pt-3">
                            <label>Nombre del producto</label>
                            <input class="form-control" type="text" v-model="product.product_name" />
                            <div v-if="errors && errors.product_name" class="text-danger">
                                {{ errors.product_name[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <label>Precio unitario del producto</label>
                            <input class="form-control" type="number" step="0.01" v-model="product.unit_price" />
                            <div v-if="errors && errors.unit_price" class="text-danger">
                                {{ errors.unit_price[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <label>Existencia del producto</label>
                            <input class="form-control" type="number" v-model="product.stock" />
                            <div v-if="errors && errors.stock" class="text-danger">
                                {{ errors.stock[0] }}
                            </div>
                        </div>
                        <div class="col-md-6 pt-3">
                            <label>Garantía del producto</label>
                            <input class="form-control" type="text" v-model="product.warranty" />
                            <div v-if="errors && errors.warranty" class="text-danger">
                                {{ errors.warranty[0] }}
                            </div>
                        </div>
                        <div class="col-md-12 pt-3">
                            <label>Descripción del producto</label>
                            <textarea cols="1" class="form-control" v-model="product.product_description" />
                            <div v-if="errors && errors.product_description" class="text-danger">
                                {{ errors.product_description[0] }}
                            </div>
                        </div>
                        <div class="col-md-12 pt-3">
                            <a href="#" style="background-color: #63b4b8" class="btn mr-2 my-2 text-white"
                                @click="save()">
                                <i class="fa fa-save"></i> {{ textButton }}</a>
                        </div>

                        <!-- Table -->
                        <product-table :data="products" :headers="headers" @delete="deleteP($event)"
                            @edit="edit($event)" @showProduct="showProduct($event)" />
                    </div>
                </template>
                <template v-else>
                    <show-product :data="product" @showClose="showClose()"/>
                </template>
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
            product: {
                product_name: "",
                unit_price: "0.00",
                stock: "",
                warranty: "",
                product_description: ""
            },
            products: [],
            headers: ["#", "Nombre", "Precio", "Stock", "Garantía", "Descripción", "Acciones"],
            textButton: "Guardar",
            loading: false,
            showOpen: false,
            errors: {},
        };
    },

    mounted() {
        this.initialize();
    },

    methods: {
        async initialize() {
            this.loading = true;
            let res = await axios.get("api/productos");
            this.products = res.data.products;
            this.loading = false;
            this.showOpen = false;
            this.errors = {};
        },

        async save() {
            let res;
            switch (this.textButton) {
                case "Guardar":
                    res = await axios.post("api/productos", this.product).catch((e) => {
                        if (e.response.status === 422) {
                            this.errors = e.response.data.errors;
                        }
                    });

                    if (res.data.message == "success") {
                        this.products = res.data.products;
                        ui.alert("Registro creado correctamente.");
                    }
                    break;
                case "Modificar":
                    console.log(this.product);
                    res = await axios
                        .put(`api/productos/${this.product.id}`, this.product)
                        .catch((e) => {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            }
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
            this.product = this.products.find((product) => product.id == id);
            this.textButton = "Modificar";
        },

        showProduct(id) {
            this.product = this.products.find((product) => product.id == id);
            this.showOpen = true;
        },

        showClose() {
            this.showOpen = false;
            this.cleanInputs();
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
                    const res = await axios.delete(`api/productos/${id}`).catch((e) => {
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
            this.product = {
                product_name: "",
                unit_price: "0.00",
                stock: "",
                warranty: "",
                product_description: ""
            };
            this.textButton = "Guardar";
        },

        async getResults(page = 1) {
            const res = await axios.get(this.pagination.path + "?page=" + page);
            this.products = res.data.products.data;
            this.pagination = res.data.products;
        },
    },
};
</script>

<style>
</style>
