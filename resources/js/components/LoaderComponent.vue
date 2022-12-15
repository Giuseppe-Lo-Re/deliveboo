<template>
    <!-- Loader Text -->
    <div class="ms_loader-wrapper">
        Loading

        <!-- Loader Ellipsis -->
        <span class="ms_animated-dot-1">.</span>
        <span class="ms_animated-dot-2">.</span>
        <span class="ms_animated-dot-3">.</span>
    </div>
</template>

<script>
export default {
    name: 'LoaderComponent',
}
</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

.ms_loader-wrapper {
    margin-top: 3rem;
    margin-inline: auto;
    padding-block: 2rem;
    letter-spacing: 3px;
    font-size: 1.2rem;
    font-weight: 600;
    text-align: center;
    font-style: oblique;
    color: $secondary-color;
    background-color: $primary-color;
    background: radial-gradient(circle, rgba(255,197,9,1) 58%, rgba(235,179,2,1) 80%, rgba(208,158,0,1) 100%);

    > .ms_animated-dot-1 {
        animation: first-dot 400ms infinite;
        animation-delay: 600ms;

        @keyframes first-dot {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 0;
            }
        }
    }
    
    > .ms_animated-dot-2 {
        animation: second-dot 400ms infinite;
        animation-delay: 300ms;

        @keyframes second-dot {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 0;
            }
        }
    }
    > .ms_animated-dot-3 {
        animation: third-dot 400ms infinite;
        animation-delay: 0;

        @keyframes third-dot {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 0;
            }
        }
    }
}
</style>