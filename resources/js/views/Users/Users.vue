<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="d-flex justify-content-between my-2">
            <h3>Users</h3>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-bs-toggle="modal"
              data-bs-target="#staticBackdrop"
            >
              Add Users
            </button>
            <!-- <button class="btn btn-success btn-sm" @click="$router.push({path: '/users-add'})">Add User</button> -->
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
                          <th>Email</th>
                          <th>Role</th>
                          <th>Active</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="user in users" :key="user.id">
                          <td>{{ user.name }}</td>
                          <td>{{ user.email }}</td>
                          <td>Marketer</td>
                          <td>{{ user.active }}</td>
                          <td class="font-weight-medium">
                            <i
                              data-toggle="tooltip"
                              data-placement="top"
                              title="Edit user"
                              class="fa-solid fa-pen p-2 text-success"
                              @click="setuserOnUpdate(user)"
                            ></i>

                            <router-link
                              :to="{
                                name: 'user-show',
                                params: { id: user.id },
                              }"
                            >
                              <i
                                data-toggle="tooltip"
                                data-placement="top"
                                title="prduct details"
                                class="fa-solid fa-eye p-2 text-primary"
                              ></i>
                            </router-link>
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
              tabindex="-1"
              aria-labelledby="staticBackdropLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                      Adding new user
                    </h5>
                  </div>
                  <div class="modal-body">
                    <form class="forms-sample" @submit.prevent="addUser">
                      <div class="form-group">
                        <input
                          type="text"
                          v-model="user.name"
                          class="form-control"
                          placeholder="Username"
                          :class="{'is-invalid': v$.name.$error}"
                        />
                        <div class="text-danger mt-2" v-if="v$.name.$error">
                            {{ v$.name.$errors[0].$message }}
                          </div>
                      </div>

                      <div class="form-group">
                        <input
                          type="email"
                          v-model="user.email"
                          class="form-control"
                          placeholder="Email"
                          :class="{'is-invalid': v$.email.$error}"                          
                        />
                        <div class="text-danger mt-2" v-if="v$.email.$error">
                            {{v$.email.$errors[0].$message}}
                        </div>
                      </div>
                      <div class="form-group">
                        <input
                          type="password"
                          v-model="user.password"
                          class="form-control"
                          placeholder="Password"
                          :class="{'is-invalid': v$.password.$error}"                          
                          />
                          <div class="text-danger mt-2" v-if="v$.password.$error">
                              {{v$.password.$errors[0].$message}}
                          </div>
                      </div>
                      <div class="form-group">
                        <input
                          type="password"
                          v-model="user.password_confirmation"
                          class="form-control"
                          placeholder="Password"
                          :class="{'is-invalid': v$.password_confirmation.$error}"                          
                        />
                        <div class="text-danger mt-2" v-if="v$.password_confirmation.$error">
                            {{v$.password_confirmation.$errors[0].$message}}
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">
                        Add Now
                      </button>
                      <button @click="resetForm"
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
import { computed, reactive, ref } from "vue";
import useValidate from "@vuelidate/core";
import { required, email, sameAs } from "@vuelidate/validators";

export default {
  name: "UsersView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
  setup() {
    const store = useStore();
    const users = ref([]);

    store.dispatch("getUsers").then((res) => {
      users.value = res;
    });

    const user = reactive({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const rules = computed(() => ({
      name: { required },
      email: { required, email },
      password: { required },
      password_confirmation: {
        required,
        sameAsPassword: sameAs(user.password),
      },
    }));

    
    const v$ = useValidate(rules, user);
    
    const resetForm = () => {
        v$.value.$reset();
    }

    const addUser = async () => {
      const result = await v$.value.$validate();
      if (!result) {
        return;
      }

      store.dispatch('addUser', user).then(res) => {

      }
    };

    return { users, user, v$, addUser, resetForm };
  },
};
</script>
