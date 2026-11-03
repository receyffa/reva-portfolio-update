
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "koneksi.php";

// Mengambil data profil dari database
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_data_pribadi LIMIT 1"
);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Menghindari error jika data belum tersedia
$data = mysqli_fetch_assoc($query);

if (!$data) {
    $data = [];
}

// Mengambil data dari database
$nama = !empty($data['nama'])
    ? $data['nama']
    : 'Reva Pramnesti';

$email = !empty($data['email'])
    ? $data['email']
    : '-';

$telepon = !empty($data['telepon'])
    ? $data['telepon']
    : '-';

$alamat = !empty($data['alamat'])
    ? $data['alamat']
    : '-';

// Mengamankan output
$nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$telepon = htmlspecialchars($telepon, ENT_QUOTES, 'UTF-8');
$alamat = htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8');
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About | teknik imut</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS portofolio -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <nav class="navbar container" aria-label="Navigasi utama">
            <a class="logo" href="index.php">
                hi<span>hallooooo</span><b>.</b>
            </a>

            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="about.php">About</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li>
                    <a class="nav-cta" href="contact.php">
                        Contact <span>↗</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="container page-main">

        <!-- JUDUL HALAMAN -->
        <section class="page-hero">
            <p class="eyebrow">GET TO KNOW ME</p>
            <h1>A LITTLE <span class="pink-text">ABOUT ME.</span></h1>
            <p>Cute girl, curious mind.</p>
        </section>

        <!-- PROFIL -->
        <section class="about-layout">

            <div class="about-visual">
                <img
                    src="assets/foto%20ecev.jpeg"
                    alt="Ilustrasi avatar Reva dengan dekorasi hijau dan pink"
                    width="360"
                    height="420"
                >

                <span class="round-label">
                    안녕하세요!<br>
                    halooooo
                </span>
            </div>

            <div class="about-content">
                <p class="eyebrow">anyonggg haiseoooo</p>

                <h2>
                    I'm <?php echo $nama; ?> — mahasiswa teknik yang imut
                    <span class="green-text">cihuuuyyy</span>
                </h2>

                <p>
                    Saya Reva, mahasiswa Teknik Informatika yang masih penasaran sejauh
                    apa saya bisa berkembang.
                </p>

                <p>
                    Kadang sibuk ngulik website, kadang nyobain hal-hal baru, dan kadang
                    memilih keluar sebentar buat main skateboard. Masih banyak hal seru
                    yang pengen dicoba, one step at a time.
                </p>

                <div class="skill-tags">
                    <span>Skateboarding</span>
                    <span>Creative</span>
                    <span>Curious</span>
                    <span>Just Vibing</span>
                </div>
            </div>

        </section>

        <!-- INFORMASI PROFIL -->
        <section class="section about-details">

            <div class="section-heading">
                <div>
                    <p class="eyebrow">MY PROFILE</p>
                    <h2>Quick <span class="pink-text">facts.</span></h2>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Informasi</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($data)) { ?>

                            <tr>
                                <td>Nama</td>
                                <td><?php echo $nama; ?></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td><?php echo $email; ?></td>
                            </tr>

                            <tr>
                                <td>Telepon</td>
                                <td><?php echo $telepon; ?></td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td><?php echo $alamat; ?></td>
                            </tr>

                        <?php } else { ?>

                            <tr>
                                <td colspan="2">Data profil belum tersedia.</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- CATATAN -->
            <div class="learning-box">
                <div>
                    <p class="eyebrow">Coding when it works</p>
                    <h3>skating when it doesn't.</h3>
                </div>

                <ul>
                    <li>Every small step is still a step forward.</li>
                </ul>
            </div>

        </section>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="logo" href="index.php">
                my<span>space</span><b>.</b>
            </a>

            <p>Personal Portfolio <span>-</span> © 2026 Reva</p>

            <a href="contact.php">Say hello ↗</a>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
