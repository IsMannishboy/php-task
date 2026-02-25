<template>
  <div>
    <h1>Calculator</h1><br>
    <p id="answer"></p>
    <input type="number" id="number"><br><br>
    <datalist>
        <option v-on:click="selectedcarrier = carrier.name"
        v-for="carrier in carriers" 
        :value="carrier.name"
      />
    </datalist><br><br>
    <button @click="send">Calculate</button>
  </div>
</template>

<script>
export default {
  name: "Main",
  data(){
    return {
      carriers: [],
      selectedcarrier:""
    }
  },
  async created(){
    const response = await fetch('http://localhost/carriers');
    if(!response.ok){
        console.error('Failed to fetch carriers');
        return;
    }
    const dannye = await response.json();
    this.carriers = dannye;
    console.log(dannye);
  },
  methods: {
    async send(){
        var weight = document.getElementById("number").value;
        var data = {
            weight: weight,
            carrier: this.selectedcarrier
        }
        const response = await fetch('http://back:8000/calculate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        if(!response.ok){
            console.error('Failed to calculate');
            return;
        }
        const res = await response.json();
        document.getElementById("answer").innerText = data.cost;
    }
  }

};
</script>

<style scoped>
h1 {
  color: blue;
}
</style>
