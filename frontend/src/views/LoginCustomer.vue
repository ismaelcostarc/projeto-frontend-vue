<template>
  <div class="container bg screen">
    <div class="card card-login card-mobile">
      <header>
        <h1>Seja Bem Vindo!</h1>
      </header>

      <form class="form-login" @submit.prevent="login">
        <input
          type="text"
          placeholder="Seu CPF"
          class="input input-login text"
          v-mask="'###.###.###-##'"
          v-model="cpf"
          required
        />

        <eye-password top="15px" left="255px" @swap="swapPasswordVisibility">
          <input
            :type="typePassword"
            placeholder="Sua senha"
            class="input input-login text"
            v-model="password"
            required
          />
        </eye-password>
        <button type="submit" class="button button-default">Entrar</button>
      </form>

      <footer class="group-link">
        <router-link to="/cpf-checking" class="link"
          >Não possui cadastro?</router-link
        >
        <!-- <router-link to="/" class="link">Login Administrativo</router-link> -->
      </footer>
    </div>
  </div>
</template>
<script>
import customers from "../services/customers.js";
import user from "../services/user.js";
import cpfIsValid from "../assets/cpfIsValid.js";
import EyePassword from "../components/EyePassword.vue";
import "../assets/toast.js";

export default {
  name: "LoginCustomer",
  components: { EyePassword },
  data() {
    return {
      cpf: "",
      password: "",
      typePassword: "password",
    };
  },
  methods: {
    async login() {
      const formattedCPF = this.cpf.replaceAll(".", "").replace("-", "");
      if (cpfIsValid(formattedCPF)) {
        try {
          const response = await user.login(formattedCPF, this.password);
          const token = response.data.bearer_token;
          this.$store.commit("setToken", token);
          this.$store.commit("setProfile", 1);

          this.$store.commit("setCPF", "");
          this.$store.commit("setPassword", "");
          this.$store.commit("setName", "");
          this.$store.commit("setEmail", "");
          this.$store.commit("setBirthday", "");
          this.$store.commit("setPhone", "");
          this.$store.commit("setCEP", "");
          this.$store.commit("setState", "");
          this.$store.commit("setCity", "");

          this.$router.push("/schedulings/list");
        } catch (error) {
          if (error.response == undefined) {
            this.$toasted.global.toastError(
              "Ocorreu um erro em nosso servidor, por favor tente novamente"
            );
          } else {
            if (error.response.status == 401) {
              this.$toasted.global.toastError(
                "O usuário com o CPF e senha informados não existe"
              );
            }
          }
        }
      } else {
        this.$toasted.global.toastError("Insira um CPF válido.");
      }
    },
    swapPasswordVisibility() {
      this.typePassword =
        this.typePassword === "password" ? "text" : "password";
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
