// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2025-05-15",
  devtools: { enabled: true },
  ssr: false,
  modules: [
    ["@nuxt/icon", {}],
    ["@nuxt/scripts", {}],
    ["@vueuse/nuxt", {}],
    ["@pinia/nuxt", {}],
    [
      "nuxt-quasar-ui",
      {
        plugins: ["Notify"],
      },
    ],
    "@pinia/nuxt",
  ],
});
