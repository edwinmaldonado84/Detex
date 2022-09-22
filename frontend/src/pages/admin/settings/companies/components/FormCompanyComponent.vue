<template>
    <q-dialog v-model="show" transition-show="rotate" transition-hide="rotate">
        <q-card style="width: 700px; max-width: 80vw">
            <q-card-section
                class="flex items-center q-py-sm bg-primary q-px-lg"
            >
                <div
                    class="text-h4 text-white"
                    v-text="
                        props.datas.length > 0
                            ? $t('general.edit')
                            : $t('general.new')
                    "
                />

                <q-space />
                <q-btn outline color="white" icon="close" v-close-popup />
            </q-card-section>

            <q-card-section class="q-pa-xl rounded">
                <q-form ref="Form" class="q-gutter-sm">
                    <q-input
                        v-model="form.name"
                        clearable
                        autogrow
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
                        autogrow
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
                        autogrow
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
                        autogrow
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
                        autogrow
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
                    :label="$t('buttons.cancel')"
                    color="negative"
                    v-close-popup
                    icon="cancel"
                    class="tw-w-32 text-capitalize"
                />
                <q-btn
                    outline
                    :label="$t('buttons.save')"
                    color="positive"
                    v-close-popup
                    :disable="v$.$invalid"
                    icon="save"
                    class="tw-w-32 text-capitalize"
                />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script setup>
import { useVuelidate } from "@vuelidate/core";
import { ref, watch, onMounted, onBeforeUnmount } from "vue";
import { rules, form } from "../validations";

const props = defineProps({
    datas: Object || String,
});

const show = ref(true);
const emit = defineEmits(["clean", "update:show"]);

const v$ = useVuelidate(rules, form);

watch(show, (val) => {
    if (!val) {
        emit("clean");
        emit("update:show", false);
    }
});
onMounted(() => {
    Object.keys(form).forEach((key) => {
        form[key] = props.datas.length > 0 ? props.datas[0][key] : null;
    });
});
</script>
