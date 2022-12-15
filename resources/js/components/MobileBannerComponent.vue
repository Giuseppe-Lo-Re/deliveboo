<template>
    <div class="ms_mobile-app">
        <div class="ms_container">
            <div class="ms_mobile-app-left">
                <div class="ms_mobile-app-img">
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
                </div>
            </div>
            <div class="ms_mobile-app-right">

                <!-- banner Title -->
                <h2>
                    Scarica l'App
                </h2>

                <div class="d-flex ms_app-link">

                    <!-- Apple Store Logo -->
                    <a class="ms_mobile-logo" href="https://www.apple.com/it/app-store/">
                        <img src="https://www.mcdonalds.it/themes/mcd/build/images/app/app-store.png" alt="App Store logo">
                    </a>
                    
                    <!-- Google Play Logo -->
                    <a class="ms_mobile-logo" href="https://play.google.com/store/games?hl=it&gl=US">
                        <img src="https://www.mcdonalds.it/themes/mcd/build/images/app/google-play.png" alt="Google Play logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MobileBannerComponent',
}

</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

.ms_mobile-app {
    padding-block: 4rem;
    background: $primary-color;
    background: radial-gradient(circle, 
                rgba(255,197,9,1) 58%,
                rgba(235,179,2,1) 80%, 
                rgba(208,158,0,1) 100%);

    .ms_container {
        margin-inline: auto;
        width: 50%;
        max-width: 800px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;

        .ms_mobile-app-left {
            width: fit-content;
            
            .ms_mobile-app-img {
                padding: 1rem;
                width: 200px;
                aspect-ratio: 1 / 1;
                position: relative;
                background-color: #fff;
                border-radius: 2.8rem;
                box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, 
                            rgba(0, 0, 0, 0.3) 0px 7px 13px -3px,
                            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;

                > svg {
                    width: 150px;
                    color: #212529;
                    rotate: -20deg;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    translate: -50% -50%;
                }
            }
        }

        .ms_mobile-app-right {
            width: 50%;
            
            h2 {
                margin-bottom: 1.5rem;
                text-align: center;
                color: #212529;
                font-weight: 700;
            }

            > .d-flex {
                gap: 0 1.5rem;

                .ms_mobile-logo {
                    display: block;
                    
                    &:hover {
                        cursor: pointer;
                    }
                }
            }
        }
    }
}

// MEDIA QUERIES
@media (max-width: 970px) { 

    .ms_mobile-app {

        .ms_container {
            width: 60%;
        }
    }
}

@media (max-width: 768px) { 

    .ms_mobile-app {

        .ms_container {
            flex-direction: column;

            .ms_mobile-app-left {
                
                .ms_mobile-app-img {
                    margin-bottom: 1.5rem;
                }
            }

            .ms_mobile-app-right {
                width: 90%;
            }
        }
    } 
}

@media (max-width: 620px) { 

    .ms_mobile-app {

        .ms_container {
            width: 80%;

        }
    } 
}

@media (max-width: 450px) { 

    .ms_mobile-app {

        .ms_container {
            padding-inline: 1rem;
            width: 100%;

            .ms_mobile-app-right {
                width: 100%;

                .ms_app-link {
                     margin-inline: auto;
                    width: fit-content;
                    flex-direction: column;
                    
                    > a.ms_mobile-logo {
                        width: 200px;
                    }

                    > a.ms_mobile-logo:first-child {
                        margin-bottom: 1.5rem;
                    }
                }
            }
        }
    } 
}
</style>