<template>
  <div>
    <nuxt-page :ready="app.ready" />
  </div>
</template>

<script setup>
const app = useApp();
app.init();
</script>
