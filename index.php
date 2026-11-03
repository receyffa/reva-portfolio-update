
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "koneksi.php";

// Mengambil data pribadi dari database
$query_pribadi = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_data_pribadi LIMIT 1"
);

if (!$query_pribadi) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$data_pribadi = mysqli_fetch_assoc($query_pribadi);

// Data dari database, dengan nilai cadangan
$nama = !empty($data_pribadi['nama'])
    ? $data_pribadi['nama']
    : 'Reva pramnesti';

$deskripsi = !empty($data_pribadi['deskripsi'])
    ? $data_pribadi['deskripsi']
    : 'Just a cute student trying not to break the code. Still learning, still coding, still trying new things.';

// Mengambil nama foto dari database
$nama_foto = !empty($data_pribadi['foto'])
    ? basename($data_pribadi['foto'])
    : 'foto ecev.jpeg';

// Lokasi foto di folder assets
$foto = 'assets/foto%20ecev.jpeg';

// Mengamankan data sebelum ditampilkan
$nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$deskripsi = htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8');
$foto = htmlspecialchars($foto, ENT_QUOTES, 'UTF-8');
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teknik Imut | Home</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS portofolio -->
    <link rel="stylesheet" href="style.css">

    <style>
        .hero-note {
            color: #587064;
            font-size: 0.95rem;
        }

        /* MENU TITIK TIGA */
        .site-header .navbar {
            position: relative;
        }

        .menu-dots {
            display: block;
            border: none;
            background: transparent;
            color: #173b63;
            font-size: 30px;
            line-height: 1;
            padding: 5px 10px;
            cursor: pointer;
        }

        .dots-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            z-index: 1000;
            min-width: 160px;
            padding: 8px;
            background: #fffdf8;
            border: 1px solid #e7d8c9;
            border-radius: 12px;
            box-shadow: 0 8px 24px #00000015;
        }

        .dots-menu[hidden] {
            display: none !important;
        }

        .dots-menu a {
            display: block;
            padding: 10px 12px;
            color: #173b63;
            text-decoration: none;
            border-radius: 8px;
        }

        .dots-menu a:hover {
            background: #f5e8e7;
        }

        /* Sembunyikan menu navigasi lama */
        .site-header .nav-links {
            display: none !important;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <nav class="navbar container" aria-label="Navigasi utama">
            <a class="logo" href="index.php">
                hi<span> hallooo</span><b>.</b>
            </a>

            <!-- Tombol titik tiga -->
            <button
                class="menu-dots"
                type="button"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="dots-menu"
                onclick="
                    const menu = document.getElementById('dots-menu');
                    const isClosed = menu.hidden;
                    menu.hidden = !isClosed;
                    this.setAttribute('aria-expanded', isClosed);
                "
            >
                ⋮
            </button>

            <!-- Isi menu -->
            <div class="dots-menu" id="dots-menu" hidden>
                <a href="index.php">Home</a>
                <a href="about.html">About</a>
                <a href="projects.html">Projects</a>
                <a href="contact.html">Contact</a>
            </div>
        </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <main>

        <!-- HERO -->
        <section class="hero container">
            <div class="hero-copy">

                <p class="eyebrow" style="letter-spacing: 2.1px">
                    <span class="status-dot"></span>
                    WELCOME TO MY PORTFOLIO
                </p>

                <h1>
                    Hi, I'm <span class="pink-text"><?php echo $nama; ?>.</span><br>
                    INFORMATICS <br>
                    <span class="green-text">STUDENT</span><span class="period">.</span>
                </h1>

                <p class="hero-description">
                    <?php echo nl2br($deskripsi); ?>
                </p>

                <p class="hero-note">
                    Currently exploring: web development &amp; game development
                </p>

                <div class="hero-actions">
                    <a class="button button-primary" href="projects.html">
                        Lihat Project <span>↗</span>
                    </a>

                    <a class="text-link" href="about.html">
                        Kenalan lebih dekat <span>→</span>
                    </a>
                </div>

                <div class="mini-stats">
                    <div>
                        <strong>03</strong>
                        <span>Halaman utama</span>
                    </div>

                    <div class="stat-line"></div>

                    <div>
                        <strong>∞</strong>
                        <span>Hal baru dipelajari</span>
                    </div>
                </div>

            </div>

            <!-- FOTO PROFIL -->
            <div class="hero-art">
                <div class="art-orbit orbit-one"></div>
                <div class="art-orbit orbit-two"></div>

                <div class="profile-frame">
                    <img
                        src="<?php echo $foto; ?>"
                        alt="Foto profil Reva"
                        width="360"
                        height="420"
                    >

                    <div class="profile-sticker sticker-top">HELLO!</div>

                    <div class="profile-sticker sticker-bottom">
                        안녕하세요! Annyeonghaseyo!
                    </div>
                </div>

                <span class="spark spark-one">*</span>
                <span class="spark spark-two">*</span>
            </div>
        </section>

        <!-- INTRO STRIP -->
        <section class="intro-strip">
            <div class="container strip-inner">
                <p>CURIOUS MIND</p>
                <span>-</span>
                <p>CREATIVE IDEAS</p>
                <span>-</span>
                <p>CODE &amp; CREATE</p>
                <span>-</span>
                <p>GROW EVERY DAY</p>
            </div>
        </section>

        <!-- INTRODUCTION -->
        <section class="section container">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">A LITTLE INTRO</p>
                    <h2>Small steps, <span class="pink-text">big ideas.</span></h2>
                </div>

                <a class="text-link" href="about.html">
                    More about me <span>→</span>
                </a>
            </div>

            <div class="feature-grid">

                <article class="feature-card card-green">
                    <div class="card-icon">⌘</div>
                    <p class="card-label">01 / WHAT I DO</p>
                    <h3>Always Exploring</h3>
                    <p>
                        Aku suka mencoba hal baru dan mempelajari hal-hal yang belum
                        pernah aku ketahui sebelumnya.
                    </p>
                </article>

                <article class="feature-card card-pink">
                    <div class="card-icon">✳</div>
                    <p class="card-label">02 / WHAT I LIKE</p>
                    <h3>Tech &amp; Creativity</h3>
                    <p>
                        Ketertarikan pada dunia teknologi, desain digital, dan ide-ide
                        kreatif yang bisa diwujudkan jadi sesuatu yang menarik.
                    </p>
                </article>

                <article class="feature-card card-white">
                    <div class="card-icon">↗</div>
                    <p class="card-label">03 / MY APPROACH</p>
                    <h3>KEEP GROWING</h3>
                    <p>
                        Masih belajar banyak hal, sambil cari tahu apa yang paling aku
                        suka dan ingin aku kembangkan.
                    </p>
                </article>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="logo" href="index.php">
                my<span>space</span><b>.</b>
            </a>

            <p>
                Personal Portfolio <span>-</span> © 2026 Reva
                <a href="contact.html">Say hello ↗</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>





