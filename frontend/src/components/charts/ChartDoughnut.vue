<template>
    <DoughnutChart
        :chart-data="data"
        :options="options"
        css-classes="chart-container"
    />
</template>

<script setup>
import { ref, computed } from "vue";
import { DoughnutChart } from "vue-chart-3";
import {
    Chart,
    DoughnutController,
    ArcElement,
    Legend,
    Title,
    Tooltip,
} from "chart.js";

Chart.register(DoughnutController, ArcElement, Legend, Title, Tooltip);

Chart.defaults.color = "#657b83";
Chart.defaults.borderColor = "rgba(147, 161, 161, 0.25)";
Chart.defaults.font.family = "'Fira Sans', 'sans-serif'";
Chart.defaults.font.size = 16;
Chart.defaults.font.lineHeight = 1.5;
Chart.defaults.layout.padding = 16;
Chart.defaults.plugins.legend.position = "bottom";
Chart.defaults.plugins.title.display = true;
Chart.defaults.plugins.title.padding = 16;

const dataValues = ref([10, 20, 40]);

const data = computed(() => ({
    labels: ["Foo", "Bar", "Baz"],

    datasets: [
        {
            data: dataValues.value,
            backgroundColor: ["#859900", "#d33682", "#cb4b16"],
        },
    ],
}));

const options = ref({
    elements: {
        arc: {
            borderColor: "#073642",
        },
    },

    plugins: {
        title: {
            text: "Doughnut",
        },
    },
});
</script>
