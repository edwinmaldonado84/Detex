<template>
    <q-form ref="Form" class="q-gutter-sm tw-grid tw-grid-cols-3 tw-gap-10">
        <DeGroupsSelectComponent v-model="form.group" />
        <DeCompaniesSelectComponent
            v-model="form.company"
            :dependent="true"
            :group-id="form.group?.id"
        />

        <DeContactsSelectComponent
            v-model="form.contact"
            :dependent="true"
            :company-id="form.company?.id"
        />

        <q-input v-model="form.location" :label="$t('inputs.location')">
            <template v-slot:before>
                <q-icon name="location_on" />
            </template>
        </q-input>

        <q-input
            v-model="form.delivery_time"
            :label="$t('inputs.delivery_time')"
        >
            <template v-slot:before>
                <q-icon name="local_shipping" />
            </template>
        </q-input>

        <q-input v-model="form.payment" :label="$t('inputs.payment')">
            <template v-slot:before>
                <q-icon name="price_change" />
            </template>
        </q-input>

        <q-input
            v-model="form.observations"
            :label="$t('inputs.observations')"
            type="textarea"
            outline
        >
            <template v-slot:before>
                <q-icon name="info" />
            </template>
        </q-input>

        <q-checkbox v-model="form.total" label="Total" />

        <q-checkbox v-model="form.iva" label="I.V.A" />

        <q-input
            v-model="form.date_of_issue"
            :label="$t('inputs.payment')"
            readonly
        >
            <template v-slot:append>
                <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy>
                        <q-date
                            v-model="form.date_of_issue"
                            today-btn
                            mask="DD-MMMM-YYYY"
                        >
                            <div
                                class="row items-center justify-end q-gutter-sm"
                            >
                                <q-btn
                                    label="Cancel"
                                    color="primary"
                                    flat
                                    v-close-popup
                                />
                                <q-btn
                                    label="OK"
                                    color="primary"
                                    flat
                                    @click="save"
                                    v-close-popup
                                />
                            </div>
                        </q-date>
                    </q-popup-proxy>
                </q-icon>
            </template>
        </q-input>
    </q-form>
</template>

<script setup>
import { useVuelidate } from "@vuelidate/core";
import { ref, watch, onMounted, onBeforeUnmount } from "vue";
import { rules, form } from "../validations";

const loading = ref(true);
// const emit = defineEmits(["clean", "update:show"]);
const v$ = useVuelidate(rules, form);
</script>
