<template>

    <!-- Cookie -->
    <section v-if="!cookies.includes(false)">
        <div id="cookie" class="alert-warning d-flex justify-content-spacebetween align-items-center" role="alert">

            <!-- Cookie Icon -->
            <div class="cookies-img">
                <i class="fa-solid fa-cookie-bite fa-4x"></i>
            </div>

            <!-- Banner text -->
            <div class="cookie-text brown">
                TOAST RIDER utilizza i cookie per personalizzare la tua esperienza e gli annunci pubblicitari su questo sito web e su siti web di terze parti, analizzare i dati, migliorare le prestazioni del sito e consentire la condivisione sui social media. Per ulteriori informazioni o per modificare le impostazioni, consulta la nostra Informativa sui cookie. 
            </div>

            <div class="d-flex justify-content-spacebetween align-items-center">

                <!-- Agree -->
                <button type="button" class="close brown ms_button" data-dismiss="alert" aria-label="Close" @click="checkCookies()">
                    <span aria-hidden="true">
                        Accetta
                    </span>
                </button>

                <!-- Decline -->
                <button type="button" class="close brown ms_button" data-dismiss="alert" aria-label="Close"  @click="checkCookies()">
                    <span aria-hidden="true">
                        Rifiuta
                    </span>
                </button>
            </div>

            <!-- Close x -->
            <button type="button" class="close brown x-close" data-dismiss="alert" aria-label="Close"  @click="checkCookies()">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
    </section>
</template>

<script>
export default {
    name: 'CookiesComponent',
    data(){
        return {
            isVisible: true,
            cookies: [],
        }
    },
    created(){

        if (localStorage.cookies) {
            this.cookies = JSON.parse(localStorage.cookies);
        }

        if (localStorage.getItem('cookies')) {
            this.cookies = JSON.parse(localStorage.getItem('cookies'));
        }
    },

    methods:{
        checkCookies() {

            // salvo il dato in formato stringa nel local storage
            const parsed = JSON.stringify(this.cookies);
            localStorage.setItem('cookies', parsed);

            // leggo i file presenti nel local storage, convertendoli in oggetto
            if(JSON.parse(localStorage.getItem('cookies')).length == 0){
                this.isVisible = false,
                this.cookies.push(this.isVisible)

                // Salvo il cookies
                this.saveCookies()
            }
        },

        saveCookies(){
            const parsed = JSON.stringify(this.cookies);
            localStorage.setItem('cookies', parsed);
        },
    }
}
</script>

<style lang="scss">

    // Cookies
    #cookie {
        z-index: 100;
        position: fixed;
        bottom: 0px;
        padding: 1.5rem 2.5rem ;
        font-size: 0.9rem;
        
        .brown {
            color: brown;
        }

        .cookies-img {
            color: brown;
        }

        .cookie-text {
            padding: 1.5rem;
        }

        .close.brown.ms_button {
            padding: 0.4rem;
            font-size: 1rem;
            border: 1px solid #856404;
            margin: 0.3rem;
            border-radius: 10px;
        }

        .close.brown.x-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
    }

    // MEDIA
    @media only screen and (max-width: 576px) {

        #cookie {
            flex-direction: column;

            .cookie-text {
                padding: 0.5rem 0;
            }
            
            .cookies-img {
                width: 100%;
            }

           .close.brown.x-close {
               position: absolute;
               top: 1rem;
               right: 1rem;
            }

            .close.brown.ms_biutton {
                flex-direction:row;
                padding: 0.5rem;
            }
        }
    }
</style>