<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">

        </div>

        <Footer />

      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "@/components/Sidebar.vue";
import Footer from "@/components/Footer";
import Navbar from "@/components/Navbar";
import Settings from "@/components/Settings";

export default {
  name: "DashboardView",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
};
</script>
