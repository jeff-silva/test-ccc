export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.$q.iconMapFn = (icon) => {
    if (icon.startsWith("http://") || icon.startsWith("https://")) {
      icon = `img:${icon}`;
      return { icon };
    }

    if (icon.includes(":") && !icon.startsWith("img:")) {
      icon = `img:https://api.iconify.design/${icon}.svg`;
    }

    return { icon };
  };
});
