<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js';
import { Bar } from 'vue-chartjs';
import { defineProps } from 'vue';

// Register Chart.js components
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

// defineProps<{
//   usersCount: number;
//   userChartData:any;
// }>();

const props = defineProps<{
  usersCount: number;
  userChartData:any;
}>();

console.log('userChartData',);

const chartData = {
  labels: props.userChartData.name,
  datasets: [
    {
      label: 'Users',
      backgroundColor: '#3B82F6',
      data: props.userChartData.mark
    }
  ]
};

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    </template>

    <div class="p-5 space-y-6">
      <div>Welcome</div>

      <div>
        Users Count:
        <span class="text-2xl font-bold text-blue-500">{{ props.usersCount }}</span>
      </div>

      <!-- Chart -->
      <div class="h-96 bg-white p-4 rounded shadow">
        <Bar :data="chartData" :options="chartOptions" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
