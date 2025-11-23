<template>
  <div class="vehicle-cost-calculator">
    <h1>Vehicle Cost Calculator</h1>

    <div class="input-group">
      <label>Base Price ($):</label>
      <input type="number" v-model.number="basePrice" min="0" />
    </div>

    <div class="input-group">
      <label>Vehicle Type:</label>
      <select v-model="vehicleType">
        <option value="standard">Standard</option>
        <option value="luxury">Luxury</option>
      </select>
    </div>

    <p>Fees:</p>
    <ul>
      <li v-for="fee in fees" :key="fee.name">
        {{ fee.name }}: ${{ fee.amount.toFixed(2) }}
      </li>
    </ul>

    <p>Total Cost: ${{ totalCost.toFixed(2) }}</p>
  </div>
</template>

<script setup>
import { useVehicleForm } from './vehicleFormLogic.js'

const { basePrice, vehicleType, fees, totalCost } = useVehicleForm()
</script>
