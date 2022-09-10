import store from "@/store";

export default (to, from, next) => {
  if (store.getters.check && to.name == "Login") {
    next({ name: "Dashboard" });
  } else {
    next();
  }
};
