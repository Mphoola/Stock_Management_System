<template>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h1 class="font-weight-light">Ndiwo Shop</h1>
                <!-- <img src="../../images/logo.svg" alt="logo"> -->
              </div>
              
              <h6 >Password Reset</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="password" required class="form-control form-control-lg" id="exampleInputEmail1" placeholder="New Password">
                </div>
                <div class="form-group">
                  <input type="password" required class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Confirm Password">
                </div>
                <div class="mt-3">
                <router-link to="/login">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset Now</button>
                </router-link>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
</template>

<script>
export default {
    setup() {
        
    },
}
</script>