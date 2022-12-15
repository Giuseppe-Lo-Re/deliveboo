<template>
    <section>
        <div class="ms_main-container">
            <div class="d-flex">
                <div class="box">

                    <!-- Card Icon -->
                    <div class="text-center pb-3 secondary-color">
                        <i class="fa-solid fa-bicycle fa-4x"></i>
                    </div>

                    <!-- Card Title -->
                    <h3 class="text-center mb-3">
                        Diventa un Rider
                    </h3>

                    <!-- Card Text -->
                    <p class="text-center">
                        Flessibilità, ottimi guadagni e un mondo di vantaggi per te!
                    </p>
                </div>

                <div class="box">

                    <!-- Card Icon -->
                    <div class="text-center pb-3 secondary-color">
                        <i class="fa-solid fa-recycle fa-4x"></i>
                    </div>
                    
                    <h3 class="text-center mb-3">
                        Rispettiamo l'Ambiente
                    </h3>
                    
                    <!-- Card Text -->
                    <p class="text-center">
                        Utilizziamo un packaging Plastic-free funzionale e sostenibile.
                    </p>
                </div>

                <div class="box">
                    
                    <!-- Card Icon -->
                    <div class="text-center pb-3 secondary-color">
                        <i class="fa-solid fa-utensils fa-4x"></i>
                    </div>

                    <!-- Card Title -->
                    <h3 class="text-center mb-3">
                        Lavora con noi
                    </h3>

                    <!-- Card Text -->
                    <p class="text-center">
                        La nostra missione è trasformare il modo in cui le persone mangiano.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HiringComponent'
}
</script>

<style lang="scss" scoped>
@import '../../style/variables';
@import '../../style/common';

section {
    padding-block: 4rem;

    .ms_main-container {
        margin-inline: auto;
        width: 80%;
        max-width: 1300px;
        
        > .d-flex {
            gap: 1.5rem;

            .box {
                width: calc((100% / 3) - 1rem);
                align-self: flex-start;
                cursor: pointer;
            }

            .primary-color {
                color: $primary-color;
            }
            
            .secondary-color {
                color: $secondary-color;
            }
        }
    }

    @media (max-width: 830px) {

        .ms_main-container {
            
            > .d-flex {
                flex-direction: column;

                .box {
                    width: 50%;
                    align-self: center;
                }
            }
        }
    }

    @media (max-width: 600px) {

        .ms_main-container {
            
            > .d-flex {

                .box {
                    width: 80%;
                }
            }
        }
    }

    @media (max-width: 400px) {

        .ms_main-container {
            
            > .d-flex {

                .box {
                    width: 100%;
                }
            }
        }
    }
}
</style>