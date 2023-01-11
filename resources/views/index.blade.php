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
                    <img src="{{ asset('landingpage/assets/img/hero-carousel/wlcm.png') }}" class="img-fluid animated">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('landingpage/assets/img/hero-carousel/vf.jpg') }}" class="img-fluid animated">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
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
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/hot.png') }}"
                                                 class="img-fluid animated">
                                            <h4 class="card-title">Promo Gantung</h4>
                                            <p class="card-text">Dapatkan potongan dengan membeli e-money</p>
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/sr.jpg') }}"
                                                 class="img-fluid animated">
                                            <h4 class="card-title">Serba Gratis</h4>
                                            <p class="card-text">Enjoy Setiap Hari</p>
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/ngt.png') }}"
                                                 class="img-fluid animated">
                                            <h4 class="card-title">Nuget Crispy</h4>
                                            <p class="card-text">Disini tersedia juga loh Nugget yang crispy</p>
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <a href="https://www.fiverr.com/share/qb8D02"
                                               class="btn btn-primary btn-sm"><b
                                                    class="fa fa-plus">pilih promo</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="team" class="pb-5">
            <div class="container">
                <h1 align="center" class="section-title h1">Layanan Digital</h1>
                <div class="row">
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip">
                            <div class="mainflip flip-0">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/shp.png') }}"
                                                 class="img-fluid animated">
                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/dc.jpg') }}"
                                                 class="img-fluid animated">

                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/gpy.jpg') }}"
                                                 class="img-fluid animated">

                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/ln.jpg') }}"
                                                 class="img-fluid animated">
                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/dk.jpg') }}"
                                                 class="img-fluid animated">

                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <img src="{{ asset('landingpage/assets/img/hero-carousel/sc.jpg') }}"
                                                 class="img-fluid animated">
                                            <a href="https://www.fiverr.com/share/qb8D02"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">
                <div class="section-header">
                    <h2>Hubungi Kami</h2>
                </div>
            </div>

            <div class="container">
                <div class="row gy-5 gx-lg-5">
                    <div class="col-lg-12">
                        <form action="#" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Your Name"
                                           required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Your Email"
                                           required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                       placeholder="Subject"
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
