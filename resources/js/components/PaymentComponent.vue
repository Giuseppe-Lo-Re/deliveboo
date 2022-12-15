<template>
  <div class="payment-form-braintree" v-if="Payed">

    <!-- User Form -->
    <div>
      <form>

        <!-- Name -->
        <div class="mb-1">
          <label for="customer_name" class="form-label"></label>
          <input type="text" class="form-control" id="customer_name" placeholder="Cognome e Nome" v-model="customerName">
        </div>

        <!-- Email -->
        <div class="mb-1">
          <label for="customer_mail" class="form-label" ></label>
          <input type="email" class="form-control" id="customer_mail" placeholder="Email" v-model="customerEmail">
        </div>

        <!-- Phone Number -->
        <div class="mb-1">
          <label for="customer_phone_number" class="form-label"></label>
          <input type="text" class="form-control" id="customer_phone_number" placeholder="Telefono" v-model="customerPhoneNumber">
        </div> 

        <!-- Address -->
        <div class="mb-2">
            <label for="customer_address" class="form-label"></label>
            <textarea class="form-control" id="customer_address" rows="2" placeholder="Indirizzo di consegna" v-model="customerAddress"></textarea>
        </div> 
      </form>     
    </div>
    
    <!-- Braintree Drop-in -->
    <div class="drop-in" >
      <div>
        <div id="dropin-container"></div>
        <div class="btn-container">
          <button id="submit-button" @click="payment()" class="check-out-btn">Paga Adesso</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentComponent',
  data() {
    return {
      token: '',
      Payed: true,
      orderData: [],
      customerName: '',
      customerEmail: '',
      customerPhoneNumber: '',
      customerAddress: ''
    }
  },
  props: {
    amount: Number
  },

  mounted() {
      braintree.dropin.create({
      authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
      selector: '#dropin-container'
      }),

      // <!-- BRAINTREE -->
      // Chiamata API che restituisce il token di autorizzazione nella risposta
      axios.get("http://127.0.0.1:8000/api/orders/generate")
          .then((response) => {
              this.token = response.data.token;
          })
  },

  methods: {
    payment() {
      axios.post(
        'http://127.0.0.1:8000/api/orders/make/payment', {
          token: this.token,
          amount: this.amount
        })
        .then((result) => {

          // Se la transazione va a buon fine
          if(result.data.success === true){

            // salvo il contenuto del carrello in "cart"
            this.cart = JSON.parse(localStorage.getItem('cart'))

            // salvo "order" e tutti i dati inseriti dall'utente nel form in "orderData"
            this.orderData.push(this.cart, this.amount, this.formData);
            axios.post(
              'http://127.0.0.1:8000/api/orders', {
                order_cart: this.cart,
                order_customerName: this.customerName,
                order_customerEmail: this.customerEmail,
                order_customerPhoneNumber: this.customerPhoneNumber,
                order_customerAddress: this.customerAddress
              })
              .then((result) => {
              })

              // Mostro il Modal in pagina
              $('#orderconfirmed').modal('show');
          } 

          // Nascondo il form e il drop-in del pagamento
          this.Payed = false
        }
      )
    }
  }
}
</script>

<style lang="scss" scoped>
@import '../style/variables';

.payment-form-braintree {
  padding-top: 2rem;
  border-top: 1px solid #c1c1c3;
}

.form-control {
  width: 90%;
  margin: 0 auto;

  input{
    background-color: white;
  }
}

.drop-in,
.btn-container {
  display: flex;
  justify-content: center;
} 

.drop-in {
  width: 90%;
  margin: 0 auto;
  background-color: #f5f5f5;
  background-color: $cart-bg;
}

.check-out-btn {
  margin: 0.5rem 0 1rem 0;
  font-weight: 600;
  padding-block: 0.2rem;
  border-radius: 15px;
  border: 0 solid grey;
  text-align: center;
  width:50%;
  color: white;
  background-color: #6c808f;
  background-color: $pay-now-btn;
  cursor: pointer;
}
</style>