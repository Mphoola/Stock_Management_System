<template>
  <div class="container-scroller">
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="d-flex justify-content-between my-2">
            <h3>Update Product || {{ product.name }}</h3>
            <button
              class="btn btn-secondary btn-sm"
              @click="$router.push({ name: 'products' })"
            >
              go back
            </button>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form
                    class="forms-sample justify-content-start"
                    @submit.prevent="updateProduct"
                  >
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input
                        type="text"
                        v-model="product.name"
                        class="form-control"
                        id="exampleInputUsername1"
                        placeholder="Product name"
                        :class="{ 'is-invalid': v$.name.$error }"
                      />
                      <div class="text-danger mt-2" v-if="v$.name.$error">
                        {{ v$.name.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input
                        type="number"
                        v-model="product.price"
                        class="form-control"
                        id="exampleInputEmail1"
                        placeholder="Price"
                        :class="{ 'is-invalid': v$.price.$error }"
                      />
                      <div class="text-danger mt-2" v-if="v$.price.$error">
                        {{ v$.price.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Size</label>
                      <input
                        type="text"
                        v-model="product.size"
                        class="form-control"
                        id="exampleInputPassword1"
                        placeholder="e.g small, medium, 1kg, etc"
                        :class="{ 'is-invalid': v$.size.$error }"
                      />
                      <div class="text-danger mt-2" v-if="v$.size.$error">
                        {{ v$.size.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1"
                        >Available in stock</label
                      >
                      <input
                        type="number"
                        v-model="product.stock"
                        class="form-control"
                        id="exampleInputConfirmPassword1"
                        placeholder="How many of such products are available now"
                        :class="{ 'is-invalid': v$.stock.$error }"
                      />
                      <div class="text-danger mt-2" v-if="v$.stock.$error">
                        {{ v$.stock.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Code</label>
                      <input
                        type="text"
                        v-model="product.code"
                        class="form-control"
                        id="exampleInputConfirmPassword1"
                        placeholder="Any combination to easily identify the item"
                        :class="{ 'is-invalid': v$.code.$error }"
                      />
                      <div class="text-danger mt-2" v-if="v$.code.$error">
                        {{ v$.code.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1"
                        >Description</label
                      >
                      <input
                        v-model="product.description"
                        class="form-control"
                        id="exampleInputConfirmPassword1"
                        placeholder="Describe the product"
                        :class="{ 'is-invalid': v$.description.$error }"
                      />
                      <div
                        class="text-danger mt-2"
                        v-if="v$.description.$error"
                      >
                        {{ v$.description.$errors[0].$message }}
                      </div>
                    </div>
                    </div>
                  </div>

                    <button type="submit" class="btn btn-success mr-2 justify-content-end">
                      Update Now
                    </button>
                    <!-- <button class="btn btn-light" >Cancel</button> -->
                  </form>
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
import { computed, reactive } from "vue";
import useValidate from "@vuelidate/core";
import { required, numeric } from "@vuelidate/validators";

export default {
  name: "EditProduct",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
  setup() {
    const store = useStore();

    const productOnUpdate = store.getters.product

    const product = reactive({
      name: productOnUpdate.name,
      price: productOnUpdate.price,
      size: productOnUpdate.size,
      stock: productOnUpdate.stock,
      description: productOnUpdate.description,
      code: productOnUpdate.code,
      id: productOnUpdate.id,
      _method: "PUT",
    });

    const rules = computed(() => ({
      name: { required },
      price: { required, numeric },
      size: { required },
      stock: { required, numeric },
      description: { required },
      code: { required },
    }));

    const v$ = useValidate(rules, product);

    const updateProduct = async () => {
      const result = await v$.value.$validate()
      if (!result) {
        // notify user form is invalid
        return
      }

        store.dispatch("updateProduct", product).then((res) => {
          if (res.status) {
            product.name = "";
            product.price = "";
            product.size = "";
            product.stock = "";
            product.description = "";
            product.code = "";

            v$.value.$reset();

            Swal.fire({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              icon: "success",
              title: "Product updated successfully",
            });
          }
        });

    };
    return {
      updateProduct,
      product,
      v$,
    };
  },
};
</script>
