<template>
  <div class="container bg screen">
    <div class="card-login card card-mobile">
      <header class="card-header">
        <go-back-button />
        <h1>Criar conta</h1>
        <div></div>
      </header>

      <form class="form-login" @submit.prevent="signUpStep2">
        <eye-password @swap="swapPasswordVisibility()" top="15px" left="255px">
          <input
            :type="typePassword"
            placeholder="Escolha uma senha"
            class="input input-login text"
            v-model="password"
            @blur="validatePassword"
            :style="{ 'border-color': inputPasswordBorderColor }"
            required
          />
        </eye-password>
        <div class="warning" :style="{ display: warningPasswordLengthDisplay }">
          Senhas devem ter no mínimo 6 caracteres
        </div>

        <eye-password
          @swap="swapPasswordRepeatedVisibility()"
          top="15px"
          left="255px"
        >
          <input
            :type="typePasswordRepeated"
            placeholder="Digite novamente a senha"
            class="input input-login text"
            v-model="passwordRepeated"
            @blur="passwordIsEqual"
            :style="{ 'border-color': inputPasswordRepeatedBorderColor }"
            required
          />
        </eye-password>
        <div
          class="warning"
          :style="{ display: warningPasswordIsEqualDisplay }"
        >
          As senhas informadas devem ser iguais
        </div>

        <input
          type="text"
          placeholder="Digite seu nome"
          class="input input-login text"
          v-model="name"
          required
        />

        <input
          type="email"
          placeholder="Digite seu email"
          class="input input-login text"
          v-model="email"
          required
        />

        <input
          type="text"
          placeholder="Digite sua data de nascimento"
          class="input input-login text"
          v-mask="'##/##/####'"
          v-model="birthday"
          required
        />

        <input
          type="tel"
          placeholder="Digite seu número de celular"
          class="input input-login text"
          v-mask="'(##) #####-####'"
          v-model="phone"
          required
        />

        <button type="submit" class="button button-default">Próximo</button>
      </form>

      <footer class="group-link">
        <router-link to="/" class="link">Já possui cadastro?</router-link>
      </footer>
    </div>
  </div>
</template>
<script>
import GoBackButton from "../components/GoBackButton.vue";
import EyePassword from "../components/EyePassword.vue";
import "../assets/toast.js";

export default {
  name: "SignUpStep1",
  components: {
    GoBackButton,
    EyePassword,
  },
  data() {
    return {
      password: "",
      inputPasswordBorderColor: "#717171",
      warningPasswordLengthDisplay: "none",
      passwordRepeated: "",
      warningPasswordIsEqualDisplay: "none",
      inputPasswordRepeatedBorderColor: "#717171",
      typePassword: "password",
      typePasswordRepeated: "password",
      name: "",
      email: "",
      birthday: "",
      phone: "",
    };
  },
  methods: {
    validatePassword() {
      if (this.password.length < 6) {
        this.warningPasswordLengthDisplay = "block";
        this.inputPasswordBorderColor = "#FF5E5E";
      } else {
        this.warningPasswordLengthDisplay = "none";
        this.inputPasswordBorderColor = "#717171";
      }
    },
    passwordIsEqual() {
      if (this.password !== this.passwordRepeated) {
        this.warningPasswordIsEqualDisplay = "block";
        this.inputPasswordRepeatedBorderColor = "#FF5E5E";
      } else {
        this.warningPasswordIsEqualDisplay = "none";
        this.inputPasswordRepeatedBorderColor = "#717171";
      }
    },
    signUpStep2() {
      //Armazena o estado e vai para o passo 2
      this.$store.commit("setPassword", this.password);
      this.$store.commit("setName", this.name);
      this.$store.commit("setEmail", this.email);
      this.$store.commit("setBirthday", this.birthday);
      this.$store.commit("setPhone", this.phone);

      this.$router.push("/sign-up-step-2");
    },
    swapPasswordVisibility() {
      this.typePassword =
        this.typePassword === "password" ? "text" : "password";
    },
    swapPasswordRepeatedVisibility() {
      this.typePasswordRepeated =
        this.typePasswordRepeated === "password" ? "text" : "password";
    },
  },
  created() {
    //As informações são recuperadas
    this.name = this.$store.state.newCustomer.name;
    this.email = this.$store.state.newCustomer.email;
    this.birthday = this.$store.state.newCustomer.birthday;
    this.phone = this.$store.state.newCustomer.phone;
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}
</style>
