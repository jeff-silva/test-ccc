import axios from "axios";

export default (options = {}) => {
  options = {
    method: "get",
    url: "",
    data: {},
    params: {},
    headers: {},
    response: null,
    onSuccess: () => null,
    onError: () => null,
    ...options,
  };

  let to;
  const r = reactive({
    ...options,
    busy: false,
    error: null,
    hasErrors() {
      if (!r.error) return false;
      if (!r.error.response) return false;
      if (!r.error.response.errors) return false;
      return true;
    },
    getError(field) {
      if (!r.hasErrors()) return null;
      const message = r.error.response.errors[field] || null;
      return (message || []).join(", ");
    },
    axiosOptions() {
      const opts = {
        method: "get",
        url: "",
        data: {},
        params: {},
        headers: {},
      };

      for (let attr in opts) {
        let value = options[attr] || opts[attr] || null;
        if (typeof value == "function") {
          value = value();
        }
        opts[attr] = value;
      }

      if (opts.headers["Authorization"]) {
        delete opts.headers["Authorization"];
      }

      if (opts.url && opts.url.startsWith("/api")) {
        opts.url = opts.url.replace("/api", "http://localhost:8000/api");

        const access_token = localStorage.getItem("access_token") || null;
        if (access_token) {
          opts.headers["Authorization"] = `Bearer ${access_token}`;
        }
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
            options.onSuccess(r.response);
          } catch (err) {
            r.error = {
              name: err.name || null,
              message: err.message || null,
              stack: err.stack || null,
              code: err.code || null,
              status: err.status || null,
              response: err.response?.data || null,
            };
            reject(err);
            options.onError(r);
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
