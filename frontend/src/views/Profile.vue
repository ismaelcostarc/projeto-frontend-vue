<template>
  <div>
    <template-system>
      <main class="container">
        <div class="card card-profile">
          <div class="header">
            <go-back-button></go-back-button>
            <h3>{{ customer.name }}</h3>
            <router-link to="/customer/profile/edit">
              <span class="material-icons"> edit </span>
            </router-link>
          </div>
          <div class="customer-data">
            <div class="text line">
              <span class="label">Criado por:</span> {{ attendentName }}
            </div>
            <div class="text line">
              <span class="label">Data de Nascimento:</span>
              {{ birthdayFormatted(customer.birthday) }}
            </div>
            <div class="text line">
              <span class="label">E-mail:</span> {{ customer.email }}
            </div>
            <div class="text line">
              <span class="label">Telefone:</span> {{ customer.phone | VMask('(##) #####-####') }}
            </div>
            <div class="text line">
              <span class="label">CEP:</span> {{ customer.zipcode | VMask('#####-###')}}
            </div>
            <div class="text line">
              <span class="label">Cidade:</span> {{ customer.city }}
            </div>
            <div class="text line">
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
.card-profile {
  margin-top: 2em;
}

.header {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;

  & > :first-child {
    margin-right: 3em;
  }

  & > :nth-child(2) {
    margin-right: 2em;
  }
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
</style>
