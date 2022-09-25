<template>
    <div>
        <q-form ref="Form" class="q-gutter-sm">
            <div class="tw-flex tw-flex-row tw-justify-between">
                <DeGroupsSelectComponent
                    v-model="form.group"
                    class="tw-basis-3/12"
                />
                <DeCompaniesSelectComponent
                    v-model="form.company"
                    class="tw-basis-3/12"
                    :dependent="true"
                    :group-id="form.group?.id"
                />

                <DeContactsSelectComponent
                    v-model="form.contact"
                    class="tw-basis-4/12"
                    :dependent="true"
                    :company-id="form.company?.id"
                />
            </div>
        </q-form>
    </div>
</template>

<script setup>
import { useVuelidate } from "@vuelidate/core";
import { ref, watch, onMounted, onBeforeUnmount } from "vue";
import { rules, form } from "../validations";

const loading = ref(true);
// const emit = defineEmits(["clean", "update:show"]);
const v$ = useVuelidate(rules, form);
</script>
