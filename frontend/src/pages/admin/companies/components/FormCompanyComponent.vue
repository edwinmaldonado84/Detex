<template>
    <q-dialog v-model="show" transition-show="rotate" transition-hide="rotate">
        <q-card style="width: 700px; max-width: 80vw">
            <q-card-section
                class="flex items-center q-py-sm bg-primary q-px-lg"
            >
                <div
                    class="text-h4 text-white"
                    v-text="props.datas.length > 0 ? 'Edit' : 'New'"
                />

                <q-space />
                <q-btn
                    icon="close"
                    size="lg"
                    color="white"
                    flat
                    v-close-popup
                />
            </q-card-section>

            <q-card-section class="q-pa-xl rounded">
                <q-form ref="Form" class="q-gutter-sm">
                    <q-input
                        v-model="form.name"
                        clearable
                        type="text"
                        :label="$t('inputs.name')"
                        :rules="[
                            (val) =>
                                !v$.name.$error || v$.name.$errors[0].$message,
                        ]"
                    >
                        <template v-slot:before>
                            <q-icon name="business" />
                        </template>
                    </q-input>

                    <q-input
                        v-model="form.owner"
                        clearable
                        type="text"
                        :label="$t('inputs.owner')"
                    >
                        <template v-slot:before>
                            <q-icon name="person" />
                        </template>
                    </q-input>

                    <q-input
                        v-model="form.rfc"
                        clearable
                        type="text"
                        :label="$t('inputs.rfc')"
                        :rules="[true]"
                    >
                        <template v-slot:before>
                            <q-icon name="qr_code" />
                        </template>
                    </q-input>

                    <q-input
                        v-model="form.phone"
                        clearable
                        type="phone"
                        :label="$t('inputs.phone')"
                        :rules="[true]"
                    >
                        <template v-slot:before>
                            <q-icon name="phone_iphone" />
                        </template>
                    </q-input>

                    <q-input
                        v-model="form.address"
                        clearable
                        type="text"
                        :label="$t('inputs.address')"
                        :rules="[true]"
                    >
                        <template v-slot:before>
                            <q-icon name="location_on" />
                        </template>
                    </q-input>
                </q-form>
            </q-card-section>
            <q-card-actions
                align="right"
                class="row no-wrap items-center q-py-md q-pa-sm bg-grey-3"
            >
                <q-btn
                    outline
                    label="Cancel"
                    color="negative"
                    v-close-popup
                    class="btn"
                />
                <q-btn
                    outline
                    label="Save"
                    color="positive"
                    v-close-popup
                    class="btn"
                    :disable="v$.$invalid"
                />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup>
import { useVuelidate } from "@vuelidate/core";
import { ref, watch, onMounted } from "vue";
import { rules, form } from "../validations";

const props = defineProps({
    datas: Object,
});

const show = ref(true);
const emit = defineEmits(["clean", "update:show"]);

const v$ = useVuelidate(rules, form);

watch(show, (val) => {
    if (!val) {
        emit("update:show", false);
        emit("clean");
    }
});
onMounted(() => {
    console.log("datas", props.datas);
    if (props.datas) {
        Object.keys(form).forEach((key) => {
            form[key] = props.datas[key];
        });
    }
});
</script>

<style lang="sass">
.container
    width: "2000px"

.btn
    width: 150px
    text-transform: capitalize
</style>
