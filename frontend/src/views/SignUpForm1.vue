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
    };
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}
</style>