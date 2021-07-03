<template>
  <div>
    <template-system>
      <header>
        <router-link class="button button-secondary" to="/schedule"
          >Agendar Exame</router-link
        >
      </header>
      <main>
        <div class="schedulings">
          <div v-for="scheduling in schedulings" :key="scheduling.id">
            <div class="card card-scheduling">
              <h2>{{ scheduling.exam }}</h2>
              <div class="scheduling-data">
                <div class="text">
                  Dia: {{ schedulingDateFormatted(scheduling.date) }}
                </div>
                <div class="text">Horário: {{ schedulingHourFormatted(scheduling.hour) }}</div>
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
    TemplateSystem,
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
    schedulingDateFormatted(date) {
      const dateArray = date.split('-');
      const dateFormatted = `${dateArray[2]}/${dateArray[1]}/${dateArray[0]}`
      return dateFormatted;
    },
    schedulingHourFormatted(hour) {
      return hour.slice(0, 5);
    }
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
  height: 100%;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-around;
}

.group-button {
  > :first-child {
    margin-right: 1em;
  }
}

.scheduling-data {
  > :not(:last-child) {
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