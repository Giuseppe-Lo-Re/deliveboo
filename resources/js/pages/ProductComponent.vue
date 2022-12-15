<template>
    <section>
    
        <!-- Jumbotron  -->
        <div class="jumbotron">

            <img v-if="user.cover" :src="user.cover" :alt="user.business_name" class="ms_jumbotron-bg-img">
            <img v-else src="https://i.ibb.co/W3NLMbb/fallbackdarkred.jpg" class="ms_jumbotron-bg-img">

            <div class="ms_jumbotron-txt">
                <div>
                    <!-- Restaurant Name -->
                    <h2>
                        {{ user.business_name }}
                    </h2>

                    <!-- Restaurant Address -->
                    <p class="lead">
                        <!-- Location Icon -->
                        <i class="fa-solid fa-location-dot mr-2"></i>
                        {{ user.address }}
                    </p>
                </div>
            </div>
        </div>
        <div class="ms_pattern-background">

            <!-- Product Container -->
            <div class="products-cart-wrapper">

                <!-- Floating Cart -->
                <a v-if="cart.length" class="floating-cart" @click="cartScroll()">

                    <!-- Counter Cart -->
                    <div class="count-float">
                        <span class="red">{{ totalQuantity(cart) }}</span>
                    </div>

                    <!-- Cart Icon -->
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <!-- Main Container -->
                <div class="row master-row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 products-col">

                        <!-- Products Container  -->
                        <div class="products-side">

                            <!-- Loader Component -->
                            <LoaderComponent v-if="products.length === 0"/>
                            
                            <div v-else class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 d-flex justify-content-start">

                                <!-- Product Cards -->
                                <div v-for="product,index in products" :key="index" class="col p-3">
                                    <div class="ms-product-card " :class="{'not-avaible' : !product.visible}">

                                        <!-- Product Cover -->
                                        <img v-if="product.cover" class="card-img" :src="product.cover" alt="product.name">
                                        <img v-else class="card-img" src="https://i.ibb.co/FwnKbJL/pic1.jpg" :alt="product.name">

                                        <!-- Product Info Pop-up -->
                                        <a class="info-popup-inline" href="#popup1" @click.prevent="selectProduct(product), showProductInfo()">
                                            
                                            <!-- Info Icon -->
                                            <i class="fa-solid fa-circle-info"></i>
                                            <div class="overlay-info"></div>
                                        </a>

                                        <!-- Card Footer -->
                                        <div class="ms-card-body d-flex">
                                            <div class="title-price">

                                                <!-- Product name -->
                                                <h5 class="ms-card-title">
                                                     {{ product.name.slice(0, 17) }}<span v-if="product.name.length > 17">...</span>
                                                </h5>

                                                <!-- Product Price - Product availability  -->
                                                <div class="product-availability">
                                                    <div class="product-card-price" v-if="product.visible == 1">
                                                        {{product.price}}&euro;
                                                    </div>
                                                </div>   
                                            </div>

                                            <!-- CTA Add to Cart -->
                                            <div @click='addItem(product);' class="cart-card-symbol">
                                                <a class="add-to-cart">

                                                    <!-- Cart Icon -->
                                                    <i class="fa-solid fa-cart-shopping" ></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <!-- Product Info Pop-up -->
                                    <div class="info-popup" :class="{ 'ms_visible' : toggle_popup }">
                                        <div id="popup1" class="overlay">
                                            <div v-for="element,index in myProduct" :key="index">
                                                <div class="popup">

                                                    <!-- Product Name -->
                                                    <h2>
                                                        {{ element.name }}
                                                    </h2>

                                                    <!-- Product image -->
                                                    <img v-if="element.cover" :src="element.cover" :alt="element.name">
                                                        
                                                    <!-- Product Content -->
                                                    <div class="ms_content">

                                                        <!-- Product Description -->
                                                        <p class="description">
                                                            {{ element.description }}
                                                        </p>

                                                        <!-- Product Ingredients -->
                                                        <div class="popup-ingredients">
                                                        
                                                        <!-- Description -->
                                                        <span class="ingredients-title">
                                                            Ingredienti:  
                                                        </span>

                                                        <!-- Ingredients -->
                                                        <span class="ingredients-content">
                                                            {{ element.ingredients }}
                                                        </span> 
                                                        </div>

                                                        <!-- Add to Cart Button -->
                                                        <div @click='showProductInfo(), addItem(element)' class="add-to-cart-popup">
                                                            <div class="popup-add-btn">
                                                                Aggiungi al carrello
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Close Pop-up -->
                                                    <a class="close" @click="showProductInfo()">&times;</a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart -->
                    <div class="col-12 col-sm-10 col-md-10 col-lg-4 col-xl-4 cart-col">
                        <div  v-if="cart.length > 0"  class="cart-container">

                            <!-- Cart Title -->
                            <div class="ms-cart-title">
                                Carrello
                            </div>
                            <div class="ghost-cart" id="my-cart"></div>

                            <!-- All products in cart-->
                            <div v-if="cartVisible">
                                <div class="all-products-in-cart">
                                    <div v-for="(product, index) in cart" :key="index" class="item-cart-section d-flex">

                                        <!-- title - price-->
                                        <div class="title-price-cart d-flex flex-column justify-content-center align-items-start">
                                            <div class="title-product-cart"> {{ product.name }}</div>
                                            <div  @click='deleteItem(index)' class="delete-item-cart">
                                                Rimuovi
                                            </div>
                                        </div>

                                        <!-- quantity + - -->
                                        <div class="quantity-cart d-flex justify-content-center align-items-center">
                                            <span @click='decreaseQuantity(product, index)' class="increment quantity-btn">

                                                <!-- Icon "-" -->
                                                <i class="fa-solid fa-circle-minus"></i>
                                            </span>
                                            <span class="quantity-number">{{ product.quantity }}</span>
                                            <span  @click='addItem(product)' class="decrease quantity-btn">
                                                
                                                <!-- Icon "+" -->
                                                <i class="fa-solid fa-circle-plus"></i>
                                            </span>
                                        </div>

                                        <!-- product price- -->
                                        <div class="price-product-cart d-flex justify-content-center align-items-center">
                                            <!-- <i class="fa-solid fa-xmark"></i> -->
                                            {{ product.price * product.quantity }}&euro;
                                        </div>
                                    </div>
                                </div>

                                <!-- Checkout Section -->
                                <div class="check-out-section d-flex flex-column justify-content-center align-items-center">
                                    <div class="total-clear-price d-flex justify-content-between align-items-center">
                                        <div class="total-clear d-flex flex-column justify-content-center align-items-start">

                                            <div class="totale-text">
                                                Totale
                                            </div>

                                            <div @click="clearCart(index)" class="clear-cart">
                                                Svuota carrello
                                            </div>
                                        </div>

                                        <!-- Final Price -->
                                        <div class="final-price">{{ totalAmount(cart) }} &euro;</div>
                                    </div>

                                    <div data-toggle="modal" data-target="#proceedtopayment" class="check-out-btn">
                                        Checkout
                                    </div>
                                </div>

                                <!-- Payment Component -->
                                <PaymentComponent :amount="totalAmount(cart)" v-if="isVisible" />
                            </div>
                        </div>

                        <!-- Cart Blank Layout -->
                        <div v-else class="cart-blank">
                            
                            <!-- Title -->
                            <div class="blank-cart-title">
                                Il carrello è vuoto
                            </div>

                            <!-- SVG Image -->
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                                width="300.000000pt" height="267.000000pt" viewBox="0 0 300.000000 267.000000"
                                preserveAspectRatio="xMidYMid meet">
                                <metadata>
                                Created by potrace 1.10, written by Peter Selinger 2001-2011
                                </metadata>
                                <g transform="translate(0.000000,267.000000) scale(0.100000,-0.100000)"
                                    fill="currentcolor" stroke="none">
                                    <path d="M1023 2650 c-71 -16 -144 -61 -181 -111 -28 -39 -42 -49 -65 -49 -31
                                    0 -87 -25 -87 -40 0 -5 14 -17 30 -27 39 -22 44 -43 38 -151 -4 -83 -8 -94
                                    -75 -237 -116 -246 -136 -344 -93 -459 41 -109 88 -139 590 -371 362 -168 389
                                    -178 475 -179 63 -1 77 3 141 37 39 21 83 50 97 65 14 15 44 75 66 134 22 60
                                    59 145 83 190 41 80 58 100 200 233 61 57 76 93 85 202 9 106 -20 177 -106
                                    264 -118 118 -347 266 -530 343 -293 124 -551 184 -668 156z m274 -145 c97
                                    -26 293 -100 378 -143 114 -57 309 -208 352 -271 29 -43 39 -110 23 -165 -14
                                    -52 -64 -116 -89 -116 -10 0 -76 50 -147 111 -235 202 -420 334 -629 449 -72
                                    38 -154 78 -182 87 -29 9 -53 21 -53 25 0 5 24 20 53 34 46 22 61 24 127 20
                                    41 -4 116 -17 167 -31z m-52 -363 c253 -134 633 -338 668 -359 4 -3 -2 -19
                                    -13 -36 -11 -18 -66 -122 -121 -232 -56 -110 -112 -215 -126 -233 -36 -47 -72
                                    -62 -154 -62 -69 0 -77 3 -278 96 -113 53 -267 127 -341 165 -146 73 -163 90
                                    -189 184 -14 52 -5 83 76 264 91 204 114 266 117 330 2 31 4 57 5 59 3 9 73
                                    -25 356 -176z"/>
                                    <path d="M945 2125 c-27 -26 -32 -60 -13 -100 19 -42 75 -29 103 25 20 38 19
                                    63 -3 83 -26 24 -59 21 -87 -8z"/>
                                    <path d="M1067 1933 c-14 -13 -6 -34 27 -70 18 -21 39 -51 47 -68 10 -22 21
                                    -30 39 -30 23 0 25 4 24 38 -2 44 -26 82 -74 115 -34 23 -52 27 -63 15z"/>
                                    <path d="M1433 1915 c-32 -22 -43 -65 -27 -103 11 -26 19 -32 43 -32 36 0 59
                                    29 68 84 9 59 -34 86 -84 51z"/>
                                    <path d="M2845 2566 c-51 -36 -372 -371 -388 -404 -14 -30 -115 -437 -268
                                    -1084 l-23 -98 -753 0 c-823 0 -798 -2 -821 57 -6 15 -48 177 -92 358 -44 182
                                    -94 383 -111 448 -33 130 -32 161 6 197 20 18 41 25 101 29 59 5 79 11 90 26
                                    22 30 17 64 -15 96 -26 25 -37 29 -88 29 -32 0 -75 -5 -95 -10 -96 -27 -178
                                    -134 -178 -233 0 -41 193 -857 232 -981 6 -21 31 -60 55 -86 75 -84 33 -80
                                    886 -80 l749 0 -6 -28 c-4 -15 -12 -40 -18 -55 -23 -59 -1 -57 -788 -57 l-721
                                    0 -24 -25 c-30 -30 -32 -64 -4 -99 17 -22 28 -26 71 -26 l50 0 -47 -45 c-60
                                    -59 -87 -121 -88 -199 -2 -251 308 -373 475 -188 51 57 70 105 72 182 1 81
                                    -35 162 -96 215 l-42 35 427 0 c235 0 427 -2 427 -5 0 -2 -20 -23 -45 -46
                                    -147 -136 -91 -390 100 -456 71 -24 172 -14 233 23 53 33 106 105 123 167 15
                                    56 6 144 -20 194 -11 23 -43 61 -71 85 l-50 44 40 18 c21 9 57 37 79 62 47 53
                                    32 -1 226 819 81 341 153 634 160 650 7 17 90 106 184 200 160 159 171 172
                                    171 207 0 28 -6 42 -26 57 -31 25 -52 26 -79 7z m-1971 -2160 c47 -20 76 -61
                                    76 -108 0 -100 -85 -155 -175 -112 -94 44 -81 194 19 223 43 13 43 13 80 -3z
                                    m1162 -13 c26 -17 54 -71 54 -105 0 -56 -66 -118 -127 -118 -41 0 -92 35 -109
                                    76 -46 111 81 214 182 147z"/>
                                </g>
                            </svg>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Component -->
            <NewsletterComponent />
        </div>    

        <!-- MODALS SECTION -->
        <div v-for="(product, index) in cart" :key="index" class="margin">

            <!-- Modal "Proceed to Payment" -->
            <div class="modal fade right ms_modal-wrapper" id="proceedtopayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
                    <div class="modal-content ms_modal_container">

                        <!--Header-->
                        <div>
                            <!-- Close "X" -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="white-text">
                                    &times;
                                </span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="text-center">
                            <span class="yellow pb-4">

                                <!-- Credit Card Icon -->
                                <i class="fas fa-credit-card fa-4x"></i>
                            </span>

                            <!-- Text -->
                            <p class="pt-4">
                                Vuoi concludere il tuo ordine e procedere al pagamento?
                            </p>
                        </div>

                        <!--Footer-->
                        <div class="text-center">

                            <!-- Button  -->
                            <button type="button" @click="ViewFormPayment()" data-dismiss="modal" class="ms_btn white-weight pad-radius mt-4">
                                Si, ho fame!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal "Proceed to Payment" -->

            <!-- Modal "Order Confirmed" -->
            <div class="modal fade right ms_modal-wrapper" id="orderconfirmed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
                    <div class="modal-content ms_modal_container">

                        <!--Header-->
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <!-- Close "X" -->
                                <span aria-hidden="true" class="white-text">
                                    &times;
                                </span>
                            </button>
                        </div>

                        <!--Body-->
                        <div class="text-center">
                            <span class="yellow pb-4">

                                <!-- Burger Card Icon -->
                                <i class="fas fa-burger fa-4x"></i>
                            </span>
                            <p class="pt-4">Stiamo preparando il tuo ordine!</p>
                            <p>Controlla la mail per tutti i dettagli.</p>
                            <p>Fra poco si mangia!</p>
                        </div>

                        <!--Footer-->
                        <div class="text-center">

                            <!-- Button -->
                            <button type="button" data-dismiss="modal" class="ms_btn white-weight pad-radius mt-4" @click="paymentDone()">
                                Ok
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal "order confirmed" -->
        </div>
    </section>
</template>

<script>
import PaymentComponent from "../components/PaymentComponent.vue";
import NewsletterComponent from '../components/sections/NewsletterComponent.vue';
import swal from 'sweetalert';
import LoaderComponent from '../components/LoaderComponent.vue';

export default {
    name: 'ProductComponent',
    components: {
        PaymentComponent,
        NewsletterComponent,
        swal,
        LoaderComponent,
    },

    data(){
        return {
            user: [],

            // Toogle che rende visibile/invisibile il pop-up
            toggle_popup: false,

            // Array in cui salvo l'id del prodotto visualizzato nel pop-up dettagli prodotto
            myProduct: [],

            // Array dei prodotti
            products: [],
            
            // Array vuoto per il carrello
            cart:[],

            // Numero prodotti presenti nel carrello
            products_in_cart: 0,

            // Definisco una variabile per visionare il pannello del pagamento
            isVisible: false,
            
            // Definisco una variabile per visionare il carrello, servirà per rimuovere il carrello quando il pagamento viene eseguito
            cartVisible: true,
        }
    },
    created() {
                    
        // $this.route.paramas.id rappresenta il passaggio di informazioni eseguito con il router link
        axios.get(`http://127.0.0.1:8000/api/${this.$route.params.slug}/menu`)
        .then((response) =>{
            this.products = response.data.results
        });

        axios.get(`http://127.0.0.1:8000/api/${this.$route.params.slug}/user`)
        .then((response) =>{
            this.user = response.data.results
        });

        // Se il carrello non è null
        if (localStorage.cart) {

            // I prodotti presenti nel carrello vengono convertiti in un file json
            this.products_in_cart = JSON.parse(localStorage.cart);
        }

        // Se cart esiste in LocalStorage
        if (localStorage.getItem('cart')) {
            try {

                // Trasformalo in stringa
                this.cart = JSON.parse(localStorage.getItem('cart'));
            } catch(e) {

                // Altrimenti rimuovi cart da localStorage
                localStorage.removeItem('cart');
            }
        }
    },

    methods: {

        // Funzione che calcola il numero totale dei prodotti nel carrello
        totalQuantity(cart){
            let total_quantity = 0;
            cart.forEach ((product) => {
                total_quantity += product.quantity;
            })
            return total_quantity;
        },

        // Funzione che scrolla l'icona del carrello
        cartScroll(){
            const element = document.getElementById('my-cart')
            element.scrollIntoView({ behavior: 'smooth' });
        },

        // Mostra popup info  
        showProductInfo(){
            if (this.toggle_popup){
                this.toggle_popup = false
                this.myProduct = []; 
            }else{
                this.toggle_popup = true
            }
        },

        // Seleziona il prodotto
        selectProduct(product){
            this.myProduct.push(product); 
        },

        // Funzione che aggiunge il prodotto al carrello
        addItem(product){

            // Se il prodotto non è presente
            if (!product){
                return;
            }
            // Se il carrello presente in localstorage non esiste o è vuoto
            if(localStorage.getItem('cart') == null || JSON.parse(localStorage.getItem('cart')).length === 0){

                // Definisco la quantità del prodotto
                product.quantity = 1;

                // Pusho nell'array il prodotto
                this.cart.push(product);

                // Salvo il carrello
                this.saveCart();

            } else {

                // Salvo la stringa di LocalStorage in this.cart
                this.cart = JSON.parse(localStorage.getItem('cart'));

                // Se l'id del prodotto presente nel carrello è diverso dall'user_id presente nella tabella prodotti
                if(this.cart[0].user_id !== product.user_id){

                    // Se conferma di cambiare ristorante
                    if(confirm("Stai provando ad aggiungere un prodotto di altro ristorante, così facendo perderai il contenuto del tuo carrello. Vuoi cambiare ristorante?")){
                        
                        // Svuoto il carrello
                        this.cart = [];

                        // Setto la quantità del prodotto (del nuovo ristorante)
                        product.quantity = 1;

                        // Pusho nell'array il prodotto
                        this.cart.push(product);

                        // Salva il carrello
                        this.saveCart();
                    }
                } else {

                    // Se non cambia ristorante:
                    // Salvo l'id del prodotto selezionato

                    let check = this.cart.find(({id}) => id == product.id);

                    // Se non esiste già
                    if(!check) {

                        // Setto la quantità del prodotto
                        product.quantity = 1;
                    }
                    else {

                        // Incrementa di 1 la quantità
                        for(let i = 0; i < this.cart.length + 1; i++){

                            // Se L'id del prodotto presente nel carrello è uguale all'id del prodotto presente nel database
                            if(this.cart[i].id == product.id){

                                // Incremento la quantità del prodotto presente nel carrello di uno
                                this.cart[i].quantity = this.cart[i].quantity + 1

                                // Salvo il carrello
                                this.saveCart();

                                // Richiamo la funziona che mostra un messagggio all'utente dell'aggiunta del prodotto al carrello
                                this.addedToCartMessage()
                            }
                        }
                    }

                    // Pusho nell'array il prodotto
                    this.cart.push(product);

                    // Salva il carrello
                    this.saveCart();
                }
            }

            // Richiamo la funziona che mostra un messagggio all'utente dell'aggiunta del prodotto al carrello
            this.addedToCartMessage()
        },

        // Funzione salva carrello
        saveCart() {
            const parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);
        },

        // Funzione che riduce la quantità del prodotto nel carrello
        decreaseQuantity(product, index){
            let check = this.cart.find(({id}) => id == product.id);
            if(check.id){
                for(let i = 0; i < this.cart.length + 1; i++){
                    if(this.cart[i].id == product.id && this.cart[i].quantity >= 1){
                    this.cart[i].quantity = this.cart[i].quantity -  1;
                    this.saveCart();
                    }

                    if(this.cart[i].id == product.id && this.cart[i].quantity == 0){
                        this.cart.splice(index, 1);
                        this.saveCart();
                    }
                }
            }
        },

        // Funzione che cancella il prodotto dal carrello
        deleteItem(index, product) {
            if(this.cart.length > 1){

                // Rimuovo l'elemento carrello in pagina
                this.cart.splice(index, 1);

                // Filtro dell'array così da togliere l'id del prodotto eliminato
                let filtered_cart = this.cart.filter(product => product.id !== index);

                // Sovrascrivo ('cart') localStorage con il nuovo array filtrato
                localStorage.setItem('cart', JSON.stringify(filtered_cart));
            } else {
                this.cart.splice(index, 1);

                // Svuoto il localstorage
                localStorage.clear();
            }
        },

        // Funzione che svuota il carrello
        clearCart(index){
            this.cart.splice(index, this.cart.length)
            localStorage.clear('cart');
        },

        // Funzione che determina la quantità di prodotti all'interno del carrello ritornando il prezzo finale
        totalAmount(cart){
            let total_amount = 0;
            cart.forEach ((product) => {
                total_amount += product.price * product.quantity;
            })
            return total_amount;
        },

        // Funzione che comunica il processo del pagamento e rende visibile il banner del pagamento
        ViewFormPayment() {
            this.isVisible = true;
        },   

        // Funzione per cancellare il carrello sia in local storage che in pagina
        paymentDone(cart){
            if(this.cart.length > 0){
                 this.cartVisible = false
            }
            this.cart.length = 0
            this.cartVisible = true
            localStorage.removeItem('cart');
        },

        addedToCartMessage(){
            swal("Aggiunto al carrello!", {
            icon: "success",
            buttons: [false],
            timer: 1000,           
            });
        }

    },
}
</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

.swal-dimension{
    width: 300px, !important;
    height: 180px, !important;
}

section {
    background-color: white;

    // Jumbotron
    .jumbotron {
        margin-top: 5.5rem;
        height: 700px;
        position: relative;

        > .ms_jumbotron-bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        > .ms_jumbotron-txt {
            padding-inline: 10%;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            translate: -50% -50%;
            color: #fff;
            font-weight: 600;
            text-align: center;
            background: rgba(0, 0, 0, .55);

            h2 {
                font-size: 5rem;
                margin-bottom: 0.8rem;
            }

            p {
                font-size: 1.4rem;
            }
        }
    }

    // Floating Cart
    .floating-cart {
        display: none;
        position: fixed;
        top: 0;
        right: 30px;
        margin-top: 120px;
        color: white;
        background-color: $primary-color;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        z-index: 10;
        cursor: pointer;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2),
        0 6px 20px 0 rgba(0, 0, 0, 0.19);

        .fa-cart-shopping {
            font-size: 2.3rem;
            z-index: 10;
        }

        &:hover {
            color: rgb(249, 246, 246);
        }
    }

    .master-row {
        margin-top: 4rem;
    }

    // Counter Cart
    .count-float {
        width: 1.1rem;
        height: 1.1rem;
        font-size: 0.7rem;
        border-radius: 50%;
        background-color: $primary-color;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        bottom: 33px;
        right: 24px;
        z-index: 11;

        &:hover ~ .fa-cart-shopping {
            color: rgb(249, 246, 246);
        }

        .red {
            color: $secondary-color;
            font-weight: 700;
        }
    }
  
    // ******************** PRODUCT CARDS ******************** // 
    .ms_pattern-background{
        background-image: url(https://i.ibb.co/4RvcfGG/foodpatternrightside.png);
        background-color: rgba(white, $alpha: 0.8);
        background-size: 700px;
        background-blend-mode: screen;
        padding-top: 4rem;
    }

    .products-cart-wrapper {
        width: 86%;
        margin: 0 auto;
        position: relative;
    }

    .products-side {
        margin-bottom: 70px;
        width: 95%;

        .my-circle {
            width: 50px;
            height: 50px;
            text-align: center;
            vertical-align: middle;
        }

        .col {
            margin-bottom: -80px;
        }
        
        .ms-product-card {
            user-select: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
            0 6px 20px 0 rgba(0, 0, 0, 0.19);
            height: 75%;
            aspect-ratio: 1/1;
            position: relative;
            border-radius: 10px 10px 10px 10px;
            transition: box-shadow 0.5s, transform 0.5s;

            &:hover {
                box-shadow: 5px 20px 30px rgba(0,0,0,0.3);
            }

            &.not-avaible {
                opacity: 0.6;
                pointer-events: none;
            }

            .card-img {
                object-fit: cover;
                height: 70%;
            }

            .info-popup-inline {
                display: block;
                
                .fa-circle-info {
                    position: absolute;
                    font-size: 160%;
                    color: $primary-color;
                    color: $product-card-cart-info;
                    top: 10px;
                    right: 10px;
                    z-index: 2;
                }

                .overlay-info {
                    position: absolute;
                    top: 12px;
                    right: 13px;
                    width: 18px;
                    height: 20px;
                    border-radius: 50%;
                    background-color: $secondary-color;
                    background-color: $product-card-info-under;
                }

                &:hover .overlay-info {
                    opacity: 0;
                }   
            }
                        
            .ms-card-body {
                height: 40%;

                .title-price {
                    width: calc((100% / 4) * 3);
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    align-items: flex-start;
                    padding-left: 1rem;
                    background-color: #f5f5f5;
                    background-color: $product-card-bg;
                            
                    .ms-card-title {
                        margin-top: 1rem;
                        font-weight: 600;
                        overflow: hidden ;
                        text-overflow: ellipsis;
                        font-size: 0.9rem;
                    }

                    .not-availability{
                        font-size: 0.7rem;
                        padding: 0.3rem 0;
                        color: $secondary-color;
                        font-weight: 700;
                    }

                    .product-card-price {
                        margin-bottom: 1rem;
                        font-size: 0.8rem;
                    }
                }

                .cart-card-symbol {
                    width: calc(100% / 4);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    border-left: solid thin rgba(0,0,0,0.1);
                    transition: transform 0.5s;
                    cursor: pointer;
                    background-color: #f5f5f5;
                    background-color: $product-card-bg;

                    &:hover .fa-cart-shopping {
                        transform: translateY(5px);
                    }

                    .add-to-cart {
                        font-size: 140%;
                        margin-bottom: 1.8rem;
                        transition: transform 0.5s;
                        
                        .fa-cart-shopping {
                            transition: transform 0.5s;
                            color: $secondary-color;
                            color: $product-card-cart-icon;
                        }
                    }
                }
            }
        }
    }

    // Add to Cart Button 
    .add-to-cart {
        color: rgb(23, 2, 2);
        cursor: pointer;
    }

    // Product Info Pop-up
    .info-popup {
        margin-top: 90px;

        .button {
            font-size: 1em;
            padding: 10px;
            color: #fff;
            border: 2px solid #06D85F;
            border-radius: 20px/50px;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #06D85F;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.1);
            transition: opacity 200ms;
            visibility: hidden;
            opacity: 0.1;
            z-index: 60;
        }

        .popup {
            margin: 10vh auto;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            width: 40%;
            position: relative;
        }

        .popup h2 {
            margin-bottom: 1rem;
            color: black;
            text-align: center;
        }

        img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .ms_content {
            margin: 1rem 0;

            .description {
                text-align: center;
                font-weight: 600;
            }

            .popup-ingredients {
                margin-top: 0.5rem;
                font-size: 0.9rem;
                

                .ingredients-title {
                    font-weight: 600;
                }
                
                .ingredients-content {
                    font-style: italic;
                    font-weight: 500;
                }

            }
            
            .add-to-cart-popup {
                margin: 2rem 0 0 0;
                text-align: center;
                display: flex;
                justify-content: center;

                .popup-add-btn {
                    background-color: #6c808f;
                    padding: 0.3rem 2.8rem;
                    border-radius: 15px;
                    color: white;
                    cursor: pointer;
                    background-color: $secondary-color;
                    background-color: $popup-cart-btn-bg;
                }
            }    
        }

        .popup .close {
            position: absolute;
            top: 5px;
            right: 13px;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
            color: $popup-cart-close;
            cursor: pointer;
        }

        .popup .close:hover {
            color: $secondary-color;
            color: $popup-cart-close-overlay;
        }

        .add-to-cart.pop-btn {
            margin-top: 30px;
            display: inline-block;
        }

        &.ms_visible {
            
            .overlay {
                visibility: visible;
                opacity: 1;
            }
        }
    }

    // ****************** END PRODUCT CARDS ****************** // 

    // ****************** CART ******************

    .ms-cart-title {
        font-size: 1.2rem;
        text-align: center;
        padding: 1rem 0;
        font-weight: 600;
        border-bottom: 1px solid #c1c1c3;
        background-color: #f5f5f5;
        background-color:$cart-bg;
    }

    .cart-container {
        user-select: none;
        border-radius: 15px;
        overflow: hidden;
        position: sticky;
        top: 180px;
        margin-top: 1.5rem;
        margin-bottom: 90px;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2),
        0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background-color: #f5f5f5;
        background-color:$cart-bg;

    // custom scrollbar cart
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #6c808f;
        background-color: #ffc509;  //primary
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #9ba9b4;
        background-color: #9ba9b4;
    }

        .ghost-cart {
            position: absolute;
            top: -140px;
            left: 0;
            height: 10px;
            width: 10px;
            visibility: hidden;
        }

        .all-products-in-cart {
            overflow-y: scroll;
            max-height: 45vh;
        }

        .item-cart-section {
            border-bottom: 1px solid #c1c1c3;
        

        .title-price-cart {
            width: (calc(100% / 9) * 5);
            padding: 1rem 0;

            .title-product-cart {
                font-weight: 600;
                padding-left: 5%;
            }

            .delete-item-cart {
                padding-left: 6%;
                color: #808083;
                font-size: 0.8rem;
                cursor: pointer;
            }
        }
        .quantity-cart {
            width: (calc(100% / 9) * 2);

            .quantity-number {
                padding: 0 0.3rem;
            }

            .quantity-btn {
                font-size: 1.1rem;
                display: flex;
                color: #b9b9d1;
                color: $cart-quantity-btn;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }
        }

        .price-product-cart {
            font-weight: 600;
            width: (calc(100% / 9) * 2);
            color:black;
            font-size: 1rem;
        }
    }
        
        .check-out-section{
                background-color: #f5f5f5;
                background-color: $cart-bg;
                
                
                .total-clear-price {
                    width: 100%;
                    padding: 0.6rem 0;
                    padding-left: 3%;

                        .total-clear {
                            width: (calc(100% / 9) * 7);
                            
                            .totale-text {
                                font-size: 1.5rem;
                                font-weight: 600;
                            }

                            .clear-cart {
                                padding-left: 1px;
                                font-size: 0.9rem;
                                color: #808083;
                                color: $clear-cart-color;
                                cursor: pointer;
                            }
                        }

                        .final-price{
                            width: calc( (100% / 9) * 2);
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            font-size: 1.6rem;
                            font-weight: 600;
                            margin-right: 0.5rem
                        }
                }
                .check-out-btn {
                    margin: 0.5rem 0 1.5rem 0;
                    font-weight: 600;
                    padding-block: 0.2rem;
                    border-radius: 15px;
                    text-align: center;
                    width: 50%;
                    color: white;
                    // color: $secondary-color;
                    background-color: #6c808f;
                    background-color: $cart-checkout-btn-bg;
                    // background-color: $primary-color;S
                    cursor: pointer;
                }
        }

    }

.cart-blank {
   
    width: 80%;
    background-color:rgba(245, 245, 245, 0.6);
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 1.5rem 0;
    margin-left: 40px;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2),
    0 6px 20px 0 rgba(0, 0, 0, 0.19);
    position: sticky;
    top: 180px;
    overflow: hidden;
    
        .blank-cart-title{
            width: 100%;
            font-size: 1.2rem;
            text-align: center;
            padding: 1rem 0;
            background-color: #f5f5f5;
            font-weight: 600;
            border-bottom: 1px solid #c1c1c3;
            color: #808083;
        }

    svg {
        color: #808083;
        padding: 50px 0;
        width: 35%;
        height: 35%;
        opacity: 1;
    }
}

    // ****************** END CART ****************** // 


    // ******************** MODALS ******************** //

    // "Proceed to Payment" Modal
    .ms_modal-wrapper {
        margin-top: 115px;

        .ms_modal_container {
            margin: 0 auto;
            background: linear-gradient(to left right, $secondary-color, white);
            color: black;
            font-size: 1.1rem;
            padding: 1.7rem;
            border-radius: 15px;
            background-color:$cart-bg;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

            .yellow {
                color: $primary-color;
            }

            .red {
                color: $secondary_color;
            }

            .white-weight {
                color: white;
                font-weight: 500;
            }
            
            .white-text {
                font-size: 2rem;

                &:hover {
                    color:$secondary-color;
                }
            }
        }

        .pad-radius {
            padding-inline: 2.5rem;
            border-radius: 15px;
        }

        .modal-dialog {
            margin: 0 auto;
        }
    }
}

// ******************** END MODALS ******************** //

// ******************** MEDIA QUERY ******************** //

// Max-width: 1200px

@media only screen and (max-width: 1200px) {

      .products-cart-wrapper {
        margin-bottom: 70px;
        width: 95%;
    }

    .products-side {
        margin-bottom: 70px;
        width: 95%;
    }

    .info-popup {

        .popup {
            margin: 10vh auto;
            width: 50%;
        }
    }

    .card-ingredients {
        height: 65px;
    }
}

// Max-width: 1110px

@media only screen and (max-width: 1110px) {

    .products-side {
        width: 100%;
    }
}

// Max-width: 992px

@media only screen and (max-width: 992px) {

    .popup {
        margin: 20vh auto;
        width: 60%;
    }

    .floating-cart {
        display: flex !important;
    } 

    .info-popup {

        .popup {
            margin: 10vh auto;
            width: 60%;
        }
    }

   .cart-container {
        margin-left: 16px;
        z-index: 11;
    }

    .products-col {
        display: flex;
        justify-content: flex-start ; 
    }
}

// Max-width: 768px

@media only screen and (max-width: 768px) {


    .cart-container {
        margin-left: 16px;
    }

    .info-popup {

        .popup {
            margin: 10vh auto;
            width: 80%;
        }
    }

    .all-products-in-cart {
        overflow-y: scroll;
        max-height: 20vh;
    }
    
   .jumbotron {
        height: 600px;
    }

    .ms-card-body {

        .title-price {
                    
            .ms-card-title {
                margin-bottom: 0.3rem;
                font-size: 1.6rem !important;
            }

            .product-card-price {
                font-size: 1.3rem !important;
            }
        }
    }
}  

// MEDIA QUERIES
@media only screen and (max-width: 560px) {

    section {

        // Jumbotron
        .jumbotron {
            height: 570px;

            > .ms_jumbotron-txt {
                padding-inline: 2rem;

                h2 {
                    font-size: 3rem;
                    margin-bottom: 0.9rem;
                }

                p {
                    font-size: 0.9rem
                }
            }
        }

        .ms-card-body {

            .title-price {
                        
                .ms-card-title {
                    margin-bottom: 0.3rem;
                    font-size: 1.4rem !important;
                }

                .product-card-price {
                    font-size: 0.8rem !important;
                }
            }
        }
    }
}
// ******************** END MEDIA QUERY ******************** //
</style>