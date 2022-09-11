<template>
    <BarChart v-bind="barChartProps" css-classes="chart-container" />
</template>

<script setup>
import { ref, computed } from "vue";
import { BarChart, useBarChart } from "vue-chart-3";
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

const datas = ref([30, 40, 60, 70, 5, 0, 0]);

const chartData = computed(() => ({
    labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

    datasets: [
        {
            label: "Bar",
            data: datas.value,
            backgroundColor: [
                "#77CEFF",
                "#0079AF",
                "#123E6B",
                "#97B0C4",
                "#A5C8ED",
                "#A5C8ED",
                "#A5C8ED",
            ],
        },
    ],
}));

const { barChartProps, barChartRef } = useBarChart({
    chartData,
});
</script>
