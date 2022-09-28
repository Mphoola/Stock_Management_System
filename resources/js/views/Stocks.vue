<!-- eslint-disable vue/multi-word-component-names -->
<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">

        <div class=" my-2">
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
                          <td>{{ product.stock }}</td>
                          <td class="font-weight-medium">
                            <!-- <router-link :to="{name: 'product-show', params: {id: product.id}}"> -->
                              <i data-toggle="tooltip" data-placement="top" title="Edit stock" class="fa-solid fa-pen p-2 text-success" @click="setProductOnUpdate(product)"></i>
                            <!-- </router-link> -->
                          </td>
                        </tr>

                      </tbody>
                    </table>
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

import { useStore} from "vuex";
import { useRouter } from "vue-router";
import {ref} from "vue";

export default{
  name: "ProductsView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
},
  setup() {
    const store = useStore();
    const router = useRouter();
    const products = ref([]);

    store.dispatch("getProducts").then(res => {
      products.value = res;
    });

    const setProductOnUpdate = (product) =>{
      store.commit("SET_PRODUCT", product);
      router.push({name: "product-update", params: {id: product.id}});
    }

    return {
      products,
      setProductOnUpdate,
    };
  },
};

</script>
