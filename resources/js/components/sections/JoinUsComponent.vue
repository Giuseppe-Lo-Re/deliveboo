<template>
   <section>
        <div class="join-us-container">
            <div class="text-container">

                <!-- Title -->
                <h3 class="fo-style">
                    Hai un ristorante?
                </h3>

                <!-- Subtitle -->
                <h4 class="fo-style">
                    Diventa Partner! <br>
                    Per te subito grandi vantaggi.
                </h4>

                <!-- Button CTA Register -->
                <a class="js_btn" href="/register">
                    Registrati
                    <i class="cell-symbol  fa-solid fa-right-to-bracket"></i>
                </a>
            </div>
        </div>
   </section>
</template>

<script>
export default {
    name: 'JoinUsComponent'

}
</script>

<style lang="scss" scoped>

    @import '../../style/variables';
    @import '../../style/common';

section {
    background-image: url('https://i.ibb.co/ypPyH1r/mockup-backgroundlong.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: 80%;
    background-position-y: 0;
    overflow: hidden;

    .join-us-container {
        margin-inline: auto;
        width: 80%;
        max-width: 1300px;
        height: 550px;
        position: relative;
        
        .text-container {
            color: white;
            text-align: left;
            position: absolute;
            top: 50%;
            left: 0;
            translate: 0 -50%;
    
            h3 {
                font-size: 2.5rem;
                color: $primary-color;
            }

            h4 {
                font-size: 1.5rem;
                margin: 0.5rem 0;
            }

            .js_btn {
                font-size: 1.2rem;
                margin: 0.5rem 0.3rem;
                padding: 0.1em 0.8em;
                display: inline-block;
                border: none;
                border-radius: 10rem;
                background-color: $primary-color;
                color: $tertiary-color;
                font-weight: 600;
            }
        }
    }
}

// MEDIA QUERIES
@media only screen and (max-width: 1100px) {
    section {
        background-position-x: 70%;
    }
}
@media only screen and (max-width: 850px) {
    section {
        background-position-x: 55%;
    }
}
@media only screen and (max-width: 450px) {
    section {
        background-position-x: 30%;
    }
}
</style>