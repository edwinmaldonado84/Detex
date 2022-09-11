<template>
    <h1>Companies page</h1>

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
</template>

<script setup>
import { useMeta } from "vue-meta";
import { ref } from "vue";

const email = ref(null);
useMeta({
    title: "Companies",
});
</script>
