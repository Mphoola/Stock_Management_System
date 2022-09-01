<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Settings />
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <h1>Stocks view</h1>
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

export default {
  name: "Stocks",
  components: {
    Footer,
    Navbar,
    Sidebar,
    Settings,
  },
  setup() {
    return {

    };
  },
};
</script>
