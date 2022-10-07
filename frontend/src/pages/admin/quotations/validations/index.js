import { required, minLength } from "@vuelidate/validators";
import { reactive, ref, computed } from "vue";
import { date } from "quasar";

const timeStamp = Date.now();
const requiredNameLength = ref(5);
const today = date.formatDate(timeStamp, "DD-MMMM-YYYY");

export const rules = computed(() => ({
    name: {
        required,
        minLength: minLength(requiredNameLength.value),
    },
}));

export const form = reactive({
    group: null,
    company: null,
    contact: null,
    location: null,
    delivery_time: null,
    payment: null,
    observations: null,
    total: false,
    iva: false,
    date_of_issue: today,
});
