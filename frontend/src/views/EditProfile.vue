<template>
  <div>
    <template-system>
      <main class="container">
        <div class="card card-edit-profile card-mobile">
          <div class="header">
            <go-back-button></go-back-button>
            <h3>{{ customer.name }}</h3>
            <router-link to="/customer/profile/edit">
              <span class="material-icons trash"> delete </span>
            </router-link>
          </div>
          <form class="edit-profile-form" @submit.prevent="update()">
            <div class="row">
              <div class="column">
                <div class="label">Nome<span>: *</span></div>
                <input
                  type="text"
                  v-model="customer.name"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">Data de Nascimento<span>: *</span></div>
                <input
                  type="text"
                  v-model="customer.birthday"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <div class="label">E-mail<span>: *</span></div>
                <input
                  type="text"
                  v-model="customer.email"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">CPF<span>: *</span></div>
                <input
                  type="text"
                  v-model="customer.cpf"
                  v-mask="'###.###.###-##'"
                  class="input input-system text"
                  :style="{ 'border-color': inputCPFBorderColor }"
                  @blur="checkCPF()"
                  required
                />
                <div
                  class="warning"
                  :style="{ visibility: warningValidCPFVisibility }"
                >
                  Insira um CPF válido
                </div>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <div class="label">Telefone<span>: *</span></div>
                <input
                  type="text"
                  v-model="customer.phone"
                  v-mask="'(##) #####-####'"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">CEP<span>:</span></div>
                <input
                  type="text"
                  v-model="customer.zipcode"
                  class="input input-system text"
                  v-mask="'#####-###'"
                  required
                />
                <div class="warning">.</div>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <div class="label">Cidade<span>:</span></div>
                <input
                  type="text"
                  v-model="customer.city"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">Estado<span>:</span></div>
                <input
                  type="text"
                  v-model="customer.state"
                  class="input input-system text"
                  required
                />
                <div class="warning">.</div>
              </div>
            </div>
            <div class="row">
              <div class="column">
                <div class="label">Nova Senha<span>:</span></div>
                <eye-password
                  @swap="swapPasswordVisibility()"
                  top="13px"
                  left="215px"
                >
                  <input
                    :type="typePassword"
                    v-model="newPassword"
                    class="input input-system text"
                    placeholder="******"
                    @blur="validatePassword"
                    :style="{ 'border-color': inputPasswordBorderColor }"
                  />
                </eye-password>

                <div
                  class="warning"
                  :style="{ visibility: warningPasswordLengthVisibility }"
                >
                  Senhas devem ter no mínimo 6 caracteres
                </div>
              </div>

              <div class="column">
                <div class="label">Repita a nova senha<span>:</span></div>
                <eye-password
                  @swap="swapPasswordRepeatedVisibility()"
                  top="13px"
                  left="215px"
                >
                  <input
                    :type="typePasswordRepeated"
                    v-model="newPasswordRepeated"
                    class="input input-system text"
                    placeholder="*******"
                    @blur="passwordIsEqual"
                    :style="{
                      'border-color': inputPasswordRepeatedBorderColor,
                    }"
                  />
                </eye-password>
                <div
                  class="warning"
                  :style="{ visibility: warningPasswordIsEqualVisibility }"
                >
                  As senhas informadas devem ser iguais
                </div>
              </div>
            </div>
            <div class="warning-required-inputs text">
              (*) Campos obrigatórios
            </div>
            <button class="button button-success">Salvar</button>
          </form>
        </div>
      </main>
    </template-system>
  </div>
</template>
<script>
import TemplateSystem from "../components/TemplateSystem.vue";
import GoBackButton from "../components/GoBackButton.vue";
import EyePassword from "../components/EyePassword.vue";
import cpfIsValid from "../assets/cpfIsValid.js";
import customers from "../services/customers.js";
import attendent from "../services/attendent.js";

export default {
  components: { TemplateSystem, GoBackButton, EyePassword },
  name: "Profile",
  data() {
    return {
      customer: {},
      attendentName: "",
      newPassword: "",
      inputCPFBorderColor: "#717171",
      warningValidCPFVisibility: "hidden",
      inputPasswordBorderColor: "#717171",
      warningPasswordLengthVisibility: "hidden",
      newPasswordRepeated: "",
      warningPasswordIsEqualVisibility: "hidden",
      inputPasswordRepeatedBorderColor: "#717171",
      typePassword: "password",
      typePasswordRepeated: "password",
    };
  },
  methods: {
    async searchCustomer() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await customers.index(token);
        //Antes de serem enviados para a Model, o campo de data é formatado para d/m/Y
        //Antes de ser enviado para a API deve ser formatada novamente para Y-m-d
        const dateArray = response.data.birthday.split("-");
        const dateFormatted = `${dateArray[2]}/${dateArray[1]}/${dateArray[0]}`;
        response.data.birthday = dateFormatted;
        this.customer = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async searchAttendent() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await attendent.index(token);
        this.attendentName = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    checkCPF() {
      const formattedCPF = this.customer.cpf.replaceAll('.', '').replace('-', '');
      if (!cpfIsValid(formattedCPF)) {
        this.warningValidCPFVisibility = "visible";
        this.inputCPFBorderColor = "#FF5E5E";
      } else {
        this.warningValidCPFVisibility = "hidden";
        this.inputCPFBorderColor = "#717171";
      }
    },
    validatePassword() {
      if (this.newPassword.length < 6) {
        this.warningPasswordLengthVisibility = "visible";
        this.inputPasswordBorderColor = "#FF5E5E";
      } else {
        this.warningPasswordLengthVisibility = "hidden";
        this.inputPasswordBorderColor = "#717171";
      }
    },
    passwordIsEqual() {
      if (this.newPassword !== this.newPasswordRepeated) {
        this.warningPasswordIsEqualVisibility = "visible";
        this.inputPasswordRepeatedBorderColor = "#FF5E5E";
      } else {
        this.warningPasswordIsEqualVisibility = "hidden";
        this.inputPasswordRepeatedBorderColor = "#717171";
      }
    },
    swapPasswordVisibility() {
      this.typePassword =
        this.typePassword === "password" ? "text" : "password";
    },
    swapPasswordRepeatedVisibility() {
      this.typePasswordRepeated =
        this.typePasswordRepeated === "password" ? "text" : "password";
    },
    async update() {

    }
  },
  created() {
    this.searchCustomer();
    this.searchAttendent();
  },
};
</script>
<style lang="scss" scoped>
@import "./../styles/variables.scss";

.card {
  margin-top: 2em;
  margin-bottom: 2em;
}

.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.trash {
  color: $warning;
}

.label {
  font-weight: 500;
  &:not(:last-child) {
    margin-bottom: 0.5em;
  }

  & > span {
    font-weight: 300;
  }
}

.row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  //justify-content: space-between;
}

.column {
  &:first-child {
    margin-right: 1em;
  }
}

.edit-profile-form {
  display: flex;
  flex-direction: column;
  align-items: center;

  .button {
    width: 7em;
  }
}

.warning-required-inputs {
  font-size: 0.9em;
  align-self: flex-start;
  margin-bottom: 1em;
}

.warning {
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  visibility: hidden;
}

//******************* Responsividade ****************/
@media screen and (max-width: 600px) {
  .card {
    margin-top: 0;
    margin-bottom: 0;
    border-top: 1px solid $primary-color;
  }

  .column {
    margin: 0 !important;
  }

  .warning-required-inputs {
    align-self: center;
  }
}
</style>
