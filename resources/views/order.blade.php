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
            <h3>Please select a meal</h3>
            <select v-model="mealId">
                <option v-for="meal in meals" :value="meal.id">
                    @{{ meal.name }}
                </option>
            </select>
            <h3>Please enter number off people</h3>
            <input type="number" id="numberPeople" v-model="numberPeople">
        </div>
        <div id="step2" :class="[currentStep == 2 ? 'show' : 'hide', 'tabcontent']">
            <h3>Please select a restaurant</h3>
            <select v-model="restaurantId">
                <option v-for="restaurant in restaurants" :value="restaurant.id">
                    @{{ restaurant.name }}
                </option>
            </select>
        </div>
        <div id="step3" :class="[currentStep == 3 ? 'show' : 'hide', 'tabcontent']">
            <div class="space-between" style="width: 50%;">
                <div>
                    <h3>Please select a dish</h3>
                    <select >
                        <option>dish</option>
                    </select>
                </div>
                <div>
                    <h3>Please enter no of servings</h3>
                    <input type="number" id="noServings">
                </div>
            </div>

            <button class="mt-20">+</button>
        </div>
        <div id="preview" :class="[currentStep == 4 ? 'show' : 'hide', 'tabcontent']">
            <div class="space-between" style="width: 50%;">
                <p>meal</p>
                <p>lunch</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <p>No of people</p>
                <p>3</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <p>Restaurant</p>
                <p>Restaurant A</p>
            </div>
            <div class="space-between" style="width: 50%;">
                <div>Dishes</div>
                <div class="dishes">
                    <p>dish A - 1</p>
                    <p>dish B - 2</p>
                    <p>dish C - 3</p>
                </div>
            </div>
        </div>
        <div class="space-between mt-20">
            <button :class="[currentStep == 1 ? 'hide' : 'show']" @click="handlePrevious">Previous</button>
            <button :class="[currentStep == 4 ? 'hide' : 'show']" @click="handleNext">Next</button>
            <button :class="[currentStep == 4 ? 'show' : 'hide']" >Submit</button>
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
                numberPeople: 0,
                mealId: null,
                restaurantId: null,
            },
            computed: {

            },

            watch: {

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
            }
        });
    </script>
</body>

</html>
