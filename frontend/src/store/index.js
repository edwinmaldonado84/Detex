import { createStore } from "vuex";
import getters from "./getters";

const context = import.meta.glob("./modules/*.js", { eager: true });

const modules = Object.keys(context)
    .map((path) => {
        name = path.replace("./modules/", "");
        name = name.replace(/(^.\/)|(\.js$)/g, "");

        return [name, context[path].default];
    })
    .reduce((modules, [name, module]) => {
        return {
            ...modules,
            [name]: module,
        };
    }, {});

const store = createStore({
    modules,
    getters,
});

export default store;
