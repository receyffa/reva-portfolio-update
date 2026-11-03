
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "koneksi.php";

// Mengambil data proyek dari database
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_portofolio
     ORDER BY CASE
        WHEN nama_proyek = 'Ctrl Snap Photobooth' THEN 1
        WHEN nama_proyek = 'Badminton Tournament' THEN 2
        WHEN nama_proyek = 'My Digital Space' THEN 3
        ELSE 4
     END, id ASC"
);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Menyimpan data proyek
$projects = [];

while ($row = mysqli_fetch_assoc($query)) {
    $projects[] = $row;
}

// Kategori dan gambar cadangan
$kategori = [
    'Ctrl Snap Photobooth' => 'CREATIVE WEBSITE',
    'Badminton Tournament' => 'SPORTS INFORMATION',
    'My Digital Space' => 'PERSONAL WEBSITE'
];

$gambar_cadangan = [
    'Ctrl Snap Photobooth' => 'assets/ctrl snap.jpeg',
    'Badminton Tournament' => 'assets/badminton.jpeg',
    'My Digital Space' => 'assets/my porto.jpeg'
];

$warna_kartu = [
    'cover-pink',
    'cover-green',
    'cover-lilac'
];
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Projects | teknik imut</title>

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
                hiii<span>haloo</span><b>.</b>
            </a>

            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a class="active" href="projects.php">Projects</a></li>
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

        <!-- JUDUL -->
        <section class="page-hero">
            <p class="eyebrow">SELECTED WORKS</p>
            <h1>My Projects <span class="pink-text">.</span></h1>
            <p>
                Beberapa project yang saya kerjakan selama proses belajar dan
                eksplorasi.
            </p>
        </section>

        <!-- DAFTAR PROYEK -->
        <section class="project-grid" aria-label="Daftar proyek">

            <?php if (!empty($projects)) { ?>

                <?php foreach ($projects as $index => $project) { ?>

                    <?php
                    $nama_proyek = $project['nama_proyek'] ?? '';
                    $deskripsi = $project['deskripsi'] ?? '';

                    // Menggunakan gambar cadangan jika database NULL
                    $gambar = !empty($project['gambar'])
                        ? $project['gambar']
                        : ($gambar_cadangan[$nama_proyek] ?? 'assets/my porto.jpeg');

                    // Menggunakan link cadangan jika database NULL
                    $link = !empty($project['link_proyek'])
                        ? $project['link_proyek']
                        : 'contact.php';

                    // Menentukan kategori proyek
                    $label = $kategori[$nama_proyek] ?? 'MY PROJECT';

                    // Menentukan warna kartu
                    $warna = $warna_kartu[$index % count($warna_kartu)];

                    // Mengamankan output
                    $nama_proyek = htmlspecialchars($nama_proyek, ENT_QUOTES, 'UTF-8');
                    $deskripsi = htmlspecialchars($deskripsi, ENT_QUOTES, 'UTF-8');
                    $gambar = htmlspecialchars($gambar, ENT_QUOTES, 'UTF-8');
                    $link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
                    ?>

                    <article class="project-card">

                        <div class="project-cover <?php echo $warna; ?>">

                            <span class="cover-number">
                                <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                            </span>

                            <img
                                src="<?php echo $gambar; ?>"
                                alt="<?php echo $nama_proyek; ?>"
                                class="project-image"
                            >

                        </div>

                        <div class="project-info">

                            <p class="card-label">
                                <?php echo $label; ?>
                            </p>

                            <h2>
                                <?php echo $nama_proyek; ?>
                            </h2>

                            <p>
                                <?php echo $deskripsi; ?>
                            </p>

                            <div class="project-meta">
                                <span>HTML</span>
                                <span>CSS</span>

                                <a href="<?php echo $link; ?>">
                                    <?php
                                    echo ($nama_proyek === 'My Digital Space')
                                        ? 'View website ↗'
                                        : 'Ask about it ↗';
                                    ?>
                                </a>
                            </div>

                        </div>

                    </article>

                <?php } ?>

            <?php } else { ?>

                <p>Belum ada proyek yang tersedia.</p>

            <?php } ?>

        </section>

        <!-- CATATAN PROYEK -->
        <section class="project-note">

            <span class="note-icon"></span>

            <div>
                <h2>
                    Little things
                    <span class="pink-text">I've created.</span>
                </h2>

                <p>
                    Setiap project punya cerita dan proses belajarnya sendiri.
                    Di sini aku berbagi hasil eksplorasi, ide kreatif, dan
                    hal-hal baru yang aku pelajari selama ngoding.
                </p>
            </div>

            <a class="button button-primary" href="contact.php">
                Let's connect ↗
            </a>

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

