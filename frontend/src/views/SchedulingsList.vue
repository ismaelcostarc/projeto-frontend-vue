<template>
  <div>
    <template-system>
      <header>
        <button class="button button-secondary">Agendar Exame</button>
      </header>
      <main>
        <div class="schedulings">
          <span class="loader" v-if="schedulings != []">Loader</span>
          <div v-for="scheduling in schedulings" :key="scheduling.id">
            <div class="card card-scheduling">
              <h2>{{ scheduling.exam }}</h2>
              <div class="scheduling-data">
                <div class="text">Dia: {{ scheduling.date }}</div>
                <div class="text">Horário: {{ scheduling.hour }}</div>
                <div class="text">
                  Convênio: {{ scheduling.health_insurance }}
                </div>
                <div class="text">Local: {{ scheduling.place }}</div>
              </div>
              <div class="group-button">
                <button class="button button-default">Remarcar</button>
                <button class="button button-warning">Desmarcar</button>
              </div>
            </div>
          </div>
        </div>
        
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import schedulings from "../services/schedulings.js";

export default {
  name: "SchedulingsList",
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
        this.schedulings = schedulingsList.data;
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

main {
  min-height: 86vh;
}

.schedulings {
  height: 100%;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-around;
}

.group-button {
  >:first-child {
    margin-right: 1em;
  }
}

.scheduling-data {
  >:not(:last-child) {
    margin-bottom: 1em;
  }
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