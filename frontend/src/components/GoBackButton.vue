<template>
  <div>
    <span class="material-icons" @click="$router.go(-1)"> chevron_left </span>
  </div>
</template>
<script>
export default {
  name: 'GoBackButton'
}
</script>
<style scoped>
span {
  cursor: pointer;
}
</style>