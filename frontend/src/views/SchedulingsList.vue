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
          <form
            slot="body"
            class="form-login"
            @submit.prevent="showSchedules()"
          >
            <h3>Deseja remarcar para que dia?</h3>
            <input
              type="text"
              class="input text"
              v-model="date"
              required
              v-mask="'##/##/####'"
            />
            <button class="button button-default">Buscar</button>
          </form>
          <div slot="footer"></div>
        </modal>

        <modal v-if="modalHourRescheduleIsVisible">
          <div slot="header" class="modal-header">
            <span
              class="material-icons"
              @click="
                modalHourRescheduleIsVisible = false;
                modalRescheduleIsVisible = true;
              "
            >
              chevron_left
            </span>
            <h3>Horários Disponíveis:</h3>
            <span
              class="material-icons"
              @click="modalHourRescheduleIsVisible = false"
            >
              close
            </span>
          </div>
          <form slot="body" class="form-login" @submit.prevent="reschedule()">
            <div class="hours">
              <div
                class="hour"
                @click="hourSelected = '08:00:00'"
                v-if="hourSelected !== '08:00:00'"
              >
                08:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '08:00:00'"
              >
                08:00
              </div>
              <div
                class="hour"
                @click="hourSelected = '10:00:00'"
                v-if="hourSelected !== '10:00:00'"
              >
                10:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '10:00:00'"
              >
                10:00
              </div>
              <div
                class="hour"
                @click="hourSelected = '12:00:00'"
                v-if="hourSelected !== '12:00:00'"
              >
                12:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '12:00:00'"
              >
                12:00
              </div>
              <div
                class="hour"
                @click="hourSelected = '14:00:00'"
                v-if="hourSelected !== '14:00:00'"
              >
                14:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '14:00:00'"
              >
                14:00
              </div>

              <div
                class="hour"
                @click="hourSelected = '16:00:00'"
                v-if="hourSelected !== '16:00:00'"
              >
                16:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '16:00:00'"
              >
                16:00
              </div>

              <div
                class="hour"
                @click="hourSelected = '18:00:00'"
                v-if="hourSelected !== '18:00:00'"
              >
                18:00
              </div>
              <div
                class="hour hour-selected"
                @click="hourSelected = ''"
                v-if="hourSelected == '18:00:00'"
              >
                18:00
              </div>
            </div>
            <button class="button button-default">Remarcar</button>
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

          <div v-if="!schedulings.length" class="empty-list">
            Você não possui exames agendados
          </div>
        </div>
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import Modal from "../components/Modal.vue";
import schedulings from "../services/schedulings.js";
import formatDate from "../assets/formatDate.js";

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
      date: "",
      hourSelected: "",
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

      //Toda vez que o modal aparecer é pega a data atual
      const data = new Date();
      let day = String(data.getDate());
      if (day.length === 1) day = "0" + day;

      let month = String(data.getMonth() + 1);
      if (month.length === 1) month = "0" + month;
      console.log(month);

      const year = data.getFullYear();
      this.date = day + "/" + month + "/" + year;
      console.log(this.date);
    },
    showModalMarkOff(id) {
      this.scheduleIdSelected = id;
      this.modalMarkOffScheduleIsVisible = true;
    },
    async markOffScheduling() {
      const token = this.$store.state.authenticatedUser.token;

      try {
        const response = schedulings.delete(token, this.scheduleIdSelected);
        //Atualiza os exames na tela
        this.getSchedulings();
        //Quando o registro do agendamento é realizado o modal some e aparece um toaster
        this.modalMarkOffScheduleIsVisible = false;
        this.$toasted.global.toastSuccess("Exame desmarcado com sucesso");
      } catch (error) {
        console.error(error);
      }
    },
    showSchedules() {
      this.modalRescheduleIsVisible = false;
      this.modalHourRescheduleIsVisible = true;
    },
    async reschedule() {
      //Caso o usuário não tenha selecionado nenhum dos horários
      if (!this.hourSelected) return;

      const newSchedule = {};
      (newSchedule.date = formatDate(this.date)),
        (newSchedule.hour = this.hourSelected);

      const token = this.$store.state.authenticatedUser.token;

      try {
        const response = await schedulings.reschedule(
          token,
          this.scheduleIdSelected,
          newSchedule
        );
        this.getSchedulings();
        this.modalHourRescheduleIsVisible = false;
        this.$toasted.global.toastSuccess("Exame remarcado com sucesso");
      } catch (error) {
        console.error(error);
      }
    },
  },
  created() {
    this.getSchedulings();
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

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
  display: flex;
  justify-content: space-between;
  width: 100%;
  align-items: center;
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

.hours {
  display: flex;
  flex-wrap: wrap;
}

.hour {
  padding: 0.5em;
  border: 1px solid #000;
  border-radius: $border-radius-button;
  margin: 0.5em;
  cursor: pointer;

  &:hover {
    transform: scale(1.1, 1.1);
  }

  transition: transform 0.2s;
}

.hour-selected {
  background-color: $bg-color-2;
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