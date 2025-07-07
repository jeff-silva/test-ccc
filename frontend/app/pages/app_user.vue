<template>
  <nuxt-layout name="admin">
    <div v-if="isEditView">app_user edit</div>
    <div v-if="!isEditView">
      <q-table
        title="Usuários"
        :rows="search.response.data"
        :columns="[{ name: 'Nome', field: 'name', align: 'left' }]"
        row-key="name"
      />
    </div>
    <pre>{{ { search, $route, isEditView } }}</pre>
  </nuxt-layout>
</template>

<script setup>
const $route = useRoute();

const isEditView = computed(() => {
  return Object.keys($route.query).includes("edit");
});

const save = useAxios({
  method: "post",
  url: "/api/app_user",
});

const select = useAxios({
  method: "post",
  url: "/api/app_user",
});

const search = useAxios({
  method: "get",
  url: "/api/app_user",
  response: { data: [] },
});

const destroy = useAxios({
  method: "delete",
  url: "/api/app_user",
});

watch(
  () => $route.query,
  () => {
    if (!isEditView.value) search.submit();
  }
);

search.submit();
</script>
