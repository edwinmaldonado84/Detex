<template>
    <LineChart
        :chart-data="data"
        :options="options"
        css-classes="chart-container"
    />
</template>

<script setup>
import { ref, computed } from "vue";
import { LineChart } from "vue-chart-3";
import {
    Chart,
    LinearScale,
    LineElement,
    LineController,
    CategoryScale,
    PointElement,
    Legend,
    Title,
    Tooltip,
} from "chart.js";

Chart.register(
    LinearScale,
    LineElement,
    LineController,
    CategoryScale,
    PointElement,
    Legend,
    Title,
    Tooltip
);

Chart.defaults.color = "#657b83";
Chart.defaults.borderColor = "rgba(147, 161, 161, 0.25)";
Chart.defaults.font.family = "'Fira Sans', 'sans-serif'";
Chart.defaults.font.size = 16;
Chart.defaults.font.lineHeight = 1.5;
Chart.defaults.layout.padding = 16;
Chart.defaults.plugins.legend.position = "bottom";
Chart.defaults.plugins.title.display = true;
Chart.defaults.plugins.title.padding = 16;

const dataValues = ref([12, 14, 16, 18, 11, 13, 15]);

const data = computed(() => ({
    labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

    datasets: [
        {
            label: "Foo",
            data: dataValues.value,
            borderColor: "#dc322f",
        },
    ],
}));

const options = ref({
    scales: {
        y: {
            beginAtZero: true,
        },
    },

    plugins: {
        title: {
            text: "Line",
        },
    },
});
</script>
