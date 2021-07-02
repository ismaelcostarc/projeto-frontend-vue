<template>
  <div>
    <template-system>
      <header>
        <button class="button button-secondary">Agendar Exame</button>
      </header>
      <main class="container">
        <div class="schedulings"></div>
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import schedulings from "../services/schedulings.js";

export default {
  name: "CustomersHome",
  components: {
    TemplateSystem: TemplateSystem,
  },
  data() {
    return {
      schedulings: [],
    };
  },
  methods: {
    async getSchedulings() {
      try {
        const token = this.$store.state.authenticatedUser.token;
        const schedulingsList = await schedulings.index(token);
        console.log(schedulingsList);
      } catch (error) {
        console.log(error);
      }
    },
  },
  created() {
    this.getSchedulings();
  },
};
</script>
<style scoped lang="scss">
header {
  padding: 1em;
  display: flex;
  justify-content: flex-end;
}

.schedulings {
  display: flex;
}

//******************* Responsividade ****************/
@media screen and (max-width: 600px) {
  header {
    justify-content: center;

    button {
      width: 100%;
    }
  }
}
</style>