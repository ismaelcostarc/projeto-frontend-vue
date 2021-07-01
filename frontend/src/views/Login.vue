<template>
  <div class="container bg">
    <div class="card-login">
      <header>
        <h1>Seja Bem Vindo!</h1>
      </header>

      <form class="form-login">
        <input
          type="text"
          placeholder="Seu CPF"
          class="input-login text"
          v-mask="'###.###.###-##'"
          required
        />

        <input
          type="password"
          placeholder="Sua senha"
          class="input-login text"
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
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.bg {
  background-color: $bg-color-1;
}
</style>