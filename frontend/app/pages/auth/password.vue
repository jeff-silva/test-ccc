<template>
  <nuxt-layout name="admin">
    <form @submit.prevent="request.submit()">
      <q-card
        v-if="request.response"
        :class="{
          'bg-primary text-white': request.response.message_type == 'info',
          'bg-positive text-white': request.response.message_type == 'success',
          'bg-negative text-white': request.response.message_type == 'error',
        }"
      >
        <q-card-section>{{ request.response.message }}</q-card-section>
      </q-card>
      <br />

      <q-input
        v-model="request.data.email"
        label="E-mail"
        :error-message="request.getError('email')"
        :error="!!request.getError('email')"
      />
      <q-input
        v-model="request.data.password_reset_token"
        label="Código de recuperação"
        :error-message="request.getError('password_reset_token')"
        :error="!!request.getError('password_reset_token')"
      />
      <q-input
        v-model="request.data.password"
        type="password"
        label="Nova Senha"
        :error-message="request.getError('password')"
        :error="!!request.getError('password')"
      />
      <q-input
        v-model="request.data.password_confirmation"
        type="password"
        label="Repita Nova Senha"
        :error-message="request.getError('password_confirmation')"
        :error="!!request.getError('password_confirmation')"
      />
      <div class="row justify-end q-py-md q-gutter-md">
        <q-btn
          type="submit"
          color="primary"
          glossy
          label="Cadastrar"
          :loading="request.busy"
        />
      </div>
    </form>
  </nuxt-layout>
</template>

<script setup>
const request = useAxios({
  method: "post",
  url: "/api/auth/password",
  data: {},
  onSuccess() {
    if (request.response.step == "finish") {
      request.data = {};
    }
  },
});
</script>
