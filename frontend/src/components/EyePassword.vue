<template>
  <div class="container-icon">
    <span
      class="material-icons eye eye-opened"
      v-if="!eyeClosedPassword"
      @click="swapPasswordVisibility"
      :style="{'top': top, 'left': left}"
    >
      visibility_on
    </span>

    <span
      class="material-icons eye eye-closed"
      v-if="eyeClosedPassword"
      @click="swapPasswordVisibility"
      :style="{'top': top, 'left': left}"
    >
      visibility_off
    </span>
    <slot/>
  </div>
</template>
<script>
export default {
  name: "EyePassword",
  props: {
      top: {
          type: String,
          required: true
      },
      left: {
          type: String,
          required: true
      }
  },
  data() {
    return {
      eyeClosedPassword: true,
    }
  },
  methods: {
    swapPasswordVisibility() {
      this.eyeClosedPassword = !this.eyeClosedPassword;
      this.$emit("swap");
    },
  },
};
</script>
<style lang="scss" scoped>
@import "./../styles/variables.scss";

.container-icon {
  position: relative;
}
.eye {
  position: absolute;

  font-size: 1.3em;
  cursor: pointer;
  &-opened {
    color: $primary-color;
  }
  
  &-closed {
    color: $grey-light;
  }
}
</style>