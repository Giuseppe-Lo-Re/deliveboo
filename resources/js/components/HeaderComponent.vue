<template>
   <header>
        <div class="ms_container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="ms_logo-container">
                    <a href="/">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
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
                    </a>
                </div>

                <div class="ms_nav-container d-flex">
                    <div v-if="isUserLogged" class="ms_nav-container-if">
                        <a href="/admin" class="js_btn">
                            Area privata
                            <i class="cell-symbol  fa-solid fa-right-to-bracket"></i>
                        </a>
                    </div>
                    <div v-else class="ms_nav-container-else d-flex align-items-center">
                        <div class="ms_login d-flex align-items-center">
                            <span class="ms_header-txt">
                                Sei un ristoratore? 
                            </span>
                            <a href="/login" class="js_btn d-flex align-items-center">
                                <span>Accedi</span>
                                <i class="cell-symbol fa-solid fa-house"></i>
                            </a>
                        </div>
                        <div class="ms_register d-flex align-items-center">
                            <span class="ms_header-txt">
                                oppure 
                            </span>
                            <a href="/register" class="js_btn d-flex align-items-center">
                                <span>Registrati</span>
                                <i class="cell-symbol fa-solid fa-right-to-bracket"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data(){
        return{
           
        }
    },
    computed: {
        isUserLogged() {
            return  window.user;
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

header {
    width: 100%;
    height: 5.5rem;
    display: flex;
    align-items: center;
    background-color: white;
    box-shadow: 0 4px 2px -2px rgba(0,0,0,.2);
    position: fixed;
    top: 0;
    z-index: 15;
    user-select: none;

    .ms_container {
        width: 80%;
        max-width: 1300px;
        margin-inline: auto;

        .ms_logo-container {
            width: 5rem;

            svg {
                width: 100%;
                height: 100%;
                color: $secondary-color;
                transition: transform 10s;
        
                &:hover {
                    color: $primary-color;
                    transform: rotate(-1080deg);
                }
            }
        }
        
        .ms_nav-container {
            align-items: center;
            
            &-else {
                gap: 1rem;

                .ms_login,
                .ms_register {
                    gap: 0.8rem;
                }
            }
        }
    }

    .js_btn {
        padding: 0.25em 0.9em;
        display: inline-block;
        border: none;
        border-radius: 10rem;
        color:#fff;
        font-weight: 600;
        background-color: $primary-color;

        &:hover {
            background-color: $secondary_color;
            color: $primary-color;
        }

        .fa-house {
            margin-left: 0.3rem;
            font-size: 0.8rem;
        }
        .fa-right-to-bracket {
            margin-left: 0.3rem;
            font-size: 0.9rem;
        }
    }
}

// MEDIA QUERIES
@media only screen and (max-width: 992px) {
    .ms_header-txt {
        display: none !important;
    }

    .cell-symbol {
        display: none;
    }
}      

@media only screen and (max-width: 420px) {
    header {

        .ms_container {
            width: 100%;
            padding-inline: 2rem;
        }
    }
}
</style>