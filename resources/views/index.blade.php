<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <meta name="description" content="" />
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
  <link rel="icon" type="image/png" sizes="96x96" href=".t/img/favicon.png" />
  <title>Sport Training Hub</title>
  <link rel="stylesheet" href="css/theme.min.css" />
  <link rel="stylesheet" href="css/custom.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <style>
    /* inter-300 - latin */
    @font-face {
      font-family: "Inter";
      font-style: normal;
      font-weight: 300;
      font-display: swap;
      src: local(""), url("./fonts/inter-v12-latin-300.woff2") format("woff2"),
        /* Chrome 26+, Opera 23+, Firefox 39+ */
        url("./fonts/inter-v12-latin-300.woff") format("woff");
      /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
    }

    @font-face {
      font-family: "Inter";
      font-style: normal;
      font-weight: 500;
      font-display: swap;
      src: local(""), url("./fonts/inter-v12-latin-500.woff2") format("woff2"),
        /* Chrome 26+, Opera 23+, Firefox 39+ */
        url("./fonts/inter-v12-latin-500.woff") format("woff");
      /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
    }

    @font-face {
      font-family: "Inter";
      font-style: normal;
      font-weight: 700;
      font-display: swap;
      src: local(""), url("./fonts/inter-v12-latin-700.woff2") format("woff2"),
        /* Chrome 26+, Opera 23+, Firefox 39+ */
        url("./fonts/inter-v12-latin-700.woff") format("woff");
      /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
    }
  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navScroll">
  <nav id="navScroll" class="navbar navbar-expand-lg navbar-light fixed-top" tabindex="0">
    <div class="container">
      <a class="navbar-brand fs-4 pe-4" href="/">
        <img src="./img/logo.png" width="32" height="32" fill="currentColor" class="bi bi-layers-half" />
        <span class="fw-bolder ms-1">Sport Training Hub</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarSupportedContent"">
        <ul class="navbar-nav mb-lg-0 mb-2 me-auto" style="flex:1; justify-content: end;">
          <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
          <li class="nav-item"><a class="nav-link" href="#features"> Fitur </a></li>
          <li class="nav-item"><a class="nav-link" href="#benefits"> Keuntungan </a></li>
          <li class="nav-item"><a class="nav-link" href="#contact"> Hubungi Kami </a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <div class="w-100 overflow-hidden bg-gray-100" id="top">
      <div class="position-relative container">
        <div class="col-12 col-lg-8 h-100 position-absolute hero-background end-0 top-0 mt-0 bg-cover"
          data-aos="fade-left"></div>
        <div class="row">
          <div class="col-lg-7 py-vh-6 position-relative" data-aos="fade-right">
            <div>
              <h1 class="display-1 fw-bold mt-5" style="font-size: 36px;padding-bottom: 15px;">
                Platform All-in-One <br />Manajemen Pelatihan Olahraga
              </h1>
              <p class="lead">
                <b>Sport Training Hub</b> adalah solusi terbaik untuk
                manajemen pelatihan olahraga untuk menyederhanakan jadwal
                latihan, manajemen pemain, pembayaran, dan pelacakan performa,
                semuanya dalam satu platform yang mudah digunakan.
              </p>
            </div>
            <a href="{{ route('register-options') }}"
              class="btn btn-xl rounded-0 primary-btn my-5 me-3 shadow">
              Demo
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="py-vh-5 w-100 overflow-hidden" id="services" style="padding-top: 100px;">
      <div class="container">
        <h1 class="text-center" style="padding-bottom: 30px; padding-top: 20px">
          Mengapa Memilih Sport Training Hub?
        </h1>
        <div class="row d-flex">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <span class="h5 fw-lighter mt-3">01.</span>
            <h3 class="border-top border-dark py-3">
              Manajemen yang Terorganisir
            </h3>
            <p>
              Hemat waktu dan fokus pada hal yang penting — yaitu melatih tim Anda.
              Kelola jadwal, pembayaran, dan data pemain dengan mudah.
            </p>
            <!-- <a href="#" class="link-fancy">Learn more </a> -->
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <span class="h5 fw-lighter mt-3">02.</span>
            <h3 class="border-top border-dark py-3">Tingkatkan Performa</h3>
            <p>
              Analisis performa dan kehadiran pemain untuk mengoptimalkan sesi
              latihan.
            </p>
            <!-- <a href="#" class="link-fancy">Learn more </a> -->
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <span class="h5 fw-lighter mt-3">03.</span>
            <h3 class="border-top border-dark py-3">
              Fleksibel untuk Semua Olahraga.
            </h3>
            <p>
              Dapat disesuaikan untuk olahraga atau ukuran tim apa pun, dari
              klub santai hingga tim profesional.
            </p>
            <!-- <a href="#" class="link-fancy">Learn more </a> -->
          </div>
        </div>
      </div>
    </div>

    <div id="features" class="small w-100 overflow-hidden py-2">
      <div class="container" style="padding-top: 100px">
        <h2 class="text-center" style="padding-bottom: 30px">Fitur Utama</h2>
        <div class="row">
          <div class="col-md-6 col-lg-4 border-end" data-aos="fade-up">
            <div class="d-flex">
              <div class="col-md-3 flex-fill pe-md-0 pe-3 pt-3">
                <i class="fa-solid fa-people-group feature-icon"></i>
              </div>
              <div class="col-md-9 flex-fill">
                <h3 class="h5 my-2">Manajemen Keanggotaan</h3>
                <ul>
                  <li>Pendaftaran pemain dan pembuatan profil yang mudah.</li>
                  <li>
                    Statistik pemain lengkap: kehadiran, performa, dan
                    pencapaian.
                  </li>
                  <li>
                    Cari dan filter pemain berdasarkan nama, posisi, atau
                    level.
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 border-end" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex">
              <div class="col-md-3 flex-fill pe-md-0 pe-3 pt-3 pt-3">
                <i class="fa-solid fa-calendar-days feature-icon"></i>
              </div>
              <div class="col-md-9 flex-fill">
                <h3 class="h5 my-2">Penjadwalan Latihan dan Aktivitas</h3>
                <ul>
                  <li>
                    Kalender interaktif untuk sesi latihan, pertandingan, dan
                    acara.
                  </li>
                  <li>Pengingat otomatis untuk pemain dan pelatih.</li>
                  <li>
                    Integrasi pemesanan tempat untuk perencanaan yang mudah.
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 border-end" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex">
              <div class="col-md-3 flex-fill pe-md-0 pe-3 pt-3 pt-3">
                <i class="fa-solid fa-money-bill feature-icon"></i>
              </div>
              <div class="col-md-9 flex-fill">
                <h3 class="h5 text-red my-2">
                  Sistem Pembayaran dan Langganan
                </h3>
                <ul>
                  <li>
                    Kalender interaktif untuk sesi latihan, pertandingan, dan
                    acara.
                  </li>
                  <li>Pengingat otomatis untuk pemain dan pelatih.</li>
                  <li>
                    Integrasi pemesanan tempat untuk perencanaan yang mudah.
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 border-end" data-aos="fade-up">
            <div class="d-flex">
              <div class="col-md-2 flex-fill pe-md-0 pe-3 pt-3">
                <i class="fa-solid fa-chart-column feature-icon"></i>
              </div>
              <div class="col-md-10 flex-fill">
                <h3 class="h5 my-2">Pelacakan Performa</h3>
                <ul>
                  <li>Catat performa dan kehadiran latihan.</li>
                  <li>
                    Pantau statistik utama seperti servis, smash, gol, assist,
                    kecepatan, dan daya tahan.
                  </li>
                  <li>Visualisasikan kemajuan melalui grafik dan laporan.</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 border-end" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex">
              <div class="col-md-2 flex-fill pe-md-0 pe-3 pt-3 pt-3">
                <i class="fa-solid fa-calendar-days feature-icon"></i>
              </div>
              <div class="col-md-10 flex-fill">
                <h3 class="h5 my-2">Sistem Penggajian Pelatih</h3>
                <ul>
                  <li>
                    Sistem gaji berbasis poin dari kehadiran pemain dan poin
                    untuk acara khusus seperti pertandingan atau sesi ekstra
                  </li>
                  <li>Perhitungan gaji otomatis berdasarkan poin.</li>
                  <li>Riwayat penggajian yang transparan untuk pelatih.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="benefits" class="py-vh-4 w-100 overflow-hidden bg-gray-100" style="padding-top: 100px">
      <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-lg-6">
            <div class="row gx-5 d-flex">
              <div class="col-md-11">
                <div class="ratio ratio-16x9 bp-center align-self-end rounded bg-cover shadow" data-aos="fade-right"
                  style="
                      background-image: url(img/image-2.png);
                      --bs-aspect-ratio: 50%;
                    ">
                </div>
              </div>
              <div class="col-md-5 offset-md-1">
                <div class="ratio ratio-1x1 bp-center float-end mt-5 rounded bg-cover shadow" data-aos="fade-up"
                  style="background-image: url(img/image-3.png)"></div>
              </div>
              <div class="col-md-6">
                <div class="col-12 ratio bp-center mt-5 rounded bg-cover shadow" data-aos="fade-left"
                  style="
                      background-image: url(img/image-4.png);
                      --bs-aspect-ratio: 150%;
                    ">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <h3 class="border-top border-dark py-5" data-aos="fade-right">
              Manfaat untuk Semua
            </h3>
            <ul>
              <li class="mb-3" data-aos="fade-down">
                Pemain tetap terinformasi mengenai jadwal latihan dan mudah
                dalam memantau kemajuan.
              </li>
              <li class="mb-3" data-aos="fade-down">
                Pelatih dapat fokus pada pelatihan dengan alat administrasi
                otomatis.
              </li>
              <li class="mb-3" data-aos="fade-down">
                Manajer Tim mudah dalam mengelola pembayaran, performa, dan
                kehadiran dengan efisien.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-5 mt-5 text-center">
      <h3 id="contact">Siap Meningkatkan Manajemen Pelatihan Olahraga Anda?</h3>
      <p>
        Bergabunglah dengan <b>Sport Training Hub</b> dan rasakan kemudahan
        mengelola tim olahraga seperti belum pernah dilakukan sebelumnya.
      </p>
      <a href="{{ route('register-options') }}"
        class="btn btn-xl rounded-0 primary-btn my-5 me-3 shadow">
        Demo
      </a>
    </div>
  </main>

  <footer style="margin-top: 100px">
    <div class="small container py-3 text-center">
      Developed by <a href="https://shiftech.my.id">Shiftech Indonesia</a>
    </div>
  </footer>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
    });
  </script>

  <script>
    let scrollpos = window.scrollY;
    const header = document.querySelector(".navbar");
    const header_height = header.offsetHeight;

    const add_class_on_scroll = () =>
      header.classList.add("scrolled", "shadow-sm");
    const remove_class_on_scroll = () =>
      header.classList.remove("scrolled", "shadow-sm");

    window.addEventListener("scroll", function() {
      scrollpos = window.scrollY;

      if (scrollpos >= header_height) {
        add_class_on_scroll();
      } else {
        remove_class_on_scroll();
      }

      console.log(scrollpos);
    });
  </script>
</body>

</html>
