<template>
    <PolarAreaChart v-bind="barChartProps" css-classes="chart-container" />
</template>

<script setup>
import { ref, computed } from "vue";
import { PolarAreaChart, useBarChart } from "vue-chart-3";
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

Chart.defaults.color = "#657b83";
Chart.defaults.borderColor = "rgba(147, 161, 161, 0.25)";
Chart.defaults.font.family = "'Fira Sans', 'sans-serif'";
Chart.defaults.font.size = 16;
Chart.defaults.font.lineHeight = 1.5;
Chart.defaults.layout.padding = 16;
Chart.defaults.plugins.legend.position = "bottom";
Chart.defaults.plugins.title.display = true;
Chart.defaults.plugins.title.padding = 16;

const datas = ref([11, 16, 7, 3, 14]);

const chartData = computed(() => ({
    labels: ["Red", "Green", "Yellow", "Grey", "Blue"],
    datasets: [
        {
            label: "My First Dataset",
            data: datas.value,
            backgroundColor: [
                "rgb(255, 99, 132)",
                "rgb(75, 192, 192)",
                "rgb(255, 205, 86)",
                "rgb(201, 203, 207)",
                "rgb(54, 162, 235)",
            ],
        },
    ],
}));

const { barChartProps, barChartRef } = useBarChart({
    chartData,
});
</script>
