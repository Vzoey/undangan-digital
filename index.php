<?php
/**
 * DASHBOARD KONFIGURASI UNDANGAN
 */

$nama_tamu = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan';

$pria   = "Imam Syahputra, S.Kom";
$wanita = "Silvia Anggraini, S.Ds";
$tanggal_wedding = "12 . 12 . 2027";

$nama_gedung      = "Gedung Serbaguna";
$alamat_lengkap   = "Jl. Sarijadi";
$google_maps_link = "https://maps.app.goo.gl/vTmFe14rHsLwu74z8"; 
$embed_url        = "https://maps.google.com/maps?q=gedung+serbaguna+sarijadi&t=&z=15&ie=UTF8&iwloc=&output=embed";

// --- KONFIGURASI MUSIK ---
$musik_url = "assets/tersimpan.mp3"; // Ganti dengan link file mp3 pilihan Anda

// Nama file notepad untuk menyimpan ucapan
$file_penyimpanan = "assets/ucapan.txt";

// Logika menyimpan ucapan saat form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kirim_ucapan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $ucapan = htmlspecialchars($_POST['ucapan']);
    $waktu = date("d-m-Y H:i");

    if (!empty($nama) && !empty($ucapan)) {
        // Format teks yang akan disimpan di notepad
        $data_baru = "<strong>" . $nama . "</strong>|" . $ucapan . "|" . $waktu . "\n";
        
        // Simpan ke file (FILE_APPEND agar tidak menimpa data lama)
        file_put_contents($file_penyimpanan, $data_baru, FILE_APPEND);
        
        // Refresh halaman agar input tidak terkirim dua kali
        header("Location: " . $_SERVER['PHP_SELF'] . "?to=" . urlencode($nama_tamu) . "#ucapan-section");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - <?= $pria ?> & <?= $wanita ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #748da6;
            --accent: #d4a373;
            --white: #ffffff;
            --text-dark: #2d3436;
            --text-light: #636e72;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fdfcfb;
            color: var(--text-dark);
            overflow: hidden; 
            transition: overflow 0.5s ease;
        }

        /* --- STYLE BARU: TOMBOL MUSIK --- */
        #music-control {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 50%;
            display: none; /* Muncul hanya setelah undangan dibuka */
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            font-size: 20px;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* --- COVER SECTION --- */
        .cover {
            height: 100vh; width: 100%; position: fixed;
            top: 0; left: 0; display: flex; align-items: center;
            justify-content: center; z-index: 1000;
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1);
            color: var(--white); text-align: center;
        }

        .cover-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80') no-repeat center center;
            background-size: cover; filter: brightness(0.6); z-index: -1;
        }

        .cover-content {
            padding: 40px; background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px); border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 90%; max-width: 450px;
        }

        .cover-title { font-family: 'Playfair Display', serif; font-size: 3rem; margin-bottom: 20px; }

        .recipient-box {
            background: var(--white); color: var(--text-dark);
            padding: 20px; border-radius: 20px; margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .btn-open {
            background: var(--primary); color: white; padding: 16px 40px;
            border-radius: 50px; border: none; font-weight: 600;
            letter-spacing: 1px; cursor: pointer; transition: 0.3s;
            box-shadow: 0 5px 15px rgba(116, 141, 166, 0.4);
        }

        .comment-section {
    margin-top: 50px;
    text-align: left;
    background: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}
.form-group { margin-bottom: 15px; }
.form-input {
    width: 100%; padding: 12px; border: 1px solid #eee;
    border-radius: 10px; outline: none; font-family: inherit;
}
.btn-send {
    width: 100%; background: var(--primary); color: white;
    border: none; padding: 12px; border-radius: 10px;
    font-weight: 600; cursor: pointer;
}
.comments-list {
    margin-top: 30px; max-height: 400px; overflow-y: auto;
}
.comment-item {
    background: #fdfcfb; padding: 15px; border-radius: 15px;
    margin-bottom: 10px; border-left: 4px solid var(--primary);
}

        .comment-item strong { display: block; font-size: 14px; color: var(--text-dark); }
        .comment-item p { font-size: 13px; color: var(--text-light); margin-top: 5px; line-height: 1.5; }

        /* --- MAIN CONTENT --- */
        .main-content { opacity: 0; transition: opacity 1s ease 0.5s; padding-bottom: 100px; }
        body.opened { overflow-y: auto; }
        body.opened .cover { transform: translateY(-100%); }
        body.opened .main-content { opacity: 1; }
        body.opened #music-control { display: flex; }

        .container { max-width: 800px; margin: 0 auto; padding: 80px 20px; text-align: center; }
        .salam-h3 { font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.8rem; color: var(--primary); margin-bottom: 25px; }
        .couple-name { font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 5px; }
        .parents-text { font-size: 0.9rem; color: #999; margin-bottom: 30px; }

        .gallery { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 60px 0; }
        .gallery-img { width: 100%; height: 350px; object-fit: cover; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .stagger { margin-top: 50px; }

        .event-card { background: var(--white); padding: 50px 30px; border-radius: 30px; box-shadow: 0 20px 50px rgba(0,0,0,0.02); border: 1px solid #f0f0f0; margin-top: 50px; }
        .event-item { margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #eee; }
        .maps-container { width: 100%; border-radius: 20px; overflow: hidden; height: 250px; margin: 20px 0; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .btn-maps { display: inline-block; padding: 12px 25px; border: 1.5px solid var(--primary); color: var(--primary); text-decoration: none; border-radius: 50px; font-size: 13px; font-weight: 600; transition: 0.3s; }

        footer { padding: 60px; text-align: center; background: #fff; border-top: 1px solid #f5f5f5; }
    </style>
</head>
<body id="body">

    <audio id="weddingMusic" loop>
        <source src="<?= $musik_url ?>" type="audio/mpeg">
    </audio>

    <div id="music-control" onclick="toggleMusic()">🎵</div>

    <section class="cover" id="cover">
        <div class="cover-bg"></div>
        <div class="cover-content">
            <p style="letter-spacing: 4px; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">The Wedding of</p>
            <h1 class="cover-title"><?= explode(' ', $pria)[0] ?> & <?= explode(' ', $wanita)[0] ?></h1>
            <p style="letter-spacing: 2px; margin-bottom: 30px; font-weight: 300;"><?= $tanggal_wedding ?></p>

            <div class="recipient-box">
                <p style="font-size: 11px; color: #aaa; margin-bottom: 8px;">Kpd Bapak/Ibu/Saudara/i:</p>
                <h3 style="font-size: 1.5rem; font-family: 'Playfair Display', serif;"><?= $nama_tamu ?></h3>
            </div>

            <button class="btn-open" onclick="startInvitation()">BUKA UNDANGAN</button>
        </div>
    </section>

    <div class="main-content">
        <div class="container">
            <h3 class="salam-h3">Assalamu’alaikum Wr. Wb.</h3>
            <p style="color: var(--text-light); line-height: 1.8; margin-bottom: 40px;">
                Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada hari bahagia pernikahan kami:
            </p>

            <div style="margin: 60px 0;">
                <h2 class="couple-name"><?= $pria ?></h2>
                <p class="parents-text">Putra dari Bapak Fulan & Ibu Fulanah</p>
                <h2 style="font-family: 'Playfair Display', serif; color: var(--primary); margin: 15px 0;">&</h2>
                <h2 class="couple-name"><?= $wanita ?></h2>
                <p class="parents-text">Putri dari Bapak Fulan & Ibu Fulanah</p>
            </div>

            
            <div class="gallery">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Prewed 1">
                <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=800&q=80" class="gallery-img stagger" alt="Prewed 2">
            </div>

            <div class="event-card">
                <div class="event-item">
                    <p style="text-transform: uppercase; letter-spacing: 3px; font-size: 11px; color: var(--primary); margin-bottom: 10px;">Akad Nikah</p>
                    <p style="font-size: 1.2rem; font-weight: 600;">08.00 - 10.00 WIB</p>
                </div>
                <div class="event-item">
                    <p style="text-transform: uppercase; letter-spacing: 3px; font-size: 11px; color: var(--primary); margin-bottom: 10px;">Resepsi</p>
                    <p style="font-size: 1.2rem; font-weight: 600;">11.00 - Selesai</p>
                </div>
                
                <div style="margin: 30px 0;">
                    <p style="font-weight: 600; font-size: 1.1rem;"><?= $nama_gedung ?></p>
                    <p style="color: #888; font-size: 0.95rem; margin-top: 5px;"><?= $alamat_lengkap ?></p>
                </div>

                <div class="maps-container">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" src="<?= $embed_url ?>"></iframe>
                </div>

                <a href="<?= $google_maps_link ?>" target="_blank" class="btn-maps">PETUNJUK LOKASI (GOOGLE MAPS)</a>
            </div>
            
            <div class="comment-section" id="ucapan-section">
    <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px; text-align: center;">Berikan Ucapan & Doa Restu</h3>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Anda</label>
            <input type="text" name="nama" class="form-input" placeholder="Masukkan nama Anda" required>
        </div>
        <div class="form-group">
            <label>Ucapan / Doa</label>
            <textarea name="ucapan" class="form-input" rows="4" placeholder="Tulis ucapan selamat dan doa..." required></textarea>
        </div>
        <button type="submit" name="kirim_ucapan" class="btn-send">Kirim Ucapan</button>
    </form>

    <div class="comments-list">
        <?php
        if (file_exists($file_penyimpanan)) {
            $semua_ucapan = file($file_penyimpanan);
            // Balik urutan agar ucapan terbaru ada di atas
            $semua_ucapan = array_reverse($semua_ucapan);

            foreach ($semua_ucapan as $baris) {
                $data = explode("|", $baris);
                if (count($data) >= 2) {
                    echo '<div class="comment-item">';
                    echo '<strong>' . $data[0] . '</strong>';
                    echo '<p>' . $data[1] . '</p>';
                    echo '<small style="font-size:10px; color:#ccc;">' . ($data[2] ?? '') . '</small>';
                    echo '</div>';
                }
            }
        } else {
            echo '<p style="font-size:13px; color:#aaa; text-align:center;">Belum ada ucapan.</p>';
        }
        ?>
    </div>
</div>

            <p style="margin-top: 80px; font-style: italic; color: var(--text-light); line-height: 1.8;">
                "Merupakan suatu kehormatan dan kebahagiaan bagi kami <br> apabila Bapak/Ibu/Saudara/i berkenan hadir."
            </p>
            <h4 style="margin-top: 25px; font-family: 'Playfair Display', serif;">Wassalamu’alaikum Wr. Wb.</h4>
        </div>

        <footer>
            <p style="font-size: 13px; color: #bbb;">© 2026 . V Tech.</p>
        </footer>
    </div>

    <script>
        const audio = document.getElementById("weddingMusic");
        const musicControl = document.getElementById("music-control");

        function startInvitation() {
            // 1. Tambahkan class opened untuk transisi cover
            document.body.classList.add('opened');
            
            // 2. Mainkan musik
            audio.play().catch(error => {
                console.log("Browser memblokir autoplay: ", error);
            });

            // 3. Scroll halus ke atas (main content)
            setTimeout(() => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 1100);
        }

        function toggleMusic() {
            if (audio.paused) {
                audio.play();
                musicControl.innerHTML = "🎵";
                musicControl.style.animationPlayState = "running";
            } else {
                audio.pause();
                musicControl.innerHTML = "🔇";
                musicControl.style.animationPlayState = "paused";
            }
        }
    </script>
</body>
</html>