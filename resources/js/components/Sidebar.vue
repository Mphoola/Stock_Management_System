<template>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="fa-solid fa-gauge menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/products" class="nav-link">
          <!-- <i class="icon-grid menu-icon"></i> -->
          <i class="fa-brands fa-product-hunt menu-icon"></i>
          <span class="menu-title">Products</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/stocks" class="nav-link">
          <i class="fa-solid fa-cubes-stacked menu-icon"></i>
          <span class="menu-title">Stocks</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/sales" class="nav-link">
          <i class="fa-solid fa-cart-shopping menu-icon"></i>
          <span class="menu-title">Sales</span>
        </router-link>
      </li>
      <!-- <li class="nav-item">
        <router-link to="/transactions" class="nav-link">
          <i class="fa-solid fa-money-bill-trend-up menu-icon"></i>
          <span class="menu-title">Transactions</span>
        </router-link>
      </li> -->
      <li class="nav-item">
        <router-link to="/expenses" class="nav-link">
          <!-- <i class="fa-solid fa-money menu-icon"></i> -->
          <i class="fa-solid fa-money-bill-transfer menu-icon"></i>
          <span class="menu-title">Expenses</span>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/users" class="nav-link">
          <i class="fa fa-users menu-icon"></i>
          <span class="menu-title">Users</span>
        </router-link>
      </li>
      <!-- <li class="nav-item">
        <router-link to="/logs" class="nav-link">
          <i class="fa-solid fa-gears menu-icon"></i>
          <span class="menu-title">Activity Logs</span>
        </router-link>
      </li> -->
      <li class="nav-item" @click="logout">
        <div class="nav-link">
          <i class="fa-solid fa-sign-out menu-icon"></i>
          <span class="menu-title">Logout</span>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
export default {
  name: "SidebarView",
  setup(){
      const store = useStore()
      const router = useRouter()

      const logout = () => {
        store.dispatch('logoutUser').then(() => {
          router.push('/login')
        })
      }
      return {
        logout
      }
    }
};
</script>