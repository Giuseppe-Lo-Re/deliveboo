<template>
  <section>
    <div class="ms_main-jumbotron">
      <div class="ms_jumbotron-container d-flex">
        <div class="jumbotron-text">

          <!-- Title -->
          <h1 class="front-office-style">
            TOAST RIDER
          </h1>

          <!-- Subtitle -->
          <p class="front-office-style">
            L'unico servizio di delivery che porta i migliori ristoranti a casa tua, <br>
            rapidamente e senza spese di spedizione. <br>
            Affidati al potere del toast!
          </p>
        </div>
      </div> 
    </div> 
  </section>
</template>

<script>
export default {
  name: 'JumbotronComponent'
}

</script>

<style lang="scss" scoped>
@import '../../style/variables';
@import '../../style/common';

.ms_main-jumbotron {

  h1 {
    font-size: 9.5rem;
    font-weight: 700;
    text-shadow: 4px 4px 0 #ffc509, 4px -4px 0 #ffc509,-4px 4px 0 
    #ffc509, -4px -4px 0 #ffc509, 4px 0px 0 
    #ffc509, 0px 4px 0 #ffc509, -4px 0px 0 
    #ffc509, 0px -4px 0 #ffc509;
  }

  margin-top: 5.5rem;
  height: 700px;
  color: $secondary-color;
  background-image: url(https://i.ibb.co/zXPr22D/jumbotron-img.jpg);
  background-size: cover;
  background-position-x: 50%;
  background-position-y: 0;

  .ms_jumbotron-container {
    padding-inline: 2rem;
    height: 100%;
    justify-content: center;
    align-items: center;

    .jumbotron-text {
      text-align: center;

      p {
        font-size: 1.3rem;
        text-shadow: 2px 2px 0 #ffc509, 2px -2px 0 #ffc509,
        -2px 2px 0 #ffc509, -2px -2px 0 #ffc509, 2px 0px 0 #ffc509,
        0px 2px 0 #ffc509, -2px 0px 0 #ffc509, 0px -2px 0 #ffc509;
      }
    }
  }
}

// MEDIA QUERIES
@media only screen and (max-width: 560px) {

  .ms_main-jumbotron {
    margin-top: 5.5rem;
    height: 570px;

    .ms_jumbotron-container {

      .jumbotron-text {

        h1 {
          font-size: 5rem;
          margin-bottom: 1.3rem;
        }
        
        p {
          font-size: 1rem;
          text-shadow: 2px 2px 0 #ffc509, 2px -2px 0 #ffc509,
          -2px 2px 0 #ffc509, -2px -2px 0 #ffc509, 2px 0px 0 #ffc509,
          0px 2px 0 #ffc509, -2px 0px 0 #ffc509, 0px -2px 0 #ffc509;
        }
      }
    }
  }
}
</style>
 