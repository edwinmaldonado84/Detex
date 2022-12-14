import { required, minLength } from "@vuelidate/validators";
import { reactive, ref, computed } from "vue";
const requiredNameLength = ref(5);

export const rules = computed(() => ({
    name: {
        required,
        minLength: minLength(requiredNameLength.value),
    },
}));

export const form = reactive({
    name: null,
    owner: null,
    rfc: null,
    phone: null,
    address: null,
});
