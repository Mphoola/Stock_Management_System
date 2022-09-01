<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Sale Details</p>
                  <p class="font-weight-500">{{ product.description }}</p>
                  <div class="d-flex justify-content-around flex-wrap mb-2">
                    <div class="mr-5 mt-3 justify-content-start">
                      <p class="text-muted">Name</p>
                      <h3 class="text-primary fs-10 font-weight-medium">{{ product.name }}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Price</p>
                      <h3 class="text-primary fs-10 font-weight-medium">{{ product.price }}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Stock</p>
                      <h3 class="text-primary fs-10 font-weight-medium">{{ product.stock }}</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Size</p>
                      <h3 class="text-primary fs-10 font-weight-medium">{{ product.size }}</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Code</p>
                      <h3 class="text-primary fs-10 font-weight-medium">{{ product.code }}</h3>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <p class="card-title mb-0">Recent Sales</p>
                  <div class="table-responsive" v-if="sales.length > 0">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th>Sold by</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="sale in sales" :key="sale.id">
                          <td>{{ sale.sale_id }}</td>
                          <td>{{ sale.quantity }}</td>
                          <td class="font-weight-bold">{{ sale.quantity * product.price }}</td>
                          <td>{{ sale.user }}</td>
                          <td class="font-weight-medium"><div class="badge badge-success">{{ sale.created_at }}</div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <p v-else>There are no recent sales for this product</p>
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
import {useStore} from 'vuex';
import {reactive, ref} from 'vue'

export default {
  name: "ShowProductView",
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  // props: ["id"],
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
 setup(props){
  const store = useStore()

  const product = reactive({
      name: '',
      price: '',
      size: '',
      stock: '',
      description: '',
      code: '',
      id: '',
    });

  const productSales = ref([]);

  store.dispatch("showProduct", props.id).then(res => {
    if(res.status){
      product.name = res.data.name
      product.price = res.data.price
      product.size = res.data.size
      product.stock = res.data.stock
      product.description = res.data.description
      product.code = res.data.code

      productSales.value = res.data.sales
    }
  })

  return {
    product,
    sales : productSales,
  }

 }
};
</script>
