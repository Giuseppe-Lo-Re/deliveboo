<template>

  <main>
    <JumbotronComponent/>
  </main>
  
</template>

<script>

  import JumbotronComponent from '../components/sections/JumbotronComponent.vue';
  
  export default {
      name: 'MainComponent',
      components: {
          JumbotronComponent,
      }
  }

</script>

<style lang="scss" scoped>

@import '../style/variables';
@import '../style/common';

main {
  background-color: lightgray;
}
</style>