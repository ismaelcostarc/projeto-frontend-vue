<template>
  <div>
    <template-system>
      <main class="container">
        <modal v-if="modalDeleteProfileIsVisible">
          <div slot="header" class="delete-profile-title">
            <div></div>
            <h3>Deseja excluir sua conta?</h3>
            <div></div>
          </div>

          <div slot="body"></div>
          <div slot="footer">
            <div class="group-button">
              <button class="button button-warning" @click="deleteProfile()">
                Sim
              </button>
              <button
                class="button button-default"
                @click="modalDeleteProfileIsVisible = false"
              >
                Não
              </button>
            </div>
          </div>
        </modal>

        <!--
        <modal v-if="modalTypePasswordIsVisible">
          <div slot="header" class="delete-profile-title">
            <div></div>
            <div></div>
            <span
              class="material-icons close"
              @click="modalTypePasswordIsVisible = false"
            >
              close
            </span>
          </div>

          <div slot="body">
            <h3>Digite sua senha para excluir sua conta:</h3>
            <form
              class="type-password-modal-form"
              @submit.prevent="deleteProfileStep2()"
            >
              <eye-password
                top="13px"
                left="215px"
                @swap="swapPasswordToDeleteVisibility()"
              >
                <input
                  :type="typePasswordToDeleteProfile"
                  placeholder="******"
                  class="input input-system text"
                  v-model="passwordToDeleteProfile"
                  required
                />
              </eye-password>
              <button class="button button-warning">Excluir</button>
            </form>
          </div>
          <div slot="footer"></div>
        </modal>
-->
        <div class="card card-edit-profile card-mobile">
          <div class="card-header">
            <go-back-button></go-back-button>
            <h3>{{ customer.name }}</h3>
            <span
              class="material-icons trash"
              @click="modalDeleteProfileIsVisible = true"
            >
              delete
            </span>
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
                  v-mask="'##/##/####'"
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
                />
                <div class="warning">.</div>
              </div>

              <div class="column">
                <div class="label">Estado<span>:</span></div>
                <select v-model="state" class="input select-login">
                  <option selected value="">Escolha seu estado</option>
                  <option value="AC">AC</option>
                  <option value="AL">AL</option>
                  <option value="AP">AP</option>
                  <option value="AM">AM</option>
                  <option value="BA">BA</option>
                  <option value="CE">CE</option>
                  <option value="ES">ES</option>
                  <option value="GO">GO</option>
                  <option value="MA">MA</option>
                  <option value="MT">MT</option>
                  <option value="MS">MS</option>
                  <option value="MG">MG</option>
                  <option value="PA">PA</option>
                  <option value="PB">PB</option>
                  <option value="PR">PR</option>
                  <option value="PE">PE</option>
                  <option value="PI">PI</option>
                  <option value="RJ">RJ</option>
                  <option value="RN">RN</option>
                  <option value="RS">RS</option>
                  <option value="RO">RO</option>
                  <option value="RR">RR</option>
                  <option value="SC">SC</option>
                  <option value="SP">SP</option>
                  <option value="SE">SE</option>
                  <option value="TO">TO</option>
                  <option value="DF">DF</option>
                </select>
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
import Modal from "../components/Modal.vue";
import cpfIsValid from "../assets/cpfIsValid.js";
import customers from "../services/customers.js";

export default {
  components: { TemplateSystem, GoBackButton, EyePassword, Modal },
  name: "Profile",
  data() {
    return {
      customer: {},
      newPassword: "",
      inputCPFBorderColor: "#717171",
      warningValidCPFVisibility: "hidden",
      inputPasswordBorderColor: "#717171",
      warningPasswordLengthVisibility: "hidden",
      newPasswordRepeated: "",
      warningPasswordIsEqualVisibility: "hidden",
      inputPasswordRepeatedBorderColor: "#717171",
      warningValidBirthdayVisibility: "hidden",
      inputBirthdayBorderColor: "#717171",
      typePassword: "password",
      typePasswordRepeated: "password",
      modalDeleteProfileIsVisible: false,
      modalTypePasswordIsVisible: false,
      passwordToDeleteProfile: "",
      typePasswordToDeleteProfile: "password",
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
    checkCPF() {
      const formattedCPF = this.customer.cpf
        .replaceAll(".", "")
        .replace("-", "");
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
      //evita que o formulário seja enviado mesmo com os campos errados
      if (
        this.warningValidCPFVisibility === "visible" ||
        this.warningPasswordLengthVisibility === "visible" ||
        this.warningPasswordIsEqualVisibility === "visible" ||
        this.warningValidBirthdayVisibility === "visible"
      )
        return;

      //Evita que a pessoa digite o primeiro campo de senha, porém não o segundo
      if (this.newPassword !== "" && this.newPasswordRepeated === "") {
        this.warningPasswordIsEqualVisibility = "visible";
        this.inputPasswordRepeatedBorderColor = "#FF5E5E";
        return;
      }

      const token = this.$store.state.authenticatedUser.token;
      const customerFormatted = { ...this.customer };
      //É necessário formatar alguns campos antes de enviar para a API
      customerFormatted.cpf = customerFormatted.cpf
        .replaceAll(".", "")
        .replace("-", "");
      customerFormatted.phone = customerFormatted.phone
        .replace("(", "")
        .replace(")", "")
        .replace("-", "")
        .replace(" ", "");
      if (customerFormatted.zipcode)
        customerFormatted.zipcode = customerFormatted.zipcode.replace("-", "");
      const birthArray = customerFormatted.birthday.split("/");
      customerFormatted.birthday = `${birthArray[2]}-${birthArray[1]}-${birthArray[0]}`;
      if (this.newPassword) {
        customerFormatted.password = this.newPassword;
      }
      //O campo que contém a informação de qual atendente criou o cliente jamais deve ser alterado
      delete customerFormatted.attendent_id;
      //timestamps criados pelo banco de dados
      delete customerFormatted.updated_at;
      delete customerFormatted.created_at;
      delete customerFormatted.deleted_at;

      try {
        const response = await customers.update(token, customerFormatted);
        this.$toasted.global.toastSuccess("Dados salvos com sucesso");
      } catch (error) {
        console.error(error);
      }
    },
    swapPasswordToDeleteVisibility() {
      this.typePasswordToDeleteProfile =
        this.typePasswordToDeleteProfile === "password" ? "text" : "password";
    },
    async deleteProfile() {
      const token = this.$store.state.authenticatedUser.token;
      try {
        const response = await customers.delete(token);
        console.log(response);

        this.$toasted.global.toastSuccess("Seu perfil foi excluído");
        this.$store.commit("SetToken", "");
        this.$store.commit("SetProfile", 0);

        this.$router.push("/");
      } catch (error) {
        console.error(error);
      }
    },
  },
  created() {
    this.searchCustomer();
  },
};
</script>
<style lang="scss" scoped>
@import "./../styles/variables.scss";

.card {
  margin-top: 2em;
  margin-bottom: 2em;
}

.trash {
  color: $warning;
  font-size: 25px;
  cursor: pointer;
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

.select-login {
  width: 18.7em;
}

.modal-header {
  margin-bottom: 1em;
  align-self: flex-end;
}

.group-button {
  & > .button-warning {
    margin-right: 2em;
  }
}

.delete-profile-title {
  text-align: center;
  display: flex;
  justify-content: space-between;
  margin-bottom: 1em;
  width: 350px;

  & > span {
    cursor: pointer;
  }
}

.type-password-modal-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  & > * {
    margin-top: 1em;
  }
}

//******************* Responsividade ****************/
@media screen and (max-width: 600px) {
  .card {
    margin-top: 0;
    margin-bottom: 0;
    border-top: 1px solid $primary-color;
  }

  .warning-required-inputs {
    align-self: center;
  }
}
</style>
