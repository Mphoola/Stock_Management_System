<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="d-flex justify-content-between my-2">
          <h3>Sales</h3>
          <!-- <router-link to="{name: 'add-sale'}"> -->
          <button class="btn btn-success btn-sm" @click="$router.push({name: 'add-sale'})">Add Sale</button>
          <!-- </router-link> -->
        </div>
          <div class="row">
            <div class="col grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless" v-if="sales.length > 0">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Sale #</th>
                          <th>Total</th>
                          <th>No. of items</th>
                          <th>User</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sale in sales" :key="sale.id">
                          <td>{{ sale.created_at }}</td>
                          <td class="font-weight-bold">{{ sale.id }}</td>
                          <td>{{ sale.total }}</td>
                          <td>{{ sale.sale_items_count }}</td>
                          <td>{{ sale.user }}</td>
                          <td class="font-weight-medium">
                            <!-- <router-link :to="{name: 'sale-show', params: {id: sale.id}}"> -->
                              <i data-toggle="tooltip" data-placement="top" title="Edit sale" class="fa-solid fa-pen p-2 text-success" @click="setSaleOnUpdate(sale)"></i>
                            <!-- </router-link> -->

                            <router-link :to="{name: 'show-sale', params: {id: sale.id}}">
                            <i data-toggle="tooltip" data-placement="top" title="sale details" class="fa-solid fa-eye p-2 text-primary"></i>
                            </router-link>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                    <p v-else class="h4">No sales yet</p>
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

<script setup>
import Sidebar from "@/components/Sidebar.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/Navbar.vue";
import Settings from "@/components/Settings.vue";

import { useStore} from "vuex";
import { useRouter } from "vue-router";
import {ref} from "vue";

const store = useStore();
const router = useRouter();
const sales = ref([]);

store.dispatch('getSales').then(res => {
  sales.value = res.data
  console.log(res)
})

function setSaleOnUpdate(sale) {
  store.commit('SET_SALE', sale);
  router.push({name: 'update-sale', params: {id: sale.id}});
}

</script>
