<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
	
}
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&family=Roboto:wght@300;400&display=swap");
@import "./styles/variables.scss";

//**************** RESET *********************
html,
body,
div,
span,
applet,
object,
iframe,
h1,
h2,
h3,
h4,
h5,
h6,
p,
blockquote,
pre,
a,
abbr,
acronym,
address,
big,
cite,
code,
del,
dfn,
em,
img,
ins,
kbd,
q,
s,
samp,
small,
strike,
strong,
sub,
sup,
tt,
var,
b,
u,
i,
center,
dl,
dt,
dd,
ol,
ul,
li,
fieldset,
form,
label,
legend,
table,
caption,
tbody,
tfoot,
thead,
tr,
th,
td,
article,
aside,
canvas,
details,
embed,
figure,
figcaption,
footer,
header,
hgroup,
menu,
nav,
output,
ruby,
section,
summary,
time,
mark,
audio,
video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
menu,
nav,
section {
  display: block;
}
body {
  line-height: 1;
}
ol,
ul {
  list-style: none;
}
blockquote,
q {
  quotes: none;
}
blockquote:before,
blockquote:after,
q:before,
q:after {
  content: "";
  content: none;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}

input,
button {
  font: inherit;
}

//**********************************************
//Modificando tags padrões
h1 {
  font-size: 1.8em;
  font-weight: 300;
}

//Para remover o placeholder de date

//**********************************************
//Fontes
html {
  font-family: "Poppins", sans-serif;
}

.text {
  font-family: "Roboto", sans-serif;
}

//**********************************************
//Layout
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

//**********************************************
//Estilos Gerais
//Links
.link {
  color: $primary-color;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
}

.toast-error {
  background-color: $warning !important;
}

.toast-icon {
  color: #fff !important;
}

//**********************************************
//Componentes
.card-login {
  background-color: #fff;
  padding: 2em;
  border-radius: $border-radius-card;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  //min-width: 20vw;

  & > :not(:first-child) {
    margin-top: 2em;
  }
}

.form-login {
  display: flex;
  flex-direction: column;
  align-items: center;

  * {
    &:not(:first-child) {
      margin-top: 0.7em;
    }
  }

  button {
    width: 10em;
  }
}

.group-link {
  display: flex;
  flex-direction: column;
  align-items: center;

  *:not(:first-child) {
    margin-top: 1em;
  }
}

.input-login {
  border-radius: $border-radius-input-login;
  border-style: solid;
  border-width: 1px;
  border-color: $grey-light;
  padding: 0.7em;
  min-width: 15em;

  &:focus {
    outline: none;
  }
}

.select-login {
  background-color: #fff;
  min-width: 100%;
  font-family: 'Poppins', sans-serif;
  color: $grey-light;
}

.input-system {
}

.button {
  padding: 0.7em;
  border-radius: $border-radius-button;
  border: none;
  background-color: $primary-color;
  color: #fff;
  cursor: pointer;

  &:hover {
    filter: brightness(0.9);
  }
}
</style>
