<template>
  <div class="container bg screen">
    <div class="card-login">
      <header>
        <go-back-button />
        <h1>Criar conta</h1>
      </header>

      <form class="form-login" @submit.prevent="signUp">
        <input
          type="text"
          v-mask="'#####-###'"
          v-model="cep"
          placeholder="Digite seu CEP"
          class="input-login text"
          @blur="consultCEP"
          required
        />

        <select v-model="state" class="input-login select-login" required>
          <option selected value="">Escolha seu estado</option>
          <option value="AC">AC</option>
          <option value="AL">AL</option>
          <option value="AP">AP</option>
          <option value="AM">AM</option>
          <option value="BA">BA</option>
          <option value="CE">CE</option>
          <option value="ES">ES</option>
          <option value="GO">GO</option>
          <option value="MA">MA</option>
          <option value="MT">MT</option>
          <option value="MS">MS</option>
          <option value="MG">MG</option>
          <option value="PA">PA</option>
          <option value="PB">PB</option>
          <option value="PR">PR</option>
          <option value="PE">PE</option>
          <option value="PI">PI</option>
          <option value="RJ">RJ</option>
          <option value="RN">RN</option>
          <option value="RS">RS</option>
          <option value="RO">RO</option>
          <option value="RR">RR</option>
          <option value="SC">SC</option>
          <option value="SP">SP</option>
          <option value="SE">SE</option>
          <option value="TO">TO</option>
          <option value="DF">DF</option>
        </select>

        <input
          type="text"
          v-model="city"
          placeholder="Digite sua cidade"
          class="input-login text"
          required
        />

        <button type="submit" class="button button-default">Cadastrar</button>
      </form>

      <footer class="group-link">
        <router-link to="/" class="link">Já possui cadastro?</router-link>
      </footer>
    </div>
  </div>
</template>
<script>
import customers from "../services/customers.js";
import GoBackButton from "../components/GoBackButton.vue";
import { consultCEP } from "../services/viaCEP.js";
import "../assets/toast.js";

export default {
  name: "SignUpStep1",
  components: {
    GoBackButton: GoBackButton,
  },
  data() {
    return {
      cep: "",
      state: "",
      city: "",
    };
  },
  methods: {
    async consultCEP() {
      try {
        //Consulta à API de ceps
        const dataCEP = await consultCEP(this.cep);
        this.state = dataCEP.data.uf;
        this.city = dataCEP.data.localidade;
      } catch (error) {
        if (error.response == undefined) {
          this.$toasted.global.toastedError(
            "O usuário com o CPF e senha informados não existe"
          );
        }
      }
    },
    signUp() {
      //Armazena o estado e vai para o passo 2
      this.$route.push("/sign-up-step-2");
    },
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}

header {
  display: flex;
  width: 100%;
  justify-content: space-around;
}

.warning {
  color: $warning;
  font-size: 0.7em;
}
</style>
