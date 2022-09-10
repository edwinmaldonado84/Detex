import store from "@/store";

export default (to, from, next) => {
  if (store.getters.checkAuth) {
    if (store.getters.user.role == "Customer") {
      next();
    } else {
      next({ name: "Forbidden" });
    }
  } else {
    next({ name: "Forbidden" });
  }
};
