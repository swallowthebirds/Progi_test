import { ref, watch } from 'vue'

export function useVehicleForm() {
  const basePrice = ref(0)
  const vehicleType = ref('standard')
  const fees = ref([])
  const totalCost = ref(0)

  async function calculateCost() {
    try {
      const res = await fetch('/api/calculate-cost', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          basePrice: basePrice.value,
          vehicleType: vehicleType.value
        })
      })
      const data = await res.json()
      if (res.ok) {
        fees.value = data.fees
        totalCost.value = data.totalCost
      } else {
        console.error(data.error)
      }
    } catch (err) {
      console.error(err.message)
    }
  }

  watch([basePrice, vehicleType], calculateCost, { immediate: true })

  return {
    basePrice,
    vehicleType,
    fees,
    totalCost
  }
}
