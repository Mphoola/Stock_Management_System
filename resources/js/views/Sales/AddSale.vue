<template>
  <div class="container-scroller">
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="d-flex justify-content-between my-2">
            <h3>Add New sale</h3>
            <button
              class="btn btn-secondary btn-sm"
              @click="$router.push({ name: 'sales' })"
            >
              go back
            </button>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputUsername1"
                            >Customer Name</label
                          >
                          <input
                            type="text"
                            v-model="sale.customer_name"
                            class="form-control"
                            id="exampleInputUsername1"
                            placeholder="optional"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Customer Phone</label>
                          <input
                            type="number"
                            v-model="sale.customer_phone"
                            class="form-control"
                            id="exampleInputEmail1"
                            placeholder="optional"
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Products</label>
                          <input
                            class="form-control"
                            list="products-data"
                            v-model="selected_product"
                            placeholder="Type to search..."
                          />
                          <datalist id="products-data" ref="datalist">
                            <option
                              v-for="item in products"
                              :value="item.name"
                              :id="item.id"
                              :key="item.id"
                            ></option>
                          </datalist>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between my-2">
            <h3>Sale Items ({{ selectedItems.length }})</h3>
            <button class="btn btn-secondary btn-sm">
              Total : MWK {{ formatCartPrice(totalInCart) }}
            </button>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Sub Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(item, index) in selectedItems" :key="index">
                          <td>{{ item.name + "-" + item.size }}</td>
                          <td>{{ item.price }}</td>
                          <td style="width: 170px">
                            <input
                              v-model="item.quantity"
                              class="form-control input-qty"
                              type="number"
                              min="1"
                              :max="item.stock"
                            />
                          </td>
                          <td>
                            {{ formatCartPrice(item.price * item.quantity) }}
                          </td>
                          <td>
                            <label class="badge badge-danger p-2"
                              ><i data-toggle="tooltip" data-placement="top" title="Remove item"
                                @click="removeItem(index, item)"
                                class="fa-solid fa-trash"
                              ></i
                            ></label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button
            type="submit"
            class="btn btn-success mr-2 justify-content-end"
            @click="addSale"
          >
            Save Now
          </button>
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
import { reactive, ref, watch } from "vue";

export default {
  name: "AddsaleView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
  setup() {
    const store = useStore();

    const products = ref([]);

    const selected_product = ref("");

    const p = reactive([]);

    const selectedItems = ref([]);
    const totalInCart = ref(0);

    watch(selected_product, () => {
      p.value = products.value.filter(
        (item) => item.name === selected_product.value
      );

      if (p.value.length > 0) {
        p.value = p.value[0];

        selectedItems.value.push({
          id: p.value.id,
          name: p.value.name,
          price: p.value.price,
          quantity: 1,
          stock: p.value.stock,
          size: p.value.size,
        });

        //remove the added item from the list of products
        products.value = products.value.filter(
          (item) => item.name !== selected_product.value
        );

        selected_product.value = "";

        //find sumation of all items in cart
        calculateSumOfItems();
      }
    });

    watch(selectedItems.value, () => {
       calculateSumOfItems();
    })

    const calculateSumOfItems = () => {
      totalInCart.value = 0;
        selectedItems.value.forEach((item) => {
          totalInCart.value += item.price * item.quantity;
        });
    }

    //format cart price to money format
    const formatCartPrice = (price) => {
      return price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
    };

    //remote an item from cart
    const removeItem = (index, product) => {
      selectedItems.value.splice(index, 1);
      products.value.push(product);

      calculateSumOfItems()
    };

    store.dispatch("getProducts").then((res) => {
      products.value = res;
    });

    const sale = reactive({
      customer_name: "",
      customer_phone: "",
      total: 0,
      saleItems: [],
    });

    const addSale = () => {
      if (selectedItems.value.length > 0) {
        for (let i = 0; i < selectedItems.value.length; i++) {
          sale.saleItems.push({
            product_id: selectedItems.value[i].id,
            quantity: selectedItems.value[i].quantity,
          });
        }

        sale.total = totalInCart.value;

        store.dispatch("addSale", sale).then((res) => {

          if (res.status) {
            selectedItems.value = [];
            totalInCart.value = 0;
            products.value = [];

            Swal.fire({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              icon: "success",
              title: "sale added successfully",
            });

            store.dispatch("getProducts").then((res) => {
              products.value = res;
            });
          }
        });
      } else {
        Swal.fire("Attention!", "Add atleast one item to the sale", "info");
      }
    };
    return {
      addSale,
      sale,
      products,
      selected_product,
      selectedItems,
      totalInCart,
      formatCartPrice,
      removeItem,
    };
  },
};
</script>
