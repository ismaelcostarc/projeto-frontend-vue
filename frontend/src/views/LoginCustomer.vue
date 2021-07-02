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
        <button type="submit" class="button button-default">Entrar</button>
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
import customers from "../services/customers.js";
import cpfIsValid from "../assets/cpfIsValid.js";
import "../assets/toast.js";

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
      if (cpfIsValid(formattedCPF)) {
        try {
          const response = await customers.login(formattedCPF, this.password);
          const token = response.data.bearer_token;
          this.$store.commit("setToken", token);
          this.$store.commit("setProfile", 1);
          this.$router.push("/customers/home");
        } catch (error) {
          if (error.response == undefined) {
            this.$toasted.global.toastedError(
              "Ocorreu um erro em nosso servidor, por favor tente novamente"
            );
          } else {
            if (error.response.status == 401) {
              this.$toasted.global.toastedError(
                "O usuário com o CPF e senha informados não existe"
              );
            }
          }
        }
      } else {
        this.$toasted.global.toastedError("Insira um CPF válido.");
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
