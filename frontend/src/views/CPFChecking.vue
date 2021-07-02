<template>
  <div class="container bg">
    <div class="card-login">
      <header>
        <h1>Criar conta</h1>
      </header>

      <form class="form-login" @submit.prevent="checkCPF">
        <input
          type="text"
          placeholder="Seu CPF"
          class="input-login text"
          v-mask="'###.###.###-##'"
          v-model="cpf"
          required
          :style="{ 'border-color': inputBorderColor }"
          @click="inputBorderColor = '#717171'"
        />

        <button type="submit" class="button button-default">Entrar</button>
      </form>

      <footer class="group-link">
        <router-link to="/" class="link">Já possui cadastro?</router-link>
      </footer>
    </div>
  </div>
</template>
<script>
import customers from "../services/customers.js";
import cpfIsValid from "../assets/cpfIsValid.js";
import "../assets/toast.js";

export default {
  name: "CPFChecking",
  data() {
    return {
      cpf: "",
      inputBorderColor: "",
    };
  },
  methods: {
    async checkCPF() {
      const formattedCPF = this.cpf.replaceAll(".", "").replace("-", "");
      if (cpfIsValid(formattedCPF)) {
        // Tenta conectar com a API, caso não consiga emite um toast de erro
        try {
          const response = await customers.check(formattedCPF);
          if (response.data.cpfIsRegistered === true) {
            this.inputBorderColor = "#FF5E5E";
            this.$toasted.global.toastedError("O CPF já está registrado");
          } else {
            // armazenar o cpf e redirecionar para o passo 2 do cadastro
            this.$store.commit("setCPF", formattedCPF);
            this.$router.push("/sign-up-step-1");
          }
        } catch (error) {
          console.error(error);
          this.$toasted.global.toastedError(
            "Ocorreu um erro em nosso servidor, por favor tente novamente"
          );
        }
      } else {
        this.inputBorderColor = "#FF5E5E";
        this.$toasted.global.toastedError("O CPF informado não é válido");
      }
    },
  },
  created() {
    //Quando o componente for criado ele busca o valor do no state
    this.cpf = this.$store.state.newCustomer.cpf;
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}
</style>
