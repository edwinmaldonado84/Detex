<template>
    <div class="q-pa-md q-gutter-md">
        <q-btn color="primary" @click="visible = true"> Show it </q-btn>

        <q-card class="bg-grey-3 relative-position card-example h-full">
            <q-card-section class="q-pb-none">
                <div class="text-h6">Lorem Ipsum</div>
            </q-card-section>

            <q-card-section>
                <transition
                    appear
                    enter-active-class="animated fadeIn"
                    leave-active-class="animated fadeOut"
                >
                    <div v-show="showSimulatedReturnData">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Praesent vel magna eu risus laoreet tristique. Nulla ut
                        fermentum elit, nec consequat augue. Morbi et dolor nec
                        metus tincidunt pellentesque. Nullam non semper ante.
                        Fusce pellentesque sagittis felis quis porta. Aenean
                        condimentum neque sed erat suscipit malesuada. Nulla
                        eget rhoncus enim. Duis dictum interdum eros.
                    </div>
                </transition>
            </q-card-section>

            <q-inner-loading :showing="visible">
                <q-spinner-gears size="200px" color="primary" />
            </q-inner-loading>
        </q-card>
    </div>
</template>
<script setup>
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";

const router = useRouter();
const { params } = useRoute();
const { id } = params;
const visible = ref(false);

/* setTimeout(() => {
    router.replace({ path: "/" + id });
}, 30000); */
</script>
