<template>
  <div>
    <div class="topnav" id="myTopnav">
      <a href="/" class="active">{{ userName }}</a>
      <span class="loader" v-if="!userName"></span>

      <router-link
        to="/"
        class="button-exit button button-default"
        @click="logout"
        >Sair</router-link
      >
      <router-link to="/customer/profile" class="link link-titles" v-if="renderPerfil"
        >Perfil</router-link
      >

      <a href="javascript:void(0);" class="icon" @click="showMenu()">
        <span class="material-icons"> menu </span>
      </a>
    </div>

    <div class="main-system">
      <slot></slot>
    </div>
  </div>
</template>
<script>
import customers from "../services/customers.js";
import user from "../services/user.js";

export default {
  name: "TemplateSystem",
  data() {
    return {
      userName: "",
      renderPerfil: false,
    };
  },
  methods: {
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    showMenu() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    },
    async searchName() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await customers.index(token);
        this.userName = response.data.name;
      } catch (error) {
        console.error(error);
      }
    },
    async logout() {
      const token = this.$store.state.authenticatedUser.token;

      try {
        await user.logout(token);
      } catch (error) {
        console.error(error);
      }
    },
  },
  created() {
    this.searchName();
    this.renderPerfil =
      this.$store.state.authenticatedUser.profile == 1 ? true : false;
  },
};
</script>
<style scoped lang="scss">
@import "./../styles/variables.scss";

.main-system {
  background-color: $bg-color-2;
  box-shadow: inset 0 7px 9px -7px rgba(0, 0, 0, 0.4);
  min-height: 91vh;
}

//************* Responsividade ****************
.material-icons {
  font-size: 15px;
}

/* Add a black background color to the top navigation */
.topnav {
  background-color: #fff;
  overflow: hidden;
  margin: 0.5em;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: right;
  display: block;
  text-align: center;
  padding: 13px 16px;
  text-decoration: none;
  font-size: 17px;

  &:first-child {
    float: left;
  }
}

/* Add an active class to highlight the current page */
.topnav a.active {
  background-color: #fff;
  color: #000;
}

/* Hide the link that should open and close the topnav on small screens */
.topnav .icon {
  display: none;
  color: $primary-color;
}

.button-exit {
  max-height: 20px !important;
}

/* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
@media screen and (max-width: 600px) {
  .topnav.responsive {
    position: relative;
  }
  .topnav.responsive a.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>