<template>
  <nuxt-page :ready="app.ready" />
</template>

<script setup>
const app = useApp();
app.init();
</script>
