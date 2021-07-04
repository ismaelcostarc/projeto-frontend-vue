<template>
  <div class="container screen">
    <div class="not-found card card-mobile">
      <h1>Ops, a página não existe.</h1>
      <div>
        <router-link to="/" class="link">Ir para a página inicial</router-link>
      </div>
    </div>
  </div>
</template>
<script>
</script>
<style scoped lang="scss">
@import './../styles/variables.scss';

.container {
  background-color: $bg-color-1;
}

.not-found {
  display: flex;
  flex-direction: column;
  align-items: center;

  >:last-child {
    margin-top: 2em;  
  }
}
</style>