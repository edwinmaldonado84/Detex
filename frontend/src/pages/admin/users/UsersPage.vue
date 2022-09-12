<template>
    <div class="q-px-md">
        <q-layout view="lHh Lpr lFf" container style="height: 88vh">
            <q-input
                v-model="email"
                clearable
                type="email"
                :label="$t('inputs.email')"
                :rules="[$rules.required, $rules.email]"
            >
                <template v-slot:before>
                    <q-icon name="email" />
                </template>
            </q-input>
        </q-layout>
    </div>
</template>
<script setup>
import { useMeta } from "vue-meta";
import { ref } from "vue";
useMeta({
    title: "Users",
});

const email = ref(null);
</script>
