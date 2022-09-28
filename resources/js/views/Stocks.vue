<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="my-2">
            <h3>Product Stocks</h3>
            <p>Here you can update the stocks of each product</p>
          </div>
          <div class="row">
            <div class="col grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Size</th>
                          <th>Stock</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="product in products" :key="product.id">
                          <td>{{ product.name }}</td>
                          <td class="font-weight-bold">{{ product.price }}</td>
                          <td>{{ product.size }}</td>
                          <td>
                            {{ product.stock }}
                          </td>
                          <td class="font-weight-medium">
                            <button
                              type="button"
                              class="btn btn-success btn-sm"
                                @click="toggleShowModal(product)"
                            >
                              Update
                            </button>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div
              class="modal fade"
              id="staticBackdrop"
              data-bs-backdrop="static"
              data-bs-keyboard="false"
              aria-labelledby="staticBackdropLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog ">
                <div class="modal-content ">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                      Updating product stock | {{product.name}}
                    </h5>
                  </div>
                  <div class="modal-body">
                    <p class="text-danger mt-2" v-if="error">{{ error }}</p>
                    <form class="forms-sample" @submit.prevent="updateStock(product.id)">
                      <div class="form-group">
                        <input
                          type="number"
                          class="form-control"
                          placeholder="Stock"
                          v-model="product.stock"
                          :class="{ 'is-invalid': error }"
                        />

                      </div>


                      <button
                        class="btn btn-success me-2"
                        :disabled="$store.getters.isLoading"
                        type="submit"
                      >
                        <div
                          class="spinner-border spinner-border-sm text-light"
                          v-if="$store.getters.isLoading"
                          role="status"
                        >
                          <span class="visually-hidden"></span>
                        </div>
                        Update Now
                      </button>

                      <button
                        @click="resetForm"
                        type="button"
                        class="btn btn-danger mx-2"
                        data-bs-dismiss="modal"
                      >
                        Close
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <Footer />
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "@/components/Sidebar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/Navbar.vue";
import Settings from "@/components/Settings.vue";

import { useStore } from "vuex";
import { ref, reactive } from "vue";

export default {
  name: "ProductsView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
  setup() {
    const store = useStore();
    const products = ref([]);
    const selected_product = ref({});
    const error = ref('');
    const product = reactive({
        name: '',
        id: '',
        stock: '',
        _method: 'PUT'
    });

    const toggleShowModal = (p) => {
        $('#staticBackdrop').modal('toggle');

        product.name = p.name
        product.id = p.id
        product.stock = p.stock
    }

    store.dispatch("getProducts").then((res) => {
      products.value = store.getters.products;
    });

    const updateStock = (id) => {
        error.value = ""
        selected_product.value = products.value.find(product => product.id == id)

        if(selected_product.value['stock'] > product.stock){
            error.value = "You can only increment stock. Reducing is automatic when you are adding sales"
        }else{
            store.dispatch("updateProductStock", product).then((res) => {
              if(res.status){
                $('#staticBackdrop').modal('toggle');
                    Swal.fire({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: "Product stock updated successfully",
                });
              }
            })
        }

    };

    return {
      products,
      updateStock,
      product,
      toggleShowModal,
      error
    };
  },
};
</script>
