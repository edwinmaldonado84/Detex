<template>
    <BarChart
        :chart-data="data"
        :options="options"
        css-classes="chart-container"
    />
</template>

<script setup>
import { ref, computed } from "vue";
import { BarChart } from "vue-chart-3";
import {
    Chart,
    BarController,
    CategoryScale,
    LinearScale,
    BarElement,
    Legend,
    Title,
    Tooltip,
} from "chart.js";

Chart.register(
    BarController,
    CategoryScale,
    LinearScale,
    BarElement,
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

const dataValues = ref([
    [1, 3, 5, 7, 2, 4, 6],
    [1, 5, 2, 6, 3, 7, 4],
]);

const data = computed(() => ({
    labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

    datasets: [
        {
            label: "Foo",
            data: dataValues.value[0],
            backgroundColor: "#268bd2",
        },
        {
            label: "Bar",
            data: dataValues.value[1],
            backgroundColor: "#2aa198",
        },
    ],
}));

const options = ref({
    plugins: {
        title: {
            text: "Bar",
        },
    },
});
</script>
