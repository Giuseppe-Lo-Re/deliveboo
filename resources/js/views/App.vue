<template>
    <div>
        <!-- Header Component -->
        <HeaderComponent />

        <main>
			<router-view></router-view>
	    </main>

        <!-- Cookies Component -->
        <CookiesComponent/>

        <!-- Footer Component -->
        <FooterComponent/>
    </div>
</template>

<script>

import HeaderComponent from '../components/HeaderComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';
import CookiesComponent from '../components/CookiesComponent.vue'

import '@fortawesome/fontawesome-free/js/all.js';

export default {
    name: 'App',
    components: {
        HeaderComponent, 
        FooterComponent,
        CookiesComponent
    },
}
</script>

<style lang="scss">
@import '~bootstrap/scss/bootstrap';
@import '../style/variables';
@import '../style/common';

* {
    font-family: 'Poppins', sans-serif;
}
</style>
