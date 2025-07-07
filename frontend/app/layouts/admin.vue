<template>
  <q-layout
    view="lHr lpR lFr"
    v-if="$props.ready"
  >
    <q-header
      reveal
      class="bg-transparent text-grey-9"
    >
      <q-toolbar>
        <q-btn
          dense
          flat
          round
          icon="menu"
          @click="leftDrawer.toggle()"
        />

        <!-- <q-toolbar-title> Title </q-toolbar-title> -->
        <!-- <q-space /> -->

        <!-- <q-btn
          dense
          flat
          round
          icon="menu"
          @click="rightDrawer.toggle()"
        /> -->
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawer.open"
      side="left"
      class="bg-grey-2 text-grey-9"
    >
      <template v-if="app.user">
        <div class="q-pa-md bg-grey-4">Bem vindo {{ app.user.name }}</div>
      </template>
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
                    v-bind="oo.bind"
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
              :icon="o.icon"
              v-bind="o.bind"
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
const $props = defineProps({
  ready: { type: Boolean, default: true },
});

const app = useApp();

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
      {
        title: "Usuários",
        icon: "material-symbols:account-box",
        children: [
          { title: "Listar", icon: "mdi:home", to: "/app_user" },
          { title: "Criar", to: "/app_user?edit=" },
        ],
      },
      {
        title: "Logout",
        icon: "bx:bxs-log-out",
        bind: {
          onClick() {
            app.logout();
          },
        },
      },
    ];

    const navParse = (items) => {
      return items.map((item) => {
        item = {
          title: "",
          icon: null,
          to: null,
          bind: {},
          children: [],
          ...item,
        };
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
