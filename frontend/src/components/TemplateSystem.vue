<template>
  <div>
    <header>
      <span>{{ userName }}</span>
      <span>
        <router-link to="/" class="link">Perfil</router-link>
        <button class="button">Sair</button>
      </span>
    </header>
    <main class="container">
      <slot></slot>
    </main>
  </div>
</template>
<script>
import Customers from "../services/customers.js";

export default {
  name: "TemplateSystem",
  data() {
    return {
      userName: "",
    };
  },
  methods: {
    async searchName() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await Customers.index(token);
        this.userName = response.data.name;
      } catch (error) {
        console.error(error);
      }
    },
  },
  created() {
    this.searchName();
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

header {
  height: 4em;
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;

  &:first-child {
    margin-left: 2em;
  }
}

main {
  background-color: $bg-color-2;
}
</style>