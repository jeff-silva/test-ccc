export default () => {
  const load = useAxios({
    method: "get",
    url: "/api/app/load",
  });

  const ready = computed(() => {
    return !load.busy;
  });

  const r = reactive({ ready, load });

  r.load.submit();
  return r;
};
