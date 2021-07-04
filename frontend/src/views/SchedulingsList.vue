<template>
  <div>
    <template-system>
      <header>
        <router-link class="button button-secondary" to="/schedule"
          >Agendar Exame</router-link
        >
      </header>
      <main>
        <modal v-if="modalRescheduleIsVisible">
          <div slot="header" class="modal-header">
            <span
              class="material-icons"
              @click="modalRescheduleIsVisible = false"
            >
              close
            </span>
          </div>
          <form slot="body" class="form-login">
            <h3>Deseja remarcar para que dia?</h3>
            <input type="date" class="input text" required />
            <button class="button button-default">Buscar</button>
          </form>
          <div slot="footer"></div>
        </modal>

        <modal v-if="modalMarkOffScheduleIsVisible">
          <h3 slot="header" class="mark-off-title">
            Deseja desmarcar o exame?
          </h3>

          <div slot="body"></div>
          <div slot="footer">
            <div class="group-button">
              <button
                class="button button-warning"
                @click="markOffScheduling()"
              >
                Sim
              </button>
              <button
                class="button button-default"
                @click="modalMarkOffScheduleIsVisible = false"
              >
                Não
              </button>
            </div>
          </div>
        </modal>

        <div class="schedulings">
          <div v-for="scheduling in schedulings" :key="scheduling.id">
            <div class="card card-scheduling">
              <h2>{{ scheduling.exam }}</h2>
              <div class="scheduling-data">
                <div class="text">
                  Dia: {{ schedulingDateFormatted(scheduling.date) }}
                </div>
                <div class="text">
                  Horário: {{ schedulingHourFormatted(scheduling.hour) }}
                </div>
                <div class="text">
                  Convênio: {{ scheduling.health_insurance }}
                </div>
                <div class="text">Local: {{ scheduling.place }}</div>
              </div>
              <div class="group-button">
                <button
                  class="button button-default"
                  @click="showModalReschedule(scheduling.id)"
                >
                  Remarcar
                </button>
                <button
                  class="button button-warning"
                  @click="showModalMarkOff(scheduling.id)"
                >
                  Desmarcar
                </button>
              </div>
            </div>
          </div>

          <div v-if="!schedulings.length" class="empty-list ">Você não possui exames agendados</div>
        </div>
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import Modal from "../components/Modal.vue";
import schedulings from "../services/schedulings.js";

export default {
  name: "SchedulingsList",
  components: {
    TemplateSystem,
    Modal,
  },
  data() {
    return {
      schedulings: [],
      scheduleIdSelected: "",
      modalRescheduleIsVisible: false,
      modalHourRescheduleIsVisible: false,
      modalMarkOffScheduleIsVisible: false,
    };
  },
  methods: {
    async getSchedulings() {
      try {
        const token = this.$store.state.authenticatedUser.token;
        const schedulingsList = await schedulings.index(token);
        this.schedulings = schedulingsList.data;
      } catch (error) {
        console.error(error);
      }
    },
    schedulingDateFormatted(date) {
      const dateArray = date.split("-");
      const dateFormatted = `${dateArray[2]}/${dateArray[1]}/${dateArray[0]}`;
      return dateFormatted;
    },
    schedulingHourFormatted(hour) {
      return hour.slice(0, 5);
    },
    showModalReschedule(id) {
      this.scheduleIdSelected = id;
      this.modalRescheduleIsVisible = true;
    },
    showModalMarkOff(id) {
      this.scheduleIdSelected = id;
      this.modalMarkOffScheduleIsVisible = true;
    },
    async markOffScheduling() {
      const token = this.$store.state.authenticatedUser.token;

      try {
        console.log(this.scheduleIdSelected);
        const response = schedulings.delete(token, this.scheduleIdSelected);
        //Quando o registro do agendamento é realizado o modal some e aparece um toaster
        this.modalMarkOffScheduleIsVisible = false;
        this.$toasted.global.toastSuccess("Exame desmarcado com sucesso");
        //Atualiza os exames na tela
        this.getSchedulings();
      } catch (error) {
        console.error(error);
      }
    }
  },
  created() {
    this.getSchedulings();
    console.log(this.schedulings);
  },
};
</script>
<style scoped lang="scss">
@import './../styles/variables.scss';

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

.modal-header {
  margin-bottom: 1em;

  & > span {
    cursor: pointer;
  }
}

.mark-off-title {
  margin: 1em;
  text-align: center;
}

.empty-list {
  margin-top: 10em;
  color: $grey-light;
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