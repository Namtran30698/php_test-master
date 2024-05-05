<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/order.css') }}" rel="stylesheet">
</head>

<body>
    <h2>Tabs</h2>
    <p>Click on the buttons inside the tabbed menu:</p>
    <div id="app">
        <div class="tab">
            <button :class="[currentStep == 1 ? 'active' : '', 'tablinks']" >step1</button>
            <button :class="[currentStep == 2 ? 'active' : '', 'tablinks']" >step2</button>
            <button :class="[currentStep == 3 ? 'active' : '', 'tablinks']" >step3</button>
            <button :class="[currentStep == 4 ? 'active' : '', 'tablinks']" >preview</button>        
        </div>
        <div id="step1" :class="[currentStep == 1 ? 'show' : 'hide', 'tabcontent']">
            <form id="formStep1" @submit="checkFormStep1" >
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                    </ul>
                </p>
                <h3>Please select a meal</h3>
                <select v-model="mealId">
                    <option v-for="meal in meals" :value="meal.id">
                        @{{ meal.name }}
                    </option>
                </select>
                <h3>Please enter number of people</h3>
                <input type="number" id="numberPeople" v-model="numberPeople">
                <div class="space-between mt-20">
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
        <div id="step2" :class="[currentStep == 2 ? 'show' : 'hide', 'tabcontent']">
            <form id="formStep2" @submit="checkFormStep2" >
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                    </ul>
                </p>
                <h3>Please select a restaurant</h3>
                <select v-model="restaurantId">
                    <option v-for="restaurant in restaurants" :value="restaurant.id">
                        @{{ restaurant.name }}
                    </option>
                </select>
                <div class="space-between mt-20">
                    <button @click="handlePrevious">Previous</button>
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
        <div id="step3" :class="[currentStep == 3 ? 'show' : 'hide', 'tabcontent']">
            <form id="formStep3" @submit="checkFormStep3" >
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                    </ul>
                </p>
                <div class="space-between" style="width: 50%;">
                    <h3>Please select a dish</h3>
                    <h3>Please enter no of servings</h3>
                </div>

                <div v-for="(addedDish, index) in addedDishes" class="space-between" style="width: 50%;">
                    <div>
                        <select v-model="addedDish.name" >
                            <option :value="addedDish.name" :selected="true">@{{ addedDish.name }}</option>
                            <option v-for="dish in remainingDishes" :value="dish.name" >@{{ dish.name }}</option>
                        </select>
                    </div>
                    <div>
                        <input type="number" id="noOfServings" v-model="addedDishes[index].noOfServings">
                    </div>
                </div>

                <button :class="[remainingDishes.length == 0 ? 'hide' : 'show', 'mt-20']" @click="addSelectDish" type="button">+</button>
                <div class="space-between mt-20">
                    <button @click="handlePrevious">Previous</button>
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
        <div id="preview" :class="[currentStep == 4 ? 'show' : 'hide', 'tabcontent']">
            <div class="space-between" style="width: 50%;">
                <p>meal</p>
                <p>@{{ mealName }}</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <p>No of people</p>
                <p>@{{ numberPeople }}</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <p>Restaurant</p>
                <p>@{{ restaurantName }}</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <div>Dishes</div>
                <div class="dishes">
                    <p v-for="(addedDish, index) in addedDishes">@{{ addedDish.name }} - @{{ addedDish.noOfServings }}</p>
                </div>
            </div>
            <div class="space-between mt-20">
                <button @click="handlePrevious">Previous</button>
                <button @click="handleSubmit">Submit</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script type="text/javascript">
        const vue = new Vue({
            el: '#app',
            data: {
                currentStep: 1,
                meals: {{ Js::from($meals) }},
                restaurants: {{ Js::from($restaurants) }},
                numberPeople: null,
                mealId: null,
                mealName: null,
                restaurantName: null,
                restaurantId: null,
                dishes: [],
                addedDishes: [],
                remainingDishes: [],
                errors:[],
            },
            computed: {

            },

            watch: {
                mealId: function () {
                    this.mealName = this.meals.filter(meal => meal.id == this.mealId)[0].name;
                    this.getDishesData();
                    this.addedDishes = [];
                },
                restaurantId: function () {
                    this.restaurantName = this.restaurants.filter(restaurant => restaurant.id == this.restaurantId)[0].name;
                    this.getDishesData();
                    this.addedDishes = [];
                },
                addedDishes: {
                    handler: function () {
                        this.remainingDishes = this.dishes.filter(
                            dish => !this.addedDishes.some(obj => obj.name === dish.name)
                        );
                    },
                    deep: true
                }
            },
            mounted() {

            },
            methods: {
                handleNext() {
                    this.currentStep = this.currentStep + 1;
                },
                handlePrevious() {
                    this.currentStep = this.currentStep - 1;
                },
                getDishesData() {
                    axios.post('/dishes', { 
                        "mealId": this.mealId,
                        "restaurantId": this.restaurantId,
                    })
                    .then((response) => {
                        if (response.data.success) {
                            this.dishes= this.remainingDishes = response.data.data;
                        } else alert(response.data.message);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                },
                addSelectDish() {
                    this.addedDishes.push({name: "", noOfServings: 1});
                },
                checkFormStep1:function(e) {
                    this.errors = [];
                    if(!this.mealId) this.errors.push("meal is required");
                    if(!this.numberPeople) this.errors.push("number of people is required");
                    if(this.numberPeople > 10) {
                        this.errors.push("number of people max is 10");
                    }

                    if(this.errors.length == 0) {
                        this.handleNext();
                    }
                    e.preventDefault();
                },
                checkFormStep2:function(e) {
                    this.errors = [];
                    if(!this.restaurantId) this.errors.push("restaurant is required");
                    if(this.errors.length == 0) {
                        this.handleNext();
                    }
                    e.preventDefault();
                },
                checkFormStep3:function(e) {
                    this.errors = [];
                    const checkEmptyDishName = this.addedDishes.every(function(item) {
                        return item.name !== "";
                    });
                    if(this.addedDishes.length == 0) this.errors.push("dishes is required");
                    if(!checkEmptyDishName) this.errors.push("some items have not been selected yet");

                    const totalNoOfServings = this.addedDishes.reduce(function(total, item) {
                        return total + Number(item.noOfServings);
                    }, 0);

                    if(totalNoOfServings < this.numberPeople) 
                        this.errors.push("The total number of dishes must be greater than or equal to the number of people selected");
                    if(totalNoOfServings > 10) this.errors.push("The total number of dishes max is 10");

                    if(this.errors.length == 0) {
                        this.handleNext();
                    }
                    e.preventDefault();
                },
                handleSubmit() {
                    const dishesData = {
                        mealId: this.mealId,
                        numberPeople: this.numberPeople,
                        restaurantId: this.restaurantId,
                        dishes: this.addedDishes
                    }

                    console.log(dishesData);
                }
            }
        });
    </script>
</body>

</html>
