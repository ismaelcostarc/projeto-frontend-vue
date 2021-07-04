<template>
  <div>
    <template-system>
      <div class="container">
        <div class="card card-mobile">
          <div class="card-header">
            <go-back-button></go-back-button>
            <h3>Agendar Exame</h3>
            <div></div>
          </div>
          <form class="new-schedule-form" @submit.prevent="schedule()">
            <div class="row">
              <div class="column">
                <div class="label">Tipo de Exame<span>: *</span></div>
                <select
                  v-model="scheduling.type"
                  class="input select-login"
                  required
                >
                  <option value="Coagulograma">Coagulograma</option>
                  <option value="Densitometria Óssea">
                    Densitometria Óssea
                  </option>
                  <option value="Eletrocardiograma">Eletrocardiograma</option>
                  <option value="Exame de Fezes">Exame de Fezes</option>
                  <option value="Exame de próstata">Exame de próstata</option>
                  <option value="Hemograma">Hemograma</option>
                  <option value="Exame Psicotécnico">Exame Psicotécnico</option>
                  <option value="Exame Toxicológico">Exame Toxicológico</option>
                  <option value="Mamografia">Mamografia</option>
                  <option value="Radiografia">Radiografia</option>
                </select>
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">Local<span>: *</span></div>
                <select
                  v-model="scheduling.place"
                  class="input select-login"
                  required
                >
                  <option value="Hospital Getúlio Vargas">
                    Hospital Getúlio Vargas
                  </option>
                  <option value="Hospital Santa Maria">
                    Hospital Santa Maria
                  </option>
                  <option value="Unimed">Unimed</option>
                  <option value="MedImagem">MedImagem</option>
                </select>
                <div class="warning">.</div>
              </div>
            </div>

            <div class="row">
              <div class="column">
                <div class="label">Plano de Saúde<span>: *</span></div>
                <select
                  v-model="scheduling.health_insurance"
                  class="input select-login"
                  required
                >
                  <option value="HapVida">HapVida</option>
                  <option value="MedPlan">MedPlan</option>
                  <option value="InterMed">InterMed</option>
                </select>
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">Dia<span>: *</span></div>
                <input
                  type="text"
                  class="input input-system text"
                  v-model="scheduling.date"
                  v-mask="'##/##/####'"
                  required
                />
                <div class="warning">.</div>
              </div>
            </div>

            <div class="row">
              <div class="column">
                <div class="label">Hora<span>: *</span></div>
                <select
                  v-model="scheduling.hour"
                  class="input select-login"
                  required
                >
                  <option value="08:00:00">08:00</option>
                  <option value="10:00:00">10:00</option>
                  <option value="12:00:00">12:00</option>
                  <option value="14:00:00">14:00</option>
                  <option value="16:00:00">16:00</option>
                  <option value="18:00:00">18:00</option>
                </select>
                <div class="warning">.</div>
              </div>
            </div>
            <button class="button button-success">Agendar</button>
          </form>
        </div>
      </div>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import GoBackButton from "../components/GoBackButton.vue";
import schedulings from '../services/schedulings.js';

export default {
  components: { TemplateSystem, GoBackButton },
  name: "Schedule",
  data() {
    return {
      scheduling: {},
    };
  },
  methods: {
    schedule() {
      const dateArray = this.scheduling.date.split('/');
      const dateFormatted = `${dateArray[2]}-${dateArray[1]}-${dateArray[0]}}`;
      this.scheduling.date = dateFormatted;
      try {
        
      } catch (error) {
        console.error(error)
      }
      console.log(this.scheduling)
    }
  }
};
</script>
<style lang="scss" scoped>
.card {
  margin-top: 2em;
  margin-bottom: 2em;
}

.label {
  font-weight: 500;
  &:not(:last-child) {
    margin-bottom: 0.5em;
  }

  & > span {
    font-weight: 300;
  }
}

.new-schedule-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 2em;

  .button {
    width: 7em;
  }
}

.warning-required-inputs {
  font-size: 0.9em;
  align-self: flex-start;
  margin-bottom: 1em;
}

.warning {
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  visibility: hidden;
}

.select-login {
  width: 18.7em;
}

.row:nth-child(3) {
  align-self: flex-start;
}

//******************* Responsividade ****************/
@media screen and (max-width: 600px) {
  .row:nth-child(3){
    align-self: center;
  }
}
</style>
