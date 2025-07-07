<template>
  <nuxt-layout name="admin">
    <form @submit.prevent="login.submit()">
      <q-input
        v-model="login.data.email"
        label="E-mail"
        :error-message="login.getError('email')"
        :error="!!login.getError('email')"
      />
      <q-input
        v-model="login.data.password"
        type="password"
        label="Senha"
        :error-message="login.getError('password')"
        :error="!!login.getError('password')"
      />
      <div class="row justify-end q-py-md q-gutter-md">
        <q-btn
          type="submit"
          color="primary"
          glossy
          label="Login"
          :loading="login.busy"
        />
      </div>
    </form>
  </nuxt-layout>
</template>

<script setup>
const $q = useQuasar();
const app = useApp();

const login = useAxios({
  method: "post",
  url: "/api/auth/login",
  data: {},
  onSuccess() {
    login.data = {};
    localStorage.setItem("access_token", login.response.token.plainTextToken);
    setTimeout(() => app.init(), 1000);
    $q.notify({
      type: "positive",
      message: "Sucesso",
      caption: "Você está logado",
      position: "bottom",
      timeout: 10000,
      actions: [
        {
          label: "Fechar",
          color: "white",
        },
      ],
    });
  },
  onError() {
    $q.notify({
      type: "negative",
      message: "Erro",
      caption: login.error.response.message,
      position: "bottom",
      timeout: 10000,
      actions: [
        {
          label: "Fechar",
          color: "white",
        },
      ],
    });
  },
});
</script>
