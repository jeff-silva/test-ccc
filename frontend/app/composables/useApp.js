export default () => {
  const r = reactive({
    ready: false,

    load: useAxios({
      method: "get",
      url: "/api/app/load",
      onSuccess() {
        r.user = r.load.response.user || null;
        r.ready = true;
      },
    }),

    user: null,

    init() {
      r.load.submit();
    },
  });

  return r;
};
