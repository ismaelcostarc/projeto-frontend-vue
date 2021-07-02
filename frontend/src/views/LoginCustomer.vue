<template>
  <div class="container bg">
    <div class="card-login">
      <header>
        <h1>Seja Bem Vindo!</h1>
      </header>

      <form class="form-login" @submit.prevent="login">
        <input
          type="text"
          placeholder="Seu CPF"
          class="input-login text"
          v-mask="'###.###.###-##'"
          v-model="cpf"
          required
        />

        <input
          type="password"
          placeholder="Sua senha"
          class="input-login text"
          v-model="password"
          required
        />
        <button type="submit" class="button">Entrar</button>
      </form>

      <footer class="group-link">
        <router-link to="/cpf-checking" class="link"
          >Não possui cadastro?</router-link
        >
        <router-link to="/" class="link">Login Administrativo</router-link>
      </footer>
    </div>
  </div>
</template>
<script>
import Customers from "../services/customers.js";

export default {
  name: "LoginCustomer",
  data() {
    return {
      cpf: "",
      password: "",
    };
  },
  methods: {
    async login() {
      const formattedCPF = this.cpf.replaceAll(".", "").replace("-", "");
      try {
        const response = await Customers.login(formattedCPF, this.password);
        const token = response.data.bearer_token;
        this.$store.commit("setToken", token);
        this.$store.commit("setProfile", 1);
        this.$router.push("/customers/home");
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}
</style>
