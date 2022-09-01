<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <Spinner />

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
import Spinner from "@/components/Spinner.vue";

export default {
  name: "DashboardView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
    Spinner,
},
};
</script>
