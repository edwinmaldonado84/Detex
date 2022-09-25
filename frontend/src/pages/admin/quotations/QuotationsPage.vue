<template>
    <div class="tw-p-5">
        <q-card class="tw-p-4">
            <q-card-section class="tw-p-4">
                <span
                    v-text="$t(route.meta.title)"
                    class="tw-my-1 tw-text-4xl tw-text-primary text-weight-bolder"
                />
            </q-card-section>

            <q-card-section>
                <q-stepper
                    v-model="step"
                    ref="stepper"
                    color="primary"
                    animated
                    class="tw-shadow-none"
                >
                    <q-step
                        :name="1"
                        :title="$t('stepers.general_data')"
                        icon="settings"
                        :done="step > 1"
                    >
                        <DeGeneralDatas />
                    </q-step>

                    <q-step
                        :name="2"
                        :title="$t('stepers.items')"
                        icon="shopping_basket"
                        :done="step > 2"
                    >
                        An ad group contains one or more ads which target a
                        shared set of keywords.
                    </q-step>

                    <q-step :name="3" title="PDF" icon="picture_as_pdf" disable>
                        This step won't show up because it is disabled.
                    </q-step>

                    <template v-slot:navigation>
                        <q-stepper-navigation>
                            <q-btn
                                @click="$refs.stepper.next()"
                                color="primary"
                                :label="step === 4 ? 'Finish' : 'Continue'"
                            />
                            <q-btn
                                v-if="step > 1"
                                flat
                                color="primary"
                                @click="$refs.stepper.previous()"
                                label="Back"
                                class="q-ml-sm"
                            />
                        </q-stepper-navigation>
                    </template>
                </q-stepper>
            </q-card-section>
        </q-card>
    </div>
</template>
<script setup>
import DeGeneralDatas from "./components/DeGeneralDatas.vue";
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const step = ref(1);
</script>
