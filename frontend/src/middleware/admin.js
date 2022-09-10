import store from "@/store";

export default (to, from, next) => {
  if (store.getters.checkAuth) {
    if (store.getters.user.role == "SuperAdmin") {
      next();
    } else {
      next({ name: "Forbidden" });
    }
  } else {
    next({ name: "Forbidden" });
  }
};
