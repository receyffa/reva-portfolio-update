
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "koneksi.php";

// Mengambil informasi kontak dari database
$query_kontak = mysqli_query($koneksi, "SELECT * FROM tbl_kontak LIMIT 1");
$kontak = $query_kontak ? mysqli_fetch_assoc($query_kontak) : null;

// Variabel notifikasi
$statusPesan = "";

// Proses mengirim pesan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $topik = trim($_POST["topik"] ?? "");
    $pesan = trim($_POST["pesan"] ?? "");

    if ($nama === "" || $email === "" || $topik === "" || $pesan === "") {
        $statusPesan = "Semua kolom wajib diisi ya.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $statusPesan = "Format email tidak valid.";
    } else {
        $stmt = mysqli_prepare(
            $koneksi,
            "INSERT INTO tbl_pesan (nama, email, topik, pesan) VALUES (?, ?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $topik, $pesan);

            if (mysqli_stmt_execute($stmt)) {
                $statusPesan = "Pesan berhasil dikirim! Makasih sudah menyapa ♡";
            } else {
                $statusPesan = "Pesan belum berhasil dikirim. Coba lagi ya.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $statusPesan = "Terjadi kesalahan pada database.";
        }
    }
}

// Mengamankan teks dari database
function aman($nilai) {
    return htmlspecialchars($nilai ?? "", ENT_QUOTES, "UTF-8");
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Contact | teknik imut</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <!-- CSS portofolio -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <nav class="navbar container" aria-label="Navigasi utama">
            <a class="logo" href="index.php">
                hii<span>hallo</span><b>.</b>
            </a>

            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li>
                    <a class="nav-cta active-cta" href="contact.php">
                        Contact <span>↗</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="container page-main">

        <section class="page-hero">
            <p class="eyebrow">YOUR TURN TO SAY HI</p>

            <h1>Let's make something <span class="pink-text">good.</span></h1>

            <p>
                Punya pertanyaan, ide, atau mau ngobrol soal project? Kirim pesan
                lewat form ini.
            </p>
        </section>

        <!-- KONTAK -->
        <section class="contact-layout">

            <aside class="contact-aside">
                <div class="contact-bubble">hii</div>

                <p class="eyebrow">Have a little idea?</p>

                <h2>
                    Let's make it happen!<br />
                    <span class="green-text">Let's talk!</span>
                </h2>

                <p>
                    Punya ide menarik, mau ngobrol, atau sekadar mampir? Feel free to
                    say hi. Siapa tahu obrolan kecil bisa jadi sesuatu yang seru.
                </p>

                <div class="contact-detail">
                    <span>✿</span>
                    <div>
                        <strong>Based on curiosity</strong>
                        <small>Always learning, always growing.</small>
                    </div>
                </div>

                <?php if ($kontak) { ?>

                    <?php if (!empty($kontak["email"])) { ?>
                        <div class="contact-detail">
                            <span>✉</span>
                            <div>
                                <strong>Email</strong>
                                <small><?php echo aman($kontak["email"]); ?></small>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($kontak["instagram"])) { ?>
                        <div class="contact-detail">
                            <span>♡</span>
                            <div>
                                <strong>Instagram</strong>
                                <small><?php echo aman($kontak["instagram"]); ?></small>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($kontak["github"])) { ?>
                        <div class="contact-detail">
                            <span>⌘</span>
                            <div>
                                <strong>GitHub</strong>
                                <small><?php echo aman($kontak["github"]); ?></small>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($kontak["lokasi"])) { ?>
                        <div class="contact-detail">
                            <span>⌖</span>
                            <div>
                                <strong>Location</strong>
                                <small><?php echo aman($kontak["lokasi"]); ?></small>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>

                <a class="text-link" href="projects.php">
                    Explore my projects <span>→</span>
                </a>
            </aside>

            <!-- FORM KONTAK -->
            <form class="contact-form" id="contactForm" action="contact.php" method="POST">

                <h2>Send a message <span>♡</span></h2>

                <p class="form-subtitle">Semua kolom bertanda * wajib diisi.</p>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama *</label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            placeholder="Nama kamu"
                            autocomplete="name"
                            value="<?php echo aman($_POST['nama'] ?? ''); ?>"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            value="<?php echo aman($_POST['email'] ?? ''); ?>"
                            required
                        />
                    </div>
                </div>

                <div class="form-group">
                    <label for="topik">Mau ngobrol tentang?</label>
                    <select id="topik" name="topik">
                        <option value="kolaborasi">Ide kolaborasi</option>
                        <option value="project">Project website</option>
                        <option value="lainnya">Hal lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan *</label>
                    <textarea
                        id="pesan"
                        name="pesan"
                        rows="5"
                        placeholder="Tulis pesan kamu di sini..."
                        required
                    ><?php echo aman($_POST['pesan'] ?? ''); ?></textarea>
                </div>

                <button class="button button-primary submit-button" type="submit">
                    Kirim pesan <span>↗</span>
                </button>

                <p class="form-note" id="formStatus" role="status" aria-live="polite">
                    <?php echo aman($statusPesan); ?>
                </p>

            <p>Personal Portfolio <span>-</span> © 2026 Reva</p>

            <a href="index.php">Back to home ↑</a>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
