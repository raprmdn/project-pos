@extends('landingpage.layouts.app')

@section('content')
  <section class="welcome-area">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('landingpage/assets/img/hero-carousel/cv.png') }}" class="img-fluid animated">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('landingpage/assets/img/hero-carousel/ban.png') }}" class="img-fluid animated">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
  </section>
  <main id="main">
    <section id="team" class="pb-5">
      <div class="container">
        <h1 align="center" class="section-title h1">Promo & Program</h1>
        <div class="row">
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip">
              <div class="mainflip flip-0">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/hot.png') }}" class="img-fluid animated">
                      <h4 class="card-title">Promo Gantung</h4>
                      <p class="card-text">Dapatkan potongan dengan membeli e-money</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
              <div class="mainflip">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/sr.jpg') }}" class="img-fluid animated">
                      <h4 class="card-title">Serba Gratis</h4>
                      <p class="card-text">Enjoy Setiap Hari</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
              <div class="mainflip">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/cbck.png') }}"
                        class="img-fluid animated">
                      <h4 class="card-title">Member Baru</h4>
                      <p class="card-text">Dapatkan diskon dan bergabung bersama kami</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
              <div class="mainflip">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/ngt.png') }}" class="img-fluid animated">
                      <h4 class="card-title">Nuget Crispy</h4>
                      <p class="card-text">Disini tersedia juga loh Nugget yang crispy</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
              <div class="mainflip">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/BK.png') }}"
                        class="img-fluid animated">
                      <h4 class="card-title">Berbuka</h4>
                      <p class="card-text">Berbuka bersama jadi makin seru.</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->
          <!-- Team member -->
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
              <div class="mainflip">
                <div class="frontside">
                  <div class="card">
                    <div class="card-body text-center">
                      <img src="{{ asset('landingpage/assets/img/hero-carousel/b1.png') }}"
                        class="img-fluid animated">
                      <h4 class="card-title">By One Get One</h4>
                      <p class="card-text">Hanya tersedia di toko kami</p>
                      <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i
                          class="fa fa-plus"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./Team member -->

        </div>
      </div>
    </section>
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>Architecto nobis eos vel nam quidem vitae temporibus voluptates qui hic deserunt iusto omnis nam
            voluptas asperiores sequi tenetur dolores incidunt enim voluptatem magnam cumque fuga.</p>
        </div>

        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-5">
            <div class="about-img">
              <img src="{{ asset('landingpage/assets/img/hero-carousel/ss.jpg') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <h3 class="pt-0 pt-lg-5">Neque officiis dolore maiores et exercitationem quae est seda lidera pat
              claero</h3>

            <!-- Tabs -->
            <ul class="nav nav-pills mb-3">
              <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Saepe fuga</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a></li>
            </ul><!-- End Tabs -->

            <!-- Tab Content -->
            <div class="tab-content">

              <div class="tab-pane fade show active" id="tab1">

                <p class="fst-italic">Consequuntur inventore voluptates consequatur aut vel et. Eos
                  doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit
                  voluptatem.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                  dolorum non eveniet magni quaerat nemo et.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur.
                  Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo
                  tempora. Quia et perferendis.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Omnis ab quia nemo dignissimos rem eum quos..</h4>
                </div>
                <p>Eius alias aut cupiditate. Dolor voluptates animi ut blanditiis quos nam. Magnam officia
                  aut ut alias quo explicabo ullam esse. Sunt magnam et dolorem eaque magnam odit enim
                  quaerat. Vero error error voluptatem eum.</p>

              </div><!-- End Tab 1 Content -->

              <div class="tab-pane fade show" id="tab2">

                <p class="fst-italic">Consequuntur inventore voluptates consequatur aut vel et. Eos
                  doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit
                  voluptatem.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                  dolorum non eveniet magni quaerat nemo et.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur.
                  Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo
                  tempora. Quia et perferendis.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Omnis ab quia nemo dignissimos rem eum quos..</h4>
                </div>
                <p>Eius alias aut cupiditate. Dolor voluptates animi ut blanditiis quos nam. Magnam officia
                  aut ut alias quo explicabo ullam esse. Sunt magnam et dolorem eaque magnam odit enim
                  quaerat. Vero error error voluptatem eum.</p>

              </div><!-- End Tab 2 Content -->

              <div class="tab-pane fade show" id="tab3">

                <p class="fst-italic">Consequuntur inventore voluptates consequatur aut vel et. Eos
                  doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit
                  voluptatem.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                  dolorum non eveniet magni quaerat nemo et.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur.
                  Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo
                  tempora. Quia et perferendis.</p>

                <div class="d-flex align-items-center mt-4">
                  <i class="bi bi-check2"></i>
                  <h4>Omnis ab quia nemo dignissimos rem eum quos..</h4>
                </div>
                <p>Eius alias aut cupiditate. Dolor voluptates animi ut blanditiis quos nam. Magnam officia
                  aut ut alias quo explicabo ullam esse. Sunt magnam et dolorem eaque magnam odit enim
                  quaerat. Vero error error voluptatem eum.</p>

              </div><!-- End Tab 3 Content -->

            </div>

          </div>

        </div>

      </div>
    </section>



    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <ul class="nav nav-tabs row gy-4 d-flex">

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
              <i class="bi bi-binoculars color-cyan"></i>
              <h4>Modinest</h4>
            </a>
          </li><!-- End Tab 1 Nav -->

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
              <i class="bi bi-box-seam color-indigo"></i>
              <h4>Undaesenti</h4>
            </a>
          </li><!-- End Tab 2 Nav -->

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
              <i class="bi bi-brightness-high color-teal"></i>
              <h4>Pariatur</h4>
            </a>
          </li><!-- End Tab 3 Nav -->

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
              <i class="bi bi-command color-red"></i>
              <h4>Nostrum</h4>
            </a>
          </li><!-- End Tab 4 Nav -->

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-5">
              <i class="bi bi-easel color-blue"></i>
              <h4>Adipiscing</h4>
            </a>
          </li><!-- End Tab 5 Nav -->

          <li class="nav-item col-6 col-md-4 col-lg-2">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-6">
              <i class="bi bi-map color-orange"></i>
              <h4>Reprehit</h4>
            </a>
          </li><!-- End Tab 6 Nav -->

        </ul>

        <div class="tab-content">

          <div class="tab-pane active show" id="tab-1">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                <h3>Modinest</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                    storacalaperda mastiro dolore eu fugiat nulla pariatur.
                  </li>
                </ul>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('landingpage/assets/img/features-1.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 1 -->

          <div class="tab-pane" id="tab-2">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1">
                <h3>Undaesenti</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Provident mollitia neque rerum asperiores
                    dolores quos qui a. Ipsum neque dolor voluptate nisi sed.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                    storacalaperda mastiro dolore eu fugiat nulla pariatur.
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/features-2.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 2 -->

          <div class="tab-pane" id="tab-3">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1">
                <h3>Pariatur</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Provident mollitia neque rerum asperiores
                    dolores quos qui a. Ipsum neque dolor voluptate nisi sed.
                  </li>
                </ul>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/features-3.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 3 -->

          <div class="tab-pane" id="tab-4">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1">
                <h3>Nostrum</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                    storacalaperda mastiro dolore eu fugiat nulla pariatur.
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/features-4.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 4 -->

          <div class="tab-pane" id="tab-5">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1">
                <h3>Adipiscing</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                    storacalaperda mastiro dolore eu fugiat nulla pariatur.
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/features-5.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 5 -->

          <div class="tab-pane" id="tab-6">
            <div class="row gy-4">
              <div class="col-lg-8 order-2 order-lg-1">
                <h3>Reprehit</h3>
                <p>
                  Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                  reprehenderit in voluptate
                  velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in
                  culpa qui officia deserunt mollit anim id est laborum
                </p>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore
                  magna aliqua.
                </p>
                <ul>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in
                    voluptate velit.
                  </li>
                  <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea
                    commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                    storacalaperda mastiro dolore eu fugiat nulla pariatur.
                  </li>
                </ul>
              </div>
              <div class="col-lg-4 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/features-6.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End Tab Content 6 -->

        </div>

      </div>
    </section>

    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Team</h2>
          <p>Architecto nobis eos vel nam quidem vitae temporibus voluptates qui hic deserunt iusto omnis nam
            voluptas asperiores sequi tenetur dolores incidunt enim voluptatem magnam cumque fuga.</p>
        </div>

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('landingpage/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
                <h4>Muhammad Nabil Islam</h4>
                <span>Programmer</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('landingpage/assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="600">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('landingpage/assets/img/team/team-3.jpg') }}" class="img-fluid" alt="">
              </div>
              <div class="member-info">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
                <h4>Muhammad Yusuf Hijriah</h4>
                <span>Analys</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>
    </section>

    <section id="contact" class="contact">
      <div class="container">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Ea vitae aspernatur deserunt voluptatem impedit deserunt magnam occaecati dssumenda quas ut ad
            dolores adipisci aliquam.</p>
        </div>
      </div>

      <div class="container">
        <div class="row gy-5 gx-lg-5">
          <div class="col-lg-12">
            <form action="#" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                    required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                    required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                  required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center">
                <button type="submit">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection
