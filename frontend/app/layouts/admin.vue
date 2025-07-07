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
    >
      <q-list>
        <template v-for="o in leftDrawer.nav">
          <template v-if="o.children.length > 0">
            <q-expansion-item
              :icon="o.icon"
              :label="o.title"
            >
              <q-list>
                <template v-for="oo in o.children">
                  <q-item
                    clickable
                    v-ripple
                    :to="oo.to || null"
                    style="padding-left: 25px"
                  >
                    <q-item-section>{{ oo.title }}</q-item-section>
                  </q-item>
                </template>
              </q-list>
            </q-expansion-item>
          </template>
          <template v-else>
            <q-item
              clickable
              v-ripple
              :to="o.to || null"
            >
              <q-item-section>{{ o.title }}</q-item-section>
            </q-item>
          </template>
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
  nav: computed(() => {
    const nav = [
      { title: "Dashboard", to: "/" },
      {
        title: "Autenticação",
        icon: "mdi:home",
        children: [
          { title: "Login", icon: "mdi:home", to: "/auth" },
          { title: "Cadastro", to: "/auth/register" },
          { title: "Alterar Senha", to: "/auth/password" },
        ],
      },
    ];

    const navParse = (items) => {
      return items.map((item) => {
        item = { title: "", icon: null, to: null, children: [], ...item };
        item.children = navParse(item.children);
        return item;
      });
    };

    return navParse(nav);
  }),
});

const rightDrawer = reactive({
  open: false,
  toggle() {
    rightDrawer.open = !rightDrawer.open;
  },
});
</script>
