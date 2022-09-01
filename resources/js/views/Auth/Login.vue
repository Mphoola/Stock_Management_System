<script setup>
import { reactive, computed, ref } from "vue";
import useValidate from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

const router = useRouter();
const store = useStore();

const state = reactive({
  email: "",
  password: "",
});
const serverErrors = ref("");

const rules = computed(() => ({
  email: { required, email },
  password: {
    required,
  },
}));

const v$ = useValidate(rules, state);

const submitForm = async () => {
  const result = await v$.value.$validate();
  if (result) {
    store
      .dispatch("loginUser", {
        email: state.email,
        password: state.password,
      })
      .then((res) => {
        console.log(res)
        if (res.status) {
          router.push("/dashboard");
        }else{
          serverErrors.value = res.message;
        }
       
      });
  } else {
    return;
  }
};
</script>

<template>
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <h1 class="font-weight-light">Ndiwo Shop</h1>
            </div>

            <h6>Login to continue</h6>
            <p class="text-danger mt-2" v-if="serverErrors">{{ serverErrors }}</p>
            <form class="py-3" @submit.prevent="submitForm">
              <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  :class="{ 'is-invalid': v$.email.$error }"
                  placeholder="Email"
                  v-model="state.email"
                />
                <div class="text-danger mt-2" v-if="v$.email.$error">
                  {{ v$.email.$errors[0].$message }}
                </div>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  :class="{ 'is-invalid': v$.password.$error }"
                  class="form-control"
                  placeholder="Password"
                  v-model="state.password"
                />
                <div class="text-danger mt-2" v-if="v$.password.$error">
                  {{ v$.password.$errors[0].$message }}
                </div>
              </div>

              <button
                class="
                  mt-3
                  btn btn-block btn-primary btn-sm
                  font-weight-medium
                  auth-form-btn
                "
                :disabled="$store.getters.isLoading"
                type="submit"
              >
                <div class="spinner-border spinner-border-sm text-light" v-if="$store.getters.isLoading" role="status">
                  <span class="visually-hidden"></span>
                </div>
                Login
              </button>
            </form>
            <div class="my-2 d-flex justify-content-between align-items-center">
              <div></div>
              <router-link class="auth-link text-black" to="/forget-password"
                >Forget Password?</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>