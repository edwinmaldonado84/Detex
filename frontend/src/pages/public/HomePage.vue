<template>
    <q-page
        class="bg-accent window-height window-width row justify-center items-center"
    >
        <q-card class="col-10 col-sm-6 col-md-4 col-lg-3 shadow-1">
            <q-card-section class="q-pa-none">
                <div class="flex q-pa-md justify-center bg-blue-10">
                    <svg
                        id="logo"
                        viewBox="0 0 483 483"
                        style="enable-background: new 0 0 460 460"
                        xml:space="preserve"
                        width="100px"
                        height="100px"
                        v-html="logo"
                    />
                </div>
            </q-card-section>

            <q-form
                ref="Form"
                @submit="login"
                class="q-gutter-md q-px-lg q-py-lg"
            >
                <q-card-section>
                    <!--     <button
                    class="teal raised full-width"
                    @click="startAnimation()"
                    v-text="'Animate'"
                /> -->

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
                    <q-input
                        v-model="password"
                        clearable
                        type="password"
                        :label="$t('inputs.password')"
                        :rules="[$rules.required, $rules.minPassword]"
                    >
                        <template v-slot:before>
                            <q-icon name="lock" />
                        </template>
                    </q-input>
                </q-card-section>
                <q-card-actions class="q-px-md">
                    <q-btn
                        outline
                        color="primary"
                        size="lg"
                        class="full-width text-capitalize"
                        :label="$t('buttons.login')"
                        type="submit"
                    />
                </q-card-actions>
            </q-form>
        </q-card>
    </q-page>
</template>
<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { useQuasar, QSpinnerGears, QSpinnerIos } from "quasar";
import logoData from "./logoData";
import Vivus from "vivus";
import { useMeta } from "vue-meta";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const router = useRouter();
const store = useStore();
const $q = useQuasar();
const logo = ref(logoData["Keytronic"]);
const vivus = ref("");
const email = ref("edwin.maldonado84@gmail.com");
const password = ref("apple123");
const Form = ref(null);
let timer;

$q.dark.set(false);

useMeta({
    title: "Login",
});

onMounted(() => {
    vivus.value = new Vivus(
        "logo",
        {
            duration: 400,
            forceRender: false,
        },
        function (element) {
            for (let item of element.el.children[0].children) {
                item.setAttribute("style", "fill:white");
                item.setAttribute("style", "fill:white");
            }
        }
    );
});

const login = async () => {
    Form.value.validate().then(async (success) => {
        if (success) {
            $q.loading.show({
                spinner: QSpinnerIos,
                message: "Validado las credenciales...",
            });

            const { data } = await axios
                .post("/api/login", {
                    email: email.value,
                    password: password.value,
                })
                .catch(function (error) {
                    $q.loading.hide();
                });

            // Save the token.
            store.dispatch("auth/setToken", {
                token: data.data.token,
            });

            await store.dispatch("auth/fetchUser");

            router.push({ name: "DashboardPage" });

            timer = setTimeout(() => {
                $q.loading.show({
                    spinner: QSpinnerGears,
                    spinnerColor: "white",
                    messageColor: "white",
                    backgroundColor: "gray",
                    message: "Cargando los componentes...",
                });

                timer = setTimeout(() => {
                    $q.loading.hide();
                    timer = void 0;
                }, 2000);
            }, 2000);
        } else {
            $q.notify({
                color: "green-4",
                textColor: "white",
                icon: "cloud_done",
                message: "Submitted",
            });
        }
    });
};

onBeforeUnmount(() => {
    if (timer !== void 0) {
        clearTimeout(timer);
        $q.loading.hide();
    }
});
</script>
<style lang="sass" scoped>
.container
    border: solid 1px red
    background-color: rgb(120, 120, 120)
.form-container
    border: solid 1px gray
</style>
