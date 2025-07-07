<template>
  <nuxt-layout name="admin">
    <div>
      <q-btn
        color="amber"
        glossy
        label="Load"
        :loading="test.busy"
        @click="test.submit()"
      />
      <pre>{{ test }}</pre>
    </div>
  </nuxt-layout>
</template>

<script setup>
const test = useAxios({
  method: "post",
  url: "/api/auth/login",
});
</script>
