<template>
  <div>
    <template-system>
      <main class="container">
        <div class="card card-profile card-mobile">
          <div class="header">
            <go-back-button></go-back-button>
            <h3>{{ customer.name }}</h3>
            <router-link to="/customer/profile/edit">
              <span class="material-icons"> edit </span>
            </router-link>
          </div>
          <div class="customer-data">
            <div class="text line">
              <span class="label">Criado por:</span>
              {{ attendentName || "Cadastro no sistema" }}
            </div>
            <div class="text line">
              <span class="label">Data de Nascimento:</span>
              {{ birthdayFormatted(customer.birthday) }}
            </div>
            <div class="text line">
              <span class="label">E-mail:</span> {{ customer.email }}
            </div>
            <div class="text line">
              <span class="label">Telefone:</span>
              {{ customer.phone | VMask("(##) #####-####") }}
            </div>
            <div class="text line" v-if="customer.zipcode">
              <span class="label">CEP:</span>
              {{ customer.zipcode | VMask("#####-###") }}
            </div>
            <div class="text line" v-if="customer.city">
              <span class="label">Cidade:</span> {{ customer.city }}
            </div>
            <div class="text line" v-if="customer.state">
              <span class="label">Estado:</span> {{ customer.state }}
            </div>
          </div>
        </div>
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import GoBackButton from "../components/GoBackButton.vue";
import customers from "../services/customers.js";
import attendent from "../services/attendent.js";

export default {
  components: { TemplateSystem, GoBackButton },
  name: "Profile",
  data() {
    return {
      customer: {},
      attendentName: "",
    };
  },
  methods: {
    async searchCustomer() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await customers.index(token);
        this.customer = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async searchAttendent() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await attendent.index(token);
        this.attendentName = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    birthdayFormatted(date) {
      const dateArray = date.split("-");
      const dateFormatted = `${dateArray[2]}/${dateArray[1]}/${dateArray[0]}`;
      return dateFormatted;
    },
  },
  created() {
    this.searchCustomer();
    this.searchAttendent();
  },
};
</script>
<style lang="scss" scoped>
@import "./../styles/variables.scss";

.card-profile {
  margin-top: 2em;
}

.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.material-icons {
  color: #000;
}

.label {
  font-weight: bold;
  margin-right: 1em;
}

.line {
  display: flex;
  flex-wrap: wrap;
  //justify-content: space-between;
}

.customer-data {
  display: flex;
  flex-direction: column;
  margin-top: 2em;

  * {
    margin-bottom: 0.5em;
  }
}

//******************* Responsividade ****************/
@media screen and (max-width: 600px) {
  .card {
    margin-top: 0;
    margin-bottom: 0;
    border-top: 1px solid $primary-color;
  }
}
</style>
