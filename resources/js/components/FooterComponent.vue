<template>
  <!-- Footer -->

  <footer class="text-center text-white">

    <!-- Grid container -->
    <div class="ms_container p-4">

      <!-- Section: Links -->
      <div class="links-container">

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col">
          <ul class="list-unstyled mb-0">

            <!-- Title -->
            <h5>
              Toast Rider
            </h5>

            <!-- List -->
            <li>
              <a href="#!" class="text-white">Impara a cucinare</a>
            </li>
            <li>
              <a href="#!" class="text-white">Ascoli Porto Sant'Elpidio</a>
            </li>
            <li>
              <a href="#!" class="text-white">Facci un Surrounding</a>
            </li>
            <li>
              <a href="#!" class="text-white">Bububaba</a>
            </li>
            <li>
              <a href="https://campo-minato.com" class="text-white">Campo Minato</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col">
          <ul class="list-unstyled mb-0">

            <!-- Title -->
            <h5>
              Dove siamo
            </h5>

            <!-- List -->
            <li>
              <a href="#!" class="text-white">Roma</a>
            </li>
            <li>
              <a href="#!" class="text-white">Madrid</a>
            </li>
            <li>
              <a href="#!" class="text-white">Messina</a>
            </li>
            <li>
              <a href="#!" class="text-white">Caserta</a>
            </li>
            <li>
              <a href="#!" class="text-white">Catania</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col">
          <ul class="list-unstyled mb-0">

            <!-- Title -->
            <h5>
              Lavora con noi
            </h5>

            <!-- List -->
            <li>
              <a href="https://github.com/Borrellsss" class="text-white">Edoardo Filippo Borrello</a>
            </li>
            <li>
              <a href="https://github.com/Ilariallaria" class="text-white">Ilaria Leone</a>
            </li>
            <li>
              <a href="https://github.com/Giuseppe-lore" class="text-white">Giuseppe Lo Re</a>
            </li>
            <li>
              <a href="https://github.com/jacoposergio" class="text-white">Jacopo Sergio</a>
            </li>
            <li>
              <a href="https://github.com/Zibo88" class="text-white">Vincenzo Tardino</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col">
          <ul class="list-unstyled mb-0">

            <!-- Title -->
            <h5>
              Note Legali
            </h5>

            <!-- List -->
            <li>
              <a href="#!" class="text-white">Vince, non ti vedo convinto!</a>
            </li>
            <li>
              <a href="#!" class="text-white">Poi lo vediamo</a>
            </li>
            <li>
              <a href="#!" class="text-white">Funziona cosi...</a>
            </li>
            <li>
              <a href="#!" class="text-white">Il Browser</a>
            </li>
            <li>
              <a href="https://www.youtube.com/watch?v=Fq0HUIWLo5o" class="text-white">Facci causa!</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
      </div>

      <!-- Section: Social media -->
      <div class="d-flex social-media-links">

        <!-- Twitter -->
        <a class="ms_social-btn" href="#!">
          <i class="fab fa-twitter"></i>
        </a>

        <!-- Google -->
        <a class="ms_social-btn" href="#!">
          <i class="fab fa-google"></i>
        </a>

        <!-- Instagram -->
        <a class="ms_social-btn" href="#!">
          <i class="fab fa-instagram"></i>
        </a>

        <!-- Linkedin -->
        <a class="ms_social-btn" href="#!">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Section: Social media -->

    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="ms_copyright text-center p-3">
      © 2022 Copyright | Toast Rider S.p.A. 
    </div>
    <!-- Copyright -->
  </footer>
<!-- Footer -->
</template>

<script>
export default {
  name: 'FooterComponent'
}
</script>

<style lang="scss" scoped>
@import '../style/variables';
@import '../style/common';

  footer {
    background-color: #202020;

    .ms_container {
      width: 87%;
      max-width: 1300px;
      margin: 0 auto;

      h5 {
        color: $primary-color;
        padding-bottom: 1rem;
      }
          
      .links-container {
        margin-top: 3rem;
      }

      .social-media-links {
        margin-top: 2.5rem;
        margin-bottom: 3rem;
        justify-content: center;
        gap: 0.7rem;
      }

      .ms_social-btn {
        width: 50px;
        aspect-ratio: 1 / 1;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        border: 2px solid #fff;
        border-radius: 50%;
      }

      .ms_social-btn:hover {
        color: $primary-color;
        border: 2px solid $primary-color;
        box-shadow: 0 0 5px $primary-color;
      }
    }

    .ms_copyright {
      background-color: #151515;
    }
  }
</style>