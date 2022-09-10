import { useRegisterSW } from "virtual:pwa-register/vue";
import { useQuasar, QSpinnerGears } from "quasar";

export default function () {
    const intervalMS = 10 * 1000;
    const $q = useQuasar();

    const { updateServiceWorker } = useRegisterSW({
        immediate: true,
        onRegistered(swRegistration) {
            swRegistration &&
                setInterval(() => {
                    swRegistration.update();
                }, intervalMS);
        },
        onNeedRefresh() {
            $q.notify({
                spinner: QSpinnerGears,
                group: false, // required to be updatable
                timeout: 0, // we want to be in control when it gets dismissed
                message: "Hay nuevas actualizaciones...",
                actions: [
                    {
                        label: "Update",
                        color: "white",
                        handler: () => {
                            updateWorker();
                        },
                    },
                ],
            });
        },
        onRegisterError(e) {
            handleSWRegisterError(e);
        },
    });
    function updateWorker() {
        updateServiceWorker();
    }
}
