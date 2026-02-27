<template>
  <div>
    <h1>Calculator</h1><br>
    
    <label>Weight (kg):</label>
    <input type="number" v-model.number="weight"><br><br>

    <ul>
      <li v-for="(item, index) in carriers" :key="index"  @click="selectCarrier(item)">
        {{ item }}
      </li>
    </ul>

    <button @click="send">Calculate</button>

    <p id="answer">{{ answer }}</p>
  </div>
</template>


<script>
export default {
  name: "Main",
  data(){
    return {
      carriers: [],
      selectedCarrier: "",
      weight: 0,
      answer: ""
    }
  },
  async created(){
    const HOST = "localhost";
    try {
      const response = await fetch(`http://${HOST}/carriers`);
      if(!response.ok) throw new Error("Failed to fetch carriers");
      const data = await response.json();

      this.carriers = data;
      console.log(data);
    } catch(err){
      console.error(err);
    }
  },
  methods: {
    selectCarrier(carrier) {
      this.selectedCarrier = carrier;
    },
    validate(weight, carrier) {
      if (weight <= 0) {
        alert("wrong weight");
        return false;
      }
      if(typeof weight !== "number"){
        alert("Weight must be a number");
        return false;
      }
      if (!carrier) {
        alert("Please select a carrier");
        return false;
      }
      return true;
    },
    async send(){
      const HOST = "localhost"; 
      const payload = {
        weightKg: this.weight,
        carrier: this.selectedCarrier
      };
      try {
        if(!this.validate(this.weight,this.selectedCarrier)){
          return
        }
        const response = await fetch(`http://${HOST}/calculate`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
        if(!response.ok){
          const err = await response.json();
          console.error(err.error || "Failed to calculate");
          return;
        }
        const res = await response.json();
        this.answer = `${res.shippingCost} ${res.currency}`;
      } catch(err){
        console.error(err);
      }
    }
  }
};
</script>

<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}

li {
  padding: 8px 12px;
  margin-bottom: 4px;
  cursor: pointer;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition: background-color 0.2s, color 0.2s;
}

li:hover {
  background-color: #f0f0f0;
}

li.selected {
  background-color: #007bff;
  color: white;
  font-weight: bold;
}
</style>