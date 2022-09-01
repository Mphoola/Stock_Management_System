<template>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" >Ndiwo Shop</a>
        <!-- <router-link to="/dashboard">About</router-link> -->
        <a class="navbar-brand brand-logo-mini" >NS</a>
      </div>
    <Spinner></Spinner>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <!-- <img src="@/assets/logo.png" alt="profile"/> -->
              <a class="navbar-brand brand-logo-mini" >LOGO</a>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
              <!-- <a class="dropdown-item" id="settings-trigger"> -->
                <i class="fa-solid fa-gears text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" @click="logout">
                <i class="fa-solid fa-sign-out text-primary"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <!-- <span class="icon-menu">hello</span> -->
          <i class="icon-menu"></i>
        </button>
      </div>
    </nav>
</template>
<script >
import Spinner from '@/components/Spinner.vue'

export default {
  components: { Spinner },
}
</script>
