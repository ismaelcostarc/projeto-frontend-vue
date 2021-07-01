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
          @click="inputBorderColor = '#000'"
        />

        <button type="submit" class="button">Entrar</button>
      </form>

      <footer class="group-link">
        <router-link to="/" class="link">Já possui cadastro?</router-link>
      </footer>
    </div>
  </div>
</template>
<script>
import Customers from "../services/customers.js";
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
      if (this.cpfIsValid(formattedCPF)) {
        const response = await Customers.check(formattedCPF);
        if (response.data.cpfIsRegistered == true) {
          this.inputBorderColor = "#FF5E5E";
          this.$toasted.global.toastedError("O CPF já está registrado");
        } else {
          //armazenar o cpf e redirecionar para o passo 2 do cadastro
        }
      } else {
        this.inputBorderColor = "#FF5E5E";
        this.$toasted.global.toastedError("O CPF informado não é válido");
      }
    },
    cpfIsValid(strCPF) {
      var Soma;
      var Resto;
      Soma = 0;

      if (
        strCPF === "00000000000" ||
        strCPF === "11111111111" ||
        strCPF === "22222222222" ||
        strCPF === "33333333333" ||
        strCPF === "44444444444" ||
        strCPF === "55555555555" ||
        strCPF === "66666666666" ||
        strCPF === "77777777777" ||
        strCPF === "88888888888" ||
        strCPF === "99999999999"
      ) {
        return false;
      }

      for (let i = 1; i <= 9; i++) {
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
      }
      Resto = (Soma * 10) % 11;

      if (Resto === 10 || Resto === 11) Resto = 0;
      if (Resto !== parseInt(strCPF.substring(9, 10))) return false;

      Soma = 0;
      for (let i = 1; i <= 10; i++) {
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
      }
      Resto = (Soma * 10) % 11;

      if (Resto === 10 || Resto === 11) Resto = 0;
      if (Resto !== parseInt(strCPF.substring(10, 11))) return false;
      return true;
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