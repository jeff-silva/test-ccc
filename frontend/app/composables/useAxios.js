import axios from "axios";

export default (options = {}) => {
  options = {
    method: "get",
    url: "",
    data: {},
    params: {},
    headers: {},
    response: null,
    ...options,
  };

  let to;
  const r = reactive({
    ...options,
    busy: false,
    error: null,
    axiosOptions() {
      const opts = {
        method: "get",
        url: "",
        data: {},
        params: {},
        headers: {},
        ...options,
      };

      for (let attr in opts) {
        let value = opts[attr];
        if (typeof value == "function") {
          value = value();
        }
        opts[attr] = value;
      }

      if (opts.url && opts.url.startsWith("/api")) {
        opts.url = opts.url.replace("/api", "http://localhost:8000/api");
      }

      return opts;
    },
    submit() {
      return new Promise((resolve, reject) => {
        if (to) clearTimeout(to);
        to = setTimeout(async () => {
          r.error = null;
          r.busy = true;
          try {
            const opts = r.axiosOptions();
            const resp = await axios(opts);
            r.response = resp.data;
            resolve(resp);
          } catch (err) {
            reject(
              (r.error = {
                name: err.name || null,
                message: err.message || null,
                stack: err.stack || null,
                code: err.code || null,
                status: err.status || null,
                response: err.response || null,
              })
            );
          }
          r.busy = false;
        });
      });
    },
  });

  const opts = r.axiosOptions();
  for (let attr in opts) r[attr] = opts[attr];
  return r;
};
