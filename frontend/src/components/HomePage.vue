<template>
  <div class="welcome">
    <h1>Welcome to the Vehicle Fee Calculator</h1>
    <button @click="goToVehicleForm">Calculate Fees Now</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
const router = useRouter()

function goToVehicleForm() {
  router.push('/vehicle-form')
}
</script>
