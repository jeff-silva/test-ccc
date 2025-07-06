<template>
  <q-layout view="lHr lpR lFr">
    <q-header
      reveal
      elevated
      class="bg-primary text-white"
    >
      <q-toolbar>
        <q-btn
          dense
          flat
          round
          icon="menu"
          @click="leftDrawer.toggle()"
        />

        <q-toolbar-title> Title </q-toolbar-title>

        <q-btn
          dense
          flat
          round
          icon="menu"
          @click="rightDrawer.toggle()"
        />
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawer.open"
      side="left"
      bordered
    >
      <q-list
        bordered
        separator
      >
        <template v-for="o in leftDrawer.nav">
          <q-item
            clickable
            v-ripple
            :to="o.to || null"
          >
            <q-item-section>{{ o.title }}</q-item-section>
          </q-item>
        </template>
      </q-list>
    </q-drawer>

    <q-drawer
      v-model="rightDrawer.open"
      side="right"
      bordered
    >
      <!-- drawer content -->
    </q-drawer>

    <q-page-container>
      <div style="padding: 15px">
        <slot></slot>
        <icon
          name="mdi-home"
          size="50"
        />
        <!-- <pre>{{ { leftDrawer, rightDrawer } }}</pre> -->
      </div>
    </q-page-container>
  </q-layout>
</template>

<script setup>
const leftDrawer = reactive({
  open: true,
  toggle() {
    leftDrawer.open = !leftDrawer.open;
  },
  nav: [{ title: "Dashboard" }, { title: "Crud", to: "/crud" }],
});

const rightDrawer = reactive({
  open: false,
  toggle() {
    rightDrawer.open = !rightDrawer.open;
  },
});
</script>
