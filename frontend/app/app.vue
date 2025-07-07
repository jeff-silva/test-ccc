<template>
  <div>
    <pre>{{ app }}</pre>
    <div v-if="app.ready">aa</div>
    <!-- <div v-if="app.ready">
      <nuxt-page />
    </div> -->
  </div>
</template>

<script setup>
const app = useApp();
</script>
