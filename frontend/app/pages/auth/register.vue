<template>
  <nuxt-layout name="admin">
    <form @submit.prevent="register.submit()">
      <q-input
        v-model="register.data.name"
        label="Nome"
        :error-message="register.getError('name')"
        :error="!!register.getError('name')"
      />
      <q-input
        v-model="register.data.email"
        label="E-mail"
        :error-message="register.getError('email')"
        :error="!!register.getError('email')"
      />
      <q-input
        v-model="register.data.password"
        type="password"
        label="Senha"
        :error-message="register.getError('password')"
        :error="!!register.getError('password')"
      />
      <q-input
        v-model="register.data.password_confirmation"
        type="password"
        label="Repita Senha"
        :error-message="register.getError('password_confirmation')"
        :error="!!register.getError('password_confirmation')"
      />
      <div class="row justify-end q-py-md q-gutter-md">
        <q-btn
          type="submit"
          color="primary"
          glossy
          label="Cadastrar"
          :loading="register.busy"
        />
      </div>
    </form>
  </nuxt-layout>
</template>

<script setup>
const register = useAxios({
  method: "post",
  url: "/api/auth/register",
  data: {},
  onSuccess() {
    register.data = {};
  },
});
</script>
