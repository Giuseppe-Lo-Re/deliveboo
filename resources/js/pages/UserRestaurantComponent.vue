<template>

    <div>
        <JumbotronComponent/>
        <section class="ms_restaurants-cards-section">

            <!-- Filters Categories  -->
            <div class="category-filter-container">

                <!-- Category Title -->
                <h3 class="front-office-style">
                    Scegli la tua categoria
                </h3>

                <div class="categories-bar">
                    <svg class="checkbox-symbol">
                        <symbol id="check" viewbox="0 0 12 10">
                            <polyline
                            points="1.5 6 4.5 9 10.5 1"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            ></polyline>
                        </symbol>
                    </svg>

                    <!-- Loader Component -->
                    <LoaderComponent v-if="categories.length === 0"/>

                    <!-- Checkbox Container  -->
                    <div v-else class="checkbox-container">
                        <div v-for="category in categories" :key="category.id">
                            <input class="checkbox-input" :id="'category-' + category.id" type="checkbox" :value="category.id" v-model="selectedCategories" @change="getSelectedCategories()" :disabled="isWaiting ? '' : false"/>
                            <label class="checkbox" :for="'category-' + category.id">
                                <span>
                                <svg width="12px" height="10px">
                                    <use xlink:href="#check"></use>
                                </svg>
                                </span>

                                <!-- Category Name -->
                                <span>{{ category.name }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
                
            <!-- Restaurant Cards Container  -->
            <div>
                <!-- Loader Component -->
                <LoaderComponent v-if="isWaiting"/>

                <div v-else-if="users === null && categories.length !== 0">
                    <div class="fo-container">

                        <!-- Empty Category Message -->
                        <div class="ms_empty-category text-center">
                            Nessuna categoria selezionata
                        </div>
                    </div>
                </div>

                <div v-else-if="isEmpty">

                    <!-- Empty Restaurant Message -->
                    <div class="text-center ms_empty-category">
                        Nessun ristorante corrisponde alla tua selezione
                    </div>
                </div>
                    
                <!-- Restaurant Print -->
                <div v-else class="ms_restaurant-cards-container">
                    <div class="d-flex">
                        <router-link v-for="user in users" :key="user.id" :to="{name: 'products-page',params: {slug: user.slug} }" class="ms_restaurant-card">
                            <div class="img-container">
                                <img v-if="user.cover" :src="'storage/' + user.cover" :alt="user.business_name">
                                <svg v-else version="1.0" xmlns="http://www.w3.org/2000/svg"
                                    width="184.000000pt" height="137.000000pt" viewBox="0 0 184.000000 137.000000"
                                    preserveAspectRatio="xMidYMid meet">
                                    <g transform="translate(0.000000,137.000000) scale(0.100000,-0.100000)"
                                    fill="currentcolor" stroke="none">
                                    <path d="M915 1223 c-138 -18 -315 -63 -386 -99 -37 -19 -89 -74 -107 -114 -8
                                    -19 -18 -60 -21 -90 l-6 -55 -95 -12 c-145 -19 -159 -22 -170 -44 -13 -24 -5
                                    -56 19 -68 11 -6 64 -3 151 9 149 21 153 20 169 -37 l9 -31 -71 -10 c-94 -14
                                    -121 -48 -77 -92 21 -21 27 -21 121 -4 25 5 27 2 33 -47 4 -28 6 -53 4 -54 -2
                                    -2 -41 -8 -88 -14 -47 -7 -97 -14 -113 -17 -31 -6 -51 -36 -42 -64 11 -35 36
                                    -40 136 -25 119 18 119 18 119 -2 0 -25 69 -113 108 -140 50 -33 113 -41 247
                                    -32 66 4 219 13 340 19 238 12 279 22 338 78 70 66 85 141 69 357 -9 128 -9
                                    131 17 200 23 61 30 71 55 75 l29 5 -27 14 c-15 8 -29 26 -32 40 -16 82 -29
                                    109 -73 152 -51 52 -95 69 -240 94 -77 14 -335 19 -416 8z m470 -107 c39 -10
                                    84 -26 101 -37 29 -17 74 -83 64 -92 -3 -3 -39 0 -80 6 -147 19 -397 -26 -655
                                    -118 -178 -64 -169 -62 -185 -26 -27 66 -8 148 45 189 30 24 165 69 265 87
                                    101 19 350 14 445 -9z m155 -230 c0 -2 -7 -20 -16 -41 -17 -42 -19 -88 -9
                                    -286 6 -112 5 -141 -8 -165 -17 -32 -50 -66 -83 -82 -11 -6 -147 -18 -302 -27
                                    l-282 -17 -45 22 c-74 36 -86 65 -96 248 -5 86 -14 179 -20 205 -6 27 -10 50
                                    -8 51 5 4 793 93 837 95 17 0 32 -1 32 -3z"/>
                                    <path d="M1372 788 c-28 -28 -5 -108 32 -108 20 0 46 34 46 59 0 52 -46 81
                                    -78 49z"/>
                                    <path d="M982 768 c-7 -7 -12 -28 -12 -48 0 -57 39 -80 73 -42 43 47 -17 134
                                    -61 90z"/>
                                    <path d="M1143 673 c-8 -20 6 -32 43 -39 42 -8 94 12 94 35 0 15 -10 17 -66
                                    17 -42 -1 -68 -5 -71 -13z"/>
                                    <path d="M168 629 c-32 -12 -43 -40 -29 -68 15 -26 39 -33 81 -21 53 15 64 46
                                    30 80 -22 22 -40 24 -82 9z"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="ms_card-body">

                                <!-- Card Header -->
                                <div class="ms_card-heading">
                                    {{ user.business_name.slice(0, 20) }}<span v-if="user.business_name.length > 20">...</span>
                                </div>

                                <!-- Card Text -->
                                <div class="ms_card-text">
                                    <i class="ms_card-address fa-solid fa-location-dot"></i>
                                    {{ user.address.slice(0, 20) }}<span v-if="user.address.length > 20">...</span>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hiring Component -->
        <HiringComponent />

        <!-- mobile app component -->
        <MobileBannerComponent />

        <!-- join us component -->
        <JoinUsComponent />

        <!-- Newsletter Component -->
        <NewsletterComponent />
    </div>   

</template>

<script>
import JumbotronComponent from '../components/sections/JumbotronComponent.vue';
import HiringComponent from '../components/sections/HiringComponent.vue';
import MobileBannerComponent from '../components/MobileBannerComponent.vue';
import JoinUsComponent from '../components/sections/JoinUsComponent.vue';
import LoaderComponent from '../components/LoaderComponent.vue';
import NewsletterComponent from '../components/sections/NewsletterComponent.vue';


export default {
    name:'UserRestaurantComponent',
    components: {
        JumbotronComponent,
        HiringComponent,
        MobileBannerComponent,
        JoinUsComponent,
        LoaderComponent,
        NewsletterComponent,
    },
    data(){
        return{
            users: null,
            categories: [],
            selectedCategories: [],
            matchedCategories:[],
            isWaiting: true,
            isEmpty: null,
            categoriesMessage: '',
        }
    },
    methods: {
        getAllCategories() {
            this.isWaiting = true;

            axios.get('http://127.0.0.1:8000/api/restaurants-categories')
            .then((response) => {
                this.categories = response.data.results;
            });

            this.isWaiting = false;
        },
        getSelectedCategories() {
            this.isWaiting = true;

            axios.get(`http://127.0.0.1:8000/api/restaurants?categories=${this.selectedCategories}`)
            .then((response) => {

                if(response.data.success) {

                    if(response.data.is_empty) {
                        this.isEmpty = true;
                        this.users = response.data.results;
                    } else {
                        this.isEmpty = false;
                        this.users = response.data.results;
                    }
                } else {

                    this.isEmpty = true;
                    this.users = response.data.results;
                }

                this.isWaiting = false;
            });
        }
    },
    mounted(){
        this.getAllCategories()
    }
}

</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

.space_line {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}

// FILTER CATEGORIES
.ms_restaurants-cards-section {
    padding-block: 4rem 8rem;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 70%, rgba(0,0,0,0) 80%, rgba(255,255,255,1)), url(https://i.ibb.co/4RvcfGG/foodpatternrightside.png);
    background-size: 700px;
    background-color: rgba(white, $alpha: 0.85);
    background-blend-mode: screen;
}

.category-filter-container {

    h3 {
        text-align: center;
        margin: 0 0 2rem;
        color: $secondary-color;
        font-size: 2.5rem;
    }

    .categories-bar {
        display: block;

        .checkbox-symbol {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
            user-select: none;
        }
        
        .checkbox-container {
            margin-inline: auto;
            width: 60%;
            display: flex;
            justify-content:center;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            color: #222;
            font-weight: 600;

            .checkbox-input {
                position: absolute;
                visibility: hidden;
            }
            
            .checkbox {
                padding: 6px 3px;
                user-select: none;
                cursor: pointer;
                border-radius: 6px;
                overflow: hidden;
                transition: all 0.3s ease;
                display: flex;
            }
        }
    }
}     

//  Checkbox animation 
.checkbox:not(:last-child) {
    margin-right: 6px;
}

.checkbox:hover {
    background: rgba($color: $primary-color, $alpha: 0.3);
}

.checkbox span {
    vertical-align: middle;
    transform: translate3d(0, 0, 0);
}

.checkbox span:first-child {
    position: relative;
    flex: 0 0 18px;
    width: 18px;
    height: 18px;
    border-radius: 4px;
    transform: scale(1);
    border: 1px solid #222;
    transition: all 0.3s ease;
}

.checkbox span:first-child svg {
    position: absolute;
    top: 3px;
    left: 2px;
    fill: none;
    stroke: #fff;
    stroke-dasharray: 16px;
    stroke-dashoffset: 16px;
    transition: all 0.3s ease;
    transform: translate3d(0, 0, 0);
}

.checkbox span:last-child {
    padding-left: 8px;
    line-height: 18px;
}

.checkbox:hover span:first-child {
    border-color: $secondary-color;
}

.checkbox-input:checked + .checkbox span:first-child {
    background: $secondary-color;
    border-color: $secondary-color;
    animation: zoom-in-out 0.3s ease;
}

.checkbox-input:checked + .checkbox span:first-child svg {
    stroke-dashoffset: 0;
}

@keyframes zoom-in-out {
    50% {
        transform: scale(0.9);
    }
}

// Restaurant Cards 
.ms_empty-category {
    margin-top: 3rem;
    padding-block: 2rem;
    font-size: 1.2rem;
    font-weight: 500;
    letter-spacing: 3px;
    background-color: $primary-color;
    background: radial-gradient(circle, rgba(255,197,9,1) 58%, rgba(235,179,2,1) 80%, rgb(196, 150, 0) 100%);
}

.ms_restaurant-cards-container {
    width: 80%;
    max-width: 1300px;
    margin: 4rem auto 0;

    > .d-flex {
        flex-wrap: wrap;
        gap: 2rem;

        .ms_restaurant-card {
            width: calc((100% / 4) - 1.5rem);
            display: block;
            background-color: #fff;
            border-radius: 0.7rem;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            overflow: hidden;
            transition: all 200ms ease-out;
            
            &:hover {
                box-shadow: 5px 20px 30px rgba(0,0,0,0.3);
                transform: translateY(-1px);
            }

            .img-container {
                width: 100%;
                height: 200px;
                position: relative;
                background: rgb(255,197,9);
                background: radial-gradient(circle, rgba(255,197,9,1) 0%, rgba(255,197,9,1) 64%, rgba(242,188,12,1) 100%);
                
                img {
                    height: 100%;
                    object-fit: cover;
                }
                svg {
                    width: 70%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    translate: -50% -50%;
                    color: #414141;
                }
            }

            .ms_card-body {
                padding: 0.5rem 1rem 1rem;
                color: #212529;

                .ms_card-heading {
                    font-size: 1rem;
                    font-weight: 700;
                    margin-bottom: 0.3rem;
                }

                .ms_card-text {
                    font-size: 0.7rem;

                    .ms_card-address {
                        margin-right: 0.2rem;
                    }
                }
            }        
        }
    }
}

// MEDIA QUERIES
@media only screen and (max-width: 1350px) {
     
    .ms_restaurant-cards-container {
        width: 80%;

        > .d-flex {
            gap: 2.1;

            .ms_restaurant-card {
                width: calc((100% / 3) - 1.4rem);
            }
        }
    }
}
 
// MEDIA QUERIES
@media only screen and (max-width: 1100px) {
     
    .ms_restaurant-cards-container {
        width: 80%;

        > .d-flex {
            gap: 2.1;

            .ms_restaurant-card {
                width: calc((100% / 3) - 1.4rem);
            }
        }
    }
}

@media only screen and (max-width: 920px) {

    .ms_restaurant-cards-container {

        > .d-flex {
            gap: 2;

            .ms_restaurant-card {
                width: calc((100% / 2) - 1rem);

                .img-container {
                    height: 220px;
                }
            }
        }
    }
}

@media only screen and (max-width: 550px) {

    .ms_restaurant-cards-container {

        > .d-flex {

            .ms_restaurant-card {
                margin-inline: auto;
                width: 70%;
            }
        }
    }
}    

@media only screen and (max-width: 470px) {

    .ms_restaurant-cards-container {

        > .d-flex {

            .ms_restaurant-card {
                width: 100%;

                .img-container {
                    height: 220px;
                }  
            }
        }
    }
}      
</style>