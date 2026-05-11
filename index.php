<?php
/**
 * DASHBOARD KONFIGURASI UNDANGAN
 */

$nama_tamu = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan';

$pria   = "Marco S.Kom";
$wanita = "Silva S.M";
$tanggal_wedding = "2026-05-12";

// JAM ACARA
$jam_akad        = "09.45 - 11.00 WIB";
$jam_resepsi     = "11.00 - Selesai";

// JAM MULAI AKAD UNTUK COUNTDOWN
$akad_mulai = "09:45:00";

$nama_gedung      = "Gedung Serbaguna";
$alamat_lengkap   = "Jl. Sarijadi";
$google_maps_link = "https://maps.app.goo.gl/vTmFe14rHsLwu74z8"; 
$embed_url        = "https://maps.google.com/maps?q=gedung+serbaguna+sarijadi&t=&z=15&ie=UTF8&iwloc=&output=embed";

// --- KONFIGURASI MUSIK ---
$musik_url = "assets/akumemilihmu.mp3"; // Ganti dengan link file mp3 pilihan Anda

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
$cover_bg = "assets/prewed.jpg";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - <?= $pria ?> & <?= $wanita ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
    --primary: #7c5c52;
    --secondary: #f7f1eb;
    --accent: #d6a77a;
    --gold: #d4af37;
    --white: #ffffff;
    --text-dark: #2d2d2d;
    --text-light: #777;
    --shadow: 0 10px 30px rgba(0,0,0,0.08);
}

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html {
    scroll-behavior: smooth;
}


        /* --- ANIMASI & STYLE GALLERY --- */
        .gallery { 
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 15px; 
            margin: 60px 0; 
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            /* Animasi awal saat konten muncul */
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        /* Munculkan foto saat body mendapat class .opened */
        body.opened .gallery-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mengimpor font elegan dari Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,400;1,500&family=Montserrat:wght@300;600&display=swap');

.quotes-container {
    padding: 100px 20px; /* Ruang lega di atas dan bawah agar tidak sesak */
    text-align: center;
    max-width: 850px;
    margin: 0 auto;
    position: relative;
}

/* Gaya untuk Ayat Suci */
.holy-verse {
    font-family: 'Playfair Display', serif;
    font-style: italic; /* Memberikan kesan klasik dan puitis */
    font-size: clamp(1rem, 4vw, 1.2rem); /* Ukuran dinamis agar pas di HP maupun laptop */
    line-height: 2; /* Jarak antar baris yang lebar agar nyaman dibaca */
    color: #555;
    position: relative;
    padding: 0 30px;
}

/* Menambahkan tanda petik dekoratif di awal dan akhir */
.holy-verse::before, .holy-verse::after {
    content: '"';
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    color: #d4af37; /* Warna emas halus untuk kesan mewah */
    opacity: 0.3;
    position: absolute;
    line-height: 1;
}

.holy-verse::before { top: -20px; left: 0; }
.holy-verse::after { bottom: -50px; right: 0; }

/* Gaya untuk Referensi Ayat (QS. Ar-Rum) */
.verse-reference {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-style: normal;
    font-size: 0.85rem;
    color: #444;
    margin-top: 25px;
    letter-spacing: 3px; /* Jarak antar huruf lebar untuk kesan modern */
    text-transform: uppercase;
    opacity: 0.8;
}

/* Garis dekoratif bawah yang artistik */
.quotes-container::after {
    content: '';
    display: block;
    width: 50px;
    height: 2px;
    background: linear-gradient(to right, transparent, #d4af37, transparent); /* Gradasi emas */
    margin: 40px auto 0;
}

/* Penyesuaian khusus untuk tampilan HP */
@media screen and (max-width: 600px) {
    .quotes-container {
        padding: 60px 15px;
    }
    .holy-verse {
        font-size: 0.95rem;
        line-height: 1.8;
        padding: 0 15px;
    }
    .verse-reference {
        font-size: 0.75rem;
        letter-spacing: 2px;
    }
}

        

        /* Efek jeda (stagger) agar foto muncul bergantian */
        body.opened .gallery-item:nth-child(2) { transition-delay: 0.2s; }
        body.opened .gallery-item:nth-child(3) { transition-delay: 0.4s; }
        body.opened .gallery-item:nth-child(4) { transition-delay: 0.6s; }

        .gallery-img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    display: block;
    transition: all 0.5s ease;
    filter: brightness(0.95);
}

.gallery-item:hover .gallery-img {
    transform: scale(1.08);
    filter: brightness(1.05);
}
.gallery-item {
    position: relative;
}

.gallery-item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.2), transparent 40%);
    opacity: 0;
    transition: 0.4s;
}

.gallery-item:hover::after {
    opacity: 1;
}

        .stagger { margin-top: 30px; }

        body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background:
        radial-gradient(circle at top left, rgba(214,167,122,0.12), transparent 30%),
        radial-gradient(circle at bottom right, rgba(124,92,82,0.08), transparent 25%),
        #fcfaf8;
    color: var(--text-dark);
    overflow: hidden;
    transition: overflow
     0.5s ease;
}

.countdown-container {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 50px 0;
    flex-wrap: wrap;
}

.count-box {
    width: 90px;
    height: 90px;
    border-radius: 25px;
    background: white;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.count-box span {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary);
}

.count-box small {
    font-size: 11px;
    color: #888;
    letter-spacing: 1px;
}

.event-card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    padding: 55px 35px;
    border-radius: 35px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.06);
    border: 1px solid rgba(255,255,255,0.5);
    margin-top: 60px;
    position: relative;
    overflow: hidden;
}

.event-card::before {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background: rgba(214,167,122,0.08);
    border-radius: 50%;
    top: -70px;
    right: -70px;
}

        
        /* --- STYLE WEDDING GIFT --- */
        .gift-container {
            margin-top: 50px;
            padding: 30px;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.03);
            border: 1px solid #f0f0f0;
        }

        .gift-options {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 25px;
        }

        .btn-open {
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: white;
    padding: 16px 40px;
    border-radius: 50px;
    border: none;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.35s ease;
    box-shadow: 0 10px 25px rgba(124,92,82,0.35);
}

.btn-open:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 15px 30px rgba(124,92,82,0.4);
}

        .btn-option {
            padding: 10px 20px;
            border: 1px solid var(--primary);
            background: transparent;
            color: var(--primary);
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-option.active {
            background: var(--primary);
            color: white;
        }

        .gift-card {
            display: none; /* Sembunyikan secara default */
            background: #fdfcfb;
            padding: 25px;
            border-radius: 20px;
            border: 1px dashed #ddd;
            animation: fadeIn 0.5s ease;
        }

        .gift-card.active { display: block; }

        .bank-logo { height: 30px; margin-bottom: 15px; }

        .account-number {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            display: block;
            margin: 10px 0;
            color: var(--text-dark);
        }

        .copy-success {
            font-size: 11px;
            color: #27ae60;
            display: none;
            margin-top: 5px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .flower {
    position: fixed;
    z-index: 0;
    font-size: 28px;
    opacity: 0.15;
    animation: floating 6s ease-in-out infinite;
    pointer-events: none;
}

.flower1 {
    top: 15%;
    left: 5%;
}

.flower2 {
    top: 50%;
    right: 8%;
    animation-delay: 2s;
}

.flower3 {
    bottom: 10%;
    left: 12%;
    animation-delay: 4s;
}

@keyframes floating {
    0%,100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
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

        /* --- STYLE CERITA PENGANTIN (LOVE STORY) --- */
        .story-section {
            padding: 60px 20px;
            position: relative;
        }

        .timeline {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* Garis Tengah Vertikal */
        .timeline::after {
            content: '';
            position: absolute;
            width: 2px;
            background: var(--primary);
            top: 0; bottom: 0;
            left: 50%;
            margin-left: -1px;
            opacity: 0.3;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background: inherit;
            width: 50%;
            opacity: 0; /* Untuk animasi saat scroll */
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        body.opened .timeline-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mengatur posisi kiri dan kanan */
        .left { left: 0; text-align: right; }
        .right { left: 50%; text-align: left; }

        /* Titik Lingkaran di Garis */
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            right: -8px;
            background-color: var(--white);
            border: 3px solid var(--primary);
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .right::after { left: -8px; }

        .story-content {
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            border: 1px solid #f0f0f0;
        }

        .story-date {
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        .story-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .story-text {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Responsive Mobile */
        @media screen and (max-width: 600px) {
            .timeline::after { left: 31px; }
            .timeline-item { width: 100%; padding-left: 70px; padding-right: 25px; text-align: left; }
            .timeline-item::after { left: 23px; }
            .right { left: 0%; }
        }

        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .section-title {
    font-family: 'Great Vibes', cursive;
    font-size: 4rem;
    color: var(--primary);
    margin-bottom: 10px;
}

.section-subtitle {
    letter-spacing: 4px;
    text-transform: uppercase;
    font-size: 11px;
    color: #999;
}

        /* --- COVER SECTION --- */
        .cover {
            height: 100vh; width: 100%; position: fixed;
            top: 0; left: 0; display: flex; align-items: center;
            justify-content: center; z-index: 1000;
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1);
            color: var(--white); text-align: center;
        }

        .cover::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.5));
    z-index: -1;
}

.cover-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    filter: brightness(0.6);
    z-index: -1;
    transform: scale(1.05);
}

        .cover-content {
    padding: 50px 40px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(18px);
    border-radius: 35px;
    border: 1px solid rgba(255,255,255,0.2);
    width: 90%;
    max-width: 500px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

.cover-title {
    font-family: 'Great Vibes', cursive;
    font-size: 4.5rem;
    line-height: 1.1;
    margin-bottom: 15px;
}

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
    margin-top: 60px;
    text-align: left;
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    padding: 35px;
    border-radius: 30px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
    border: 1px solid rgba(255,255,255,0.5);
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
    <div class="cover-bg" style="background-image: url('<?= $cover_bg ?>');"></div>
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

            <div class="quotes-container">
    <div class="holy-verse">
        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir."
        <br><span class="verse-reference">~ QS. Ar-Rum : 21 ~</span>
    </div>
</div>

<div class="countdown-container">
    <div class="count-box">
        <span id="days">00</span>
        <small>Hari</small>
    </div>
    <div class="count-box">
        <span id="hours">00</span>
        <small>Jam</small>
    </div>
    <div class="count-box">
        <span id="minutes">00</span>
        <small>Menit</small>
    </div>
    <div class="count-box">
        <span id="seconds">00</span>
        <small>Detik</small>
    </div>
</div>

            <div style="margin: 80px 0 40px; text-align: center;">
            <h2 class="section-title">Our Gallery</h2>
<p class="section-subtitle">A glimpse of our happiness</p>
</div>
            <div class="gallery">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Prewed 1">
                </div>
                <div class="gallery-item stagger">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Prewed 2">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Prewed 3">
                </div>
                <div class="gallery-item stagger">
                    <img src="https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&w=800&q=80" class="gallery-img" alt="Prewed 4">
                </div>
            </div>

            <div class="container story-section">
            <h3 class="salam-h3" style="font-style: normal; margin-bottom: 10px;">Our Love Story</h3>
            <p style="font-size: 13px; color: var(--text-light); margin-bottom: 40px;">"Sebab rindu telah menemukan rumahnya, dan perjalanan panjang ini akhirnya berujung pada pelukanmu. Cinta bukan tentang siapa yang tercepat menemukan, tapi tentang siapa yang paling yakin untuk tetap tinggal."</p>

            <div class="timeline">
                <div class="timeline-item left">
                    <div class="story-content">
                        <span class="story-date">Januari 2024</span>
                        <h4 class="story-title">Pertama Bertemu</h4>
                        <p class="story-text">Berawal dari pertemuan singkat di sebuah perpustakaan kota, tak disangka obrolan kecil membawa kami pada perasaan yang besar.</p>
                    </div>
                </div>

                <div class="timeline-item right" style="transition-delay: 0.3s;">
                    <div class="story-content">
                        <span class="story-date">Mei 2025</span>
                        <h4 class="story-title">Menjalin Kasih</h4>
                        <p class="story-text">Setelah setahun saling mengenal, kami memutuskan untuk berkomitmen melangkah bersama dalam suka maupun duka.</p>
                    </div>
                </div>

                <div class="timeline-item left" style="transition-delay: 0.6s;">
                    <div class="story-content">
                        <span class="story-date">Juli 2027</span>
                        <h4 class="story-title">Lamaran</h4>
                        <p class="story-text">Di depan kedua keluarga besar, kami mengikrarkan janji untuk membawa hubungan ini ke jenjang yang lebih suci.</p>
                    </div>
                </div>
            </div>
        </div>

            <div class="event-card">
            <div class="event-item">
    <p style="text-transform: uppercase; letter-spacing: 3px; font-size: 11px; color: var(--primary); margin-bottom: 10px;">
        Akad Nikah
    </p>

    <p style="font-size: 1.2rem; font-weight: 600;">
        <?= $jam_akad ?>
    </p>
</div>

<div class="event-item">
    <p style="text-transform: uppercase; letter-spacing: 3px; font-size: 11px; color: var(--primary); margin-bottom: 10px;">
        Resepsi
    </p>

    <p style="font-size: 1.2rem; font-weight: 600;">
        <?= $jam_resepsi ?>
    </p>
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

    <div class="container" style="padding-top: 0;">
            <div class="gift-container">
                <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 15px;">Wedding Gift</h3>
                <p style="font-size: 13px; color: var(--text-light); margin-bottom: 25px;">
                    Doa restu Anda merupakan karunia terindah bagi kami. Namun jika ingin memberikan tanda kasih, silakan melalui kanal di bawah ini:
                </p>

                <div class="gift-options">
                    <button class="btn-option active" onclick="showGift('bank', this)">Transfer Bank</button>
                    <button class="btn-option" onclick="showGift('ewallet', this)">E-Wallet</button>
                </div>

                <div id="gift-bank" class="gift-card active">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="bank-logo" alt="BCA">
                    <p style="font-size: 12px; color: #999;">Nomor Rekening:</p>
                    <span class="account-number" id="rek-bca">1234 5678 90</span>
                    <p style="font-size: 14px; font-weight: 600;">a.n <?= $pria ?></p>
                    <button class="btn-maps" style="margin-top: 15px; padding: 8px 20px; font-size: 11px;" onclick="copyNumber('rek-bca', this)">SALIN NO. REKENING</button>
                </div>

                <div id="gift-ewallet" class="gift-card">
    <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="bank-logo" alt="GOPAY">
    <p style="font-size: 12px; color: #999;">Nomor GoPay:</p>
    <span class="account-number" id="no-gopay">0812 3456 7890</span>
    <p style="font-size: 14px; font-weight: 600;">a.n <?= $wanita ?></p>
    <button class="btn-maps" style="margin-top: 15px; padding: 8px 20px; font-size: 11px;" onclick="copyNumber('no-gopay', this)">SALIN NOMOR GOPAY</button>
</div>
            </div>
        </div>

</div>

            <p style="margin-top: 80px; font-style: italic; color: var(--text-light); line-height: 1.8;">
                "Merupakan suatu kehormatan dan kebahagiaan bagi kami <br> apabila Bapak/Ibu/Saudara/i berkenan hadir."
            </p>
            <h4 style="margin-top: 25px; font-family: 'Playfair Display', serif;">Wassalamu’alaikum Wr. Wb.</h4>
        </div>

        <footer>
        <p style="font-size: 13px; color: #bbb;">© 2026 <?= explode(' ', $pria)[0] ?> & <?= explode(' ', $wanita)[0] ?>. All rights reserved.</p>
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

        function showGift(type, btn) {
            // Hapus class active dari semua tombol dan card
            document.querySelectorAll('.btn-option').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.gift-card').forEach(c => c.classList.remove('active'));

            // Tambahkan ke yang diklik
            btn.classList.add('active');
            document.getElementById('gift-' + type).classList.add('active');
        }

        function copyNumber(elementId, btn) {
            const text = document.getElementById(elementId).innerText.replace(/\s/g, ''); // Hapus spasi saat salin
            navigator.clipboard.writeText(text).then(() => {
                const originalText = btn.innerText;
                btn.innerText = "BERHASIL DISALIN!";
                btn.style.background = "#27ae60";
                btn.style.color = "white";
                btn.style.borderColor = "#27ae60";

                setTimeout(() => {
                    btn.innerText = originalText;
                    btn.style.background = "transparent";
                    btn.style.color = "var(--primary)";
                    btn.style.borderColor = "var(--primary)";
                }, 2000);
            });
        }

// Gabungkan tanggal wedding + jam akad
const targetDate = new Date("<?= $tanggal_wedding . ' ' . $akad_mulai ?>").getTime();

setInterval(() => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    // Hitungan waktu
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Tampilkan ke HTML
    document.getElementById("days").innerHTML = String(days).padStart(2, '0');
    document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
    document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
    document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

    // Jika waktu habis
    if (distance < 0) {
        document.getElementById("days").innerHTML = "00";
        document.getElementById("hours").innerHTML = "00";
        document.getElementById("minutes").innerHTML = "00";
        document.getElementById("seconds").innerHTML = "00";
    }

}, 1000);
    </script>
    <div class="flower flower1">🌸</div>
<div class="flower flower2">✨</div>
<div class="flower flower3">🌿</div>
</body>
</html>
