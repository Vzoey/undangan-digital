<?php
/**
 * DASHBOARD KONFIGURASI UNDANGAN
 */

$nama_tamu = isset($_GET['to']) ? htmlspecialchars($_GET['to']) : 'Tamu Undangan';

$pria = "Nandira Rizki";
$wanita = "Astri Astuti";

// ... variabel yang sudah ada ...
$pria = "Nandira Rizki";
$wanita = "Astri astuti";

// Tambahkan variabel baru di sini
$ig_pria = "nandirzki_";
$ig_wanita = "astri.a__";

$tanggal_wedding = "2026-06-06";

// JAM ACARA
$jam_akad = "09.45 - 11.00 WIB";
$jam_resepsi = "11.00 - Selesai";

// JAM MULAI AKAD UNTUK COUNTDOWN
$akad_mulai = "18:00:00";

$nama_gedung = "Kediaman Mempelai Pria";
$alamat_lengkap = "Dusun Cibiru RT 04 RW 10 Desa Cipacing Kec. Jatinangor Kab. Sumedang";
$google_maps_link = "https://maps.app.goo.gl/qkFMt1dGGC6fFosN6";
$embed_url = "https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d375.43901740796554!2d107.76528670784023!3d-6.9474443450063905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwNTYnNTEuMCJTIDEwN8KwNDUnNTUuNCJF!5e0!3m2!1sid!2sid!4v1779023021330!5m2!1sid!2sid";

// --- KONFIGURASI MUSIK ---
$musik_url = "assets/beauti.mp3"; // Ganti dengan link file mp3 pilihan Anda

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
// ===== KONFIGURASI COVER BACKGROUND =====
$cover_type = "video"; // 'foto' atau 'video'

// Jika pakai FOTO
$cover_bg = "assets/prewed.jpeg";

// Jika pakai VIDEO (untuk preview sebelum undangan dibuka)
$cover_video = "assets/vid.mp4"; // Ganti dengan path video Anda
$cover_video_poster = "assets/prewed.jpeg";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - <?= $pria ?> & <?= $wanita ?></title>

    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #7c5c52;
            --secondary: #f7f1eb;
            --accent: #d6a77a;
            --gold: #d4af37;
            --white: #ffffff;
            --text-dark: #2d2d2d;
            --text-light: #777;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
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
            padding: 100px 20px;
            /* Ruang lega di atas dan bawah agar tidak sesak */
            text-align: center;
            max-width: 850px;
            margin: 0 auto;
            position: relative;
        }

        /* Gaya untuk Ayat Suci */
        .holy-verse {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            /* Memberikan kesan klasik dan puitis */
            font-size: clamp(1rem, 4vw, 1.2rem);
            /* Ukuran dinamis agar pas di HP maupun laptop */
            line-height: 2;
            /* Jarak antar baris yang lebar agar nyaman dibaca */
            color: #555;
            position: relative;
            padding: 0 30px;
        }

        /* Menambahkan tanda petik dekoratif di awal dan akhir */
        .holy-verse::before,
        .holy-verse::after {
            content: '"';
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: #d4af37;
            /* Warna emas halus untuk kesan mewah */
            opacity: 0.3;
            position: absolute;
            line-height: 1;
        }

        .holy-verse::before {
            top: -20px;
            left: 0;
        }

        .holy-verse::after {
            bottom: -50px;
            right: 0;
        }

        /* Gaya untuk Referensi Ayat (QS. Ar-Rum) */
        .verse-reference {
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-style: normal;
            font-size: 0.85rem;
            color: #444;
            margin-top: 25px;
            letter-spacing: 3px;
            /* Jarak antar huruf lebar untuk kesan modern */
            text-transform: uppercase;
            opacity: 0.8;
        }

        /* Garis dekoratif bawah yang artistik */
        .quotes-container::after {
            content: '';
            display: block;
            width: 50px;
            height: 2px;
            background: linear-gradient(to right, transparent, #d4af37, transparent);
            /* Gradasi emas */
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
        body.opened .gallery-item:nth-child(2) {
            transition-delay: 0.2s;
        }

        body.opened .gallery-item:nth-child(3) {
            transition-delay: 0.4s;
        }

        body.opened .gallery-item:nth-child(4) {
            transition-delay: 0.6s;
        }

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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.2), transparent 40%);
            opacity: 0;
            transition: 0.4s;
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        .stagger {
            margin-top: 30px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(214, 167, 122, 0.12), transparent 30%),
                radial-gradient(circle at bottom right, rgba(124, 92, 82, 0.08), transparent 25%),
                #fcfaf8;
            color: var(--text-dark);
            overflow: hidden;
            transition: overflow 0.5s ease;
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
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 55px 35px;
            border-radius: 35px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.5);
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(214, 167, 122, 0.08);
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
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.03);
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
            box-shadow: 0 10px 25px rgba(124, 92, 82, 0.35);
        }

        .btn-open:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 15px 30px rgba(124, 92, 82, 0.4);
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
            display: none;
            /* Sembunyikan secara default */
            background: #fdfcfb;
            padding: 25px;
            border-radius: 20px;
            border: 1px dashed #ddd;
            animation: fadeIn 0.5s ease;
        }

        .gift-card.active {
            display: block;
        }

        .bank-logo {
            height: 30px;
            margin-bottom: 15px;
        }

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
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            0%,
            100% {
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
            display: none;
            /* Muncul hanya setelah undangan dibuka */
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
            opacity: 0.3;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background: inherit;
            width: 50%;
            opacity: 0;
            /* Untuk animasi saat scroll */
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        body.opened .timeline-item {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mengatur posisi kiri dan kanan */
        .left {
            left: 0;
            text-align: right;
        }

        .right {
            left: 50%;
            text-align: left;
        }

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

        .right::after {
            left: -8px;
        }

        .story-content {
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
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
            .timeline::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
                text-align: left;
            }

            .timeline-item::after {
                left: 23px;
            }

            .right {
                left: 0%;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

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
        /* Cari bagian .cover Anda dan ubah/tambah menjadi seperti ini */
        .cover {
            height: 100vh;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            /* Tambahkan visibility di sini */
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1), visibility 1.2s;
            color: var(--white);
            text-align: center;
        }

        /* Tambahkan visibility: hidden agar elemen benar-benar hilang setelah transisi selesai */
        body.opened .cover {
            transform: translateY(-100%);
            visibility: hidden;
        }

        /* Pastikan .main-content memiliki background solid (tidak transparan) */
        .main-content {
            opacity: 0;
            transition: opacity 1s ease 0.5s;
            position: relative;
            z-index: 1;
            background-color: #fdfaf5;
            /* Ganti dengan warna tema Anda */
            min-height: 100vh;
        }

        .cover::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.5));
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
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(18px);
            border-radius: 35px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .cover-title {
            font-family: 'Great Vibes', cursive;
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 15px;
        }

        .recipient-box {
            background: var(--white);
            color: var(--text-dark);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-open {
            background: var(--primary);
            color: white;
            padding: 16px 40px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(116, 141, 166, 0.4);
        }

        .comment-section {
            margin-top: 60px;
            text-align: left;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            padding: 35px;
            border-radius: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 10px;
            outline: none;
            font-family: inherit;
        }

        .btn-send {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .comments-list {
            margin-top: 30px;
            max-height: 380px;
            overflow-y: auto;
            padding-right: 8px;
            scroll-behavior: smooth;
        }

        /* Scrollbar Modern */
        .comments-list::-webkit-scrollbar {
            width: 6px;
        }

        .comments-list::-webkit-scrollbar-track {
            background: #f3f3f3;
            border-radius: 10px;
        }

        .comments-list::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .comments-list::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        .comment-item {
            background: #fdfcfb;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            border-left: 4px solid var(--primary);
        }

        .comment-item strong {
            display: block;
            font-size: 14px;
            color: var(--text-dark);
        }

        .comment-item p {
            font-size: 13px;
            color: var(--text-light);
            margin-top: 5px;
            line-height: 1.5;
        }

        /* Animasi untuk elemen saat muncul di scroll - versi semi 3D */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px) rotateX(15deg);
            transition: all 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0) rotateX(0deg);
        }

        /* Variasi animasi semi 3D kiri */
        .scroll-reveal-left {
            opacity: 0;
            transform: translateX(-60px) rotateY(25deg);
            transition: all 0.8s cubic-bezier(0.34, 1.2, 0.64, 1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .scroll-reveal-left.revealed {
            opacity: 1;
            transform: translateX(0) rotateY(0deg);
        }

        /* Variasi animasi semi 3D kanan */
        .scroll-reveal-right {
            opacity: 0;
            transform: translateX(60px) rotateY(-25deg);
            transition: all 0.8s cubic-bezier(0.34, 1.2, 0.64, 1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .scroll-reveal-right.revealed {
            opacity: 1;
            transform: translateX(0) rotateY(0deg);
        }

        /* Variasi animasi scale dengan efek pop 3D */
        .scroll-reveal-scale {
            opacity: 0;
            transform: scale(0.85) translateZ(-50px);
            transition: all 0.7s cubic-bezier(0.34, 1.3, 0.55, 1);
            transform-style: preserve-3d;
            perspective: 800px;
        }

        .scroll-reveal-scale.revealed {
            opacity: 1;
            transform: scale(1) translateZ(0);
        }

        /* Efek blur saat muncul (semi 3D depth of field) */
        .scroll-reveal,
        .scroll-reveal-left,
        .scroll-reveal-right,
        .scroll-reveal-scale {
            filter: blur(3px);
            transition: all 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94), filter 0.7s ease-out;
        }

        .scroll-reveal.revealed,
        .scroll-reveal-left.revealed,
        .scroll-reveal-right.revealed,
        .scroll-reveal-scale.revealed {
            filter: blur(0);
        }

        /* Delay dengan easing berbeda untuk efek berurutan yang lebih organik */
        .delay-1 {
            transition-delay: 0.08s;
        }

        .delay-2 {
            transition-delay: 0.16s;
        }

        .delay-3 {
            transition-delay: 0.24s;
        }

        .delay-4 {
            transition-delay: 0.32s;
        }

        .delay-5 {
            transition-delay: 0.42s;
        }

        /* Efek shadow 3D saat hover untuk elemen yang sudah muncul */
        .scroll-reveal.revealed:hover,
        .scroll-reveal-left.revealed:hover,
        .scroll-reveal-right.revealed:hover,
        .scroll-reveal-scale.revealed:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.12);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Efek khusus untuk gallery item dengan efek tilt 3D */
        .gallery-item {
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .gallery-item.revealed:hover {
            transform: translateY(-8px) rotateX(3deg);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.15);
        }

        /* Efek khusus untuk event card dengan depth */
        .event-card {
            transform-style: preserve-3d;
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .event-card.revealed:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.1);
        }

        /* Efek untuk timeline items */
        .timeline-item {
            transform-style: preserve-3d;
            transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .timeline-item.revealed:hover {
            transform: translateX(5px) translateZ(10px);
        }

        .timeline-item.left.revealed:hover {
            transform: translateX(-5px) translateZ(10px);
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            opacity: 0;
            transition: opacity 1s ease 0.5s;
            padding-bottom: 100px;
        }

        body.opened {
            overflow-y: auto;
        }

        body.opened .cover {
            transform: translateY(-100%);
        }

        body.opened .main-content {
            opacity: 1;
        }

        body.opened #music-control {
            display: flex;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 80px 20px;
            text-align: center;
        }

        .salam-h3 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 25px;
        }

        .couple-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 5px;
        }

        .parents-text {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 30px;
        }

        .gallery {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 60px 0;
        }

        .gallery-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .stagger {
            margin-top: 50px;
        }

        .event-card {
            background: var(--white);
            padding: 50px 30px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.02);
            border: 1px solid #f0f0f0;
            margin-top: 50px;
        }

        .event-item {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
        }

        .maps-container {
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            height: 250px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-maps {
            display: inline-block;
            padding: 12px 25px;
            border: 1.5px solid var(--primary);
            color: var(--primary);
            text-decoration: none;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
        }

        footer {
            padding: 60px;
            text-align: center;
            background: #fff;
            border-top: 1px solid #f5f5f5;
        }

        /* Style untuk cover dengan video */
        .cover {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            z-index: 1000;
        }

        .cover-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
            transition: opacity 1s ease;
        }

        .cover-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
            z-index: -2;
        }

        .cover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
            z-index: -1;
        }

        .cover-content {
            position: relative;
            z-index: 10;
            padding: 50px 40px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(18px);
            border-radius: 35px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            width: 90%;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tombol buka undangan */
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
            box-shadow: 0 10px 25px rgba(124, 92, 82, 0.35);
            position: relative;
            z-index: 20;
        }

        .btn-open:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 15px 30px rgba(124, 92, 82, 0.5);
        }

        /* Animasi fade out untuk background foto saat video muncul */
        .cover-bg.fade-out {
            opacity: 0;
        }

        /* Saat undangan sudah dibuka */
        body.opened .cover {
            transform: translateY(-100%);
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1);
            visibility: hidden;
        }

        body.opened .cover-video {
            display: none;
        }
    </style>
</head>

<body id="body">

    <audio id="weddingMusic" loop>
        <source src="<?= $musik_url ?>" type="audio/mpeg">
    </audio>

    <div id="music-control" onclick="toggleMusic()">🎵</div>

    <section class="cover" id="cover">
        <!-- Background default (foto) -->
        <div class="cover-bg" id="coverBg" style="background-image: url('<?= $cover_bg ?>');"></div>

        <!-- Video yang akan muncul setelah 2 detik -->
        <video id="coverVideo" class="cover-video" muted playsinline loop style="display: none;">
            <source src="<?= $cover_video ?>" type="video/mp4">
        </video>

        <div class="cover-overlay"></div>

        <div class="cover-content">
            <p style="letter-spacing: 4px; font-size: 11px; text-transform: uppercase; margin-bottom: 10px;">The Wedding
                of</p>
            <h1 class="cover-title"><?= explode(' ', $pria)[0] ?> & <?= explode(' ', $wanita)[0] ?></h1>
            <p style="letter-spacing: 2px; margin-bottom: 30px; font-weight: 300;"><?= $tanggal_wedding ?></p>

            <div class="recipient-box">
                <p style="font-size: 11px; color: #aaa; margin-bottom: 8px;">Kpd Bapak/Ibu/Saudara/i:</p>
                <h3 style="font-size: 1.5rem; font-family: 'Playfair Display', serif;"><?= $nama_tamu ?></h3>
            </div>

            <button class="btn-open" id="btnOpenInvitation">BUKA UNDANGAN</button>
        </div>
    </section>



    <div class="main-content">
        <div class="container">
            <h3 class="salam-h3">Assalamu’alaikum Wr. Wb.</h3>
            <p style="color: var(--text-light); line-height: 1.8; margin-bottom: 40px;">
                Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu
                pada hari bahagia pernikahan kami:
            </p>

            <div style="margin: 50px 0;">
                <div class="mempelai-detail" style="margin-bottom: 30px;">
                    <div
                        style="width: 150px; height: 150px; margin: 0 auto 15px; border-radius: 50%; overflow: hidden; border: 3px solid var(--primary); padding: 5px;">
                        <img src="assets/pria.jpeg"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Foto Pria">
                    </div>
                    <h2 class="couple-name"><?= $pria ?></h2>
                    <p style="font-size: 0.85rem; color: #999;">Putra dari Bapak Kusdian & Ibu Romlah Sutiati, S.Pd </p>
                    <a href="https://www.instagram.com/nandirzki_/?utm_source=ig_web_button_share_sheet<?= $ig_pria ?>" target="_blank"
                        style="text-decoration: none; display: inline-flex; align-items: center; margin-top: 10px; color: var(--primary); font-size: 0.8rem;">
                        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="16"
                            style="margin-right: 5px;">
                        @<?= $ig_pria ?>
                    </a>
                </div>

                <h2
                    style="font-family: 'Playfair Display', serif; color: var(--primary); margin: 10px 0; font-size: 1.5rem;">
                    &</h2>

                <div class="mempelai-detail" style="margin-top: 30px;">
                    <div
                        style="width: 150px; height: 150px; margin: 0 auto 15px; border-radius: 50%; overflow: hidden; border: 3px solid var(--primary); padding: 5px;">
                        <img src="assets/wanita.jpeg"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Foto Wanita">
                    </div>
                    <h2 class="couple-name"><?= $wanita ?></h2>
                    <p style="font-size: 0.85rem; color: #999;">Putri dari Bapak Dadang sudrajat & Ibu Ela sumiati</p>
                    <a href="https://www.instagram.com/astri.a__/?utm_source=ig_web_button_share_sheet" target="_blank" style="...">
                        <a href="https://instagram.com/<?= $ig_wanita ?>" target="_blank"
                            style="text-decoration: none; display: inline-flex; align-items: center; margin-top: 10px; color: var(--primary); font-size: 0.8rem;">
                            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" width="16"
                                style="margin-right: 5px;">
                            @<?= $ig_wanita ?>
                        </a>
                </div>
            </div>

            <div class="quotes-container">
                <div class="holy-verse">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari
                    jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu
                    rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran
                    Allah) bagi kaum yang berpikir."
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
                    <img src="assets/1.jpeg"
                        class="gallery-img" alt="Prewed 1">
                </div>
                <div class="gallery-item stagger">
                    <img src="assets/2.jpeg"
                        class="gallery-img" alt="Prewed 2">
                </div>
                <div class="gallery-item">
                    <img src="assets/4.jpeg"
                        class="gallery-img" alt="Prewed 3">
                </div>
                <div class="gallery-item stagger">
                    <img src="assets/3.jpeg"
                        class="gallery-img" alt="Prewed 4">
                </div>
            </div>

            <div class="container story-section">
                <h3 class="salam-h3" style="font-style: normal; margin-bottom: 10px;">Our Love Story</h3>
                <p style="font-size: 13px; color: var(--text-light); margin-bottom: 40px;">"Sebab rindu telah menemukan
                    rumahnya, dan perjalanan panjang ini akhirnya berujung pada pelukanmu. Cinta bukan tentang siapa
                    yang tercepat menemukan, tapi tentang siapa yang paling yakin untuk tetap tinggal."</p>

                <div class="timeline">
                    <div class="timeline-item left">
                        <div class="story-content">
                            <span class="story-date">2022</span>
                            <h4 class="story-title">Pertama Bertemu</h4>
                            <p class="story-text">Satu sekolahan, tapi baru benar-benar bertemu saat ujian akhir semester. Waktu itu Nandira tidak membawa pulpen untuk tanda tangan absen — aku meminjamkannya. Dari hal sesederhana itu, semuanya dimulai.</p>
                        </div>
                    </div>

                    <div class="timeline-item right" style="transition-delay: 0.3s;">
                        <div class="story-content">
                            <span class="story-date">2023</span>
                            <h4 class="story-title">Komitmen</h4>
                            <p class="story-text">Setelah lulus sekolah, Nandira datang membawa sebuah cincin dan dengan penuh keyakinan memakainya di jari manisku. Di tahun 2023 itu, ia resmi berkomitmen — bukan dengan kata-kata biasa, tapi dengan sebuah janji yang ia ucapkan langsung dari hatinya. Bahwa aku adalah cinta pertama dan terakhirnya. Dan hingga hari ini, cincinnya masih melingkar di jariku sebagai pengingat bahwa ia sungguh-sungguh.</p>
                        </div>
                    </div>

                    <div class="timeline-item left" style="transition-delay: 0.6s;">
                        <div class="story-content">
                            <span class="story-date">10 Agustus 2024</span>
                            <h4 class="story-title">Lamaran</h4>
                            <p class="story-text">Di hari ulang tahunku, Nandira hadir dengan kejutan yang tak pernah aku duga — ia datang bersama keluarga kecilku dan para sahabatku. Di sana ia memberikan sebuah cincin, tapi tanpa sepatah kata pun tentang alasannya. Aku sempat bertanya-tanya. Ternyata ia malu bicara di depan semua orang. Baru setelahnya, ia berbisik pelan — bahwa cincin itu bukan sekadar hadiah. Itu adalah caranya mengajakku melangkah ke jenjang yang lebih serius..</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-card">
                <div class="event-item">
                    <p
                        style="text-transform: uppercase; letter-spacing: 3px; font-size: 11px; color: var(--primary); margin-bottom: 10px;">
                        Tasyakuran
                    </p>

                    <p style="font-size: 1.2rem; font-weight: 600;">

Kamis, 4 Juni – Sabtu, 6 Juni 2026
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
                <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px; text-align: center;">Berikan
                    Ucapan & Doa Restu</h3>

                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nama Anda</label>
                        <input type="text" name="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Ucapan / Doa</label>
                        <textarea name="ucapan" class="form-input" rows="4"
                            placeholder="Tulis ucapan selamat dan doa..." required></textarea>
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
                            Doa restu Anda merupakan karunia terindah bagi kami. Namun jika ingin memberikan tanda
                            kasih, silakan melalui kanal di bawah ini:
                        </p>

                        <div class="gift-options">
                            <button class="btn-option active" onclick="showGift('bank', this)">Transfer Bank</button>
                            <button class="btn-option" onclick="showGift('kh', this)">Kirim Hadiah Langsung</button>
                        </div>

                        <div id="gift-bank" class="gift-card active">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg"
                                class="bank-logo" alt="BRi">
                            <p style="font-size: 12px; color: #999;">Nomor Rekening:</p>
                            <span class="account-number" id="rek-bca">443601025919534</span>
                            <p style="font-size: 14px; font-weight: 600;">a.n Romlah Sutiati</p>
                            <button class="btn-maps" style="margin-top: 15px; padding: 8px 20px; font-size: 11px;"
                                onclick="copyNumber('rek-bca', this)">SALIN NO. REKENING</button>
                        </div>
                        <div id="gift-kh" class="gift-card">
                            <div style="font-size: 40px; margin-bottom: 15px; text-align: center;">🎁</div>
                            <p style="font-size: 12px; color: #999; text-align: center;">Kirim Hadiah Langsung ke Alamat
                            </p>
                            <p style="font-size: 14px; font-weight: 600; text-align: center; margin-bottom: 10px;">
                                Penerima Nandira Rizki</p>

                            <div style="background: #f9f6f2; padding: 15px; border-radius: 15px; margin: 15px 0;">
                                <p style="font-size: 11px; color: #999; margin-bottom: 5px;">ALAMAT PENGIRIMAN</p>
                                <span class="account-number" id="alamatHadiah"
                                    style="font-size: 0.9rem; word-break: break-word;">
                                    <?= nl2br(htmlspecialchars($alamat_lengkap)) ?>
                                </span>
                            </div>
                            <button class="btn-maps" style="margin-top: 15px; padding: 8px 20px; font-size: 11px;"
                                onclick="copyAlamatHadiah()">SALIN ALAMAT</button>
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
            <p style="font-size: 13px; color: #bbb;">Created by Undanganku Gen-Z | Digital Invitation</p>
        </footer>
    </div>

    <script>
        const audio = document.getElementById("weddingMusic");
        const musicControl = document.getElementById("music-control");

        // Hapus variable videoTimer di awal
        let videoTimer = null;

        // Fungsi untuk memulai video
        function startVideo() {
            const coverBg = document.getElementById('coverBg');
            const coverVideo = document.getElementById('coverVideo');

            if (coverVideo && coverVideo.querySelector('source')) {
                coverVideo.style.display = 'block';
                if (coverBg) {
                    coverBg.classList.add('fade-out');
                }

                coverVideo.play().catch(error => {
                    console.log('Autoplay video gagal: ', error);
                    coverVideo.style.display = 'none';
                    if (coverBg) {
                        coverBg.classList.remove('fade-out');
                    }
                });
            }
        }

        // Set timer 2 detik untuk memulai video
        if (typeof videoTimer !== 'undefined' && videoTimer) {
            clearTimeout(videoTimer);
        }
        videoTimer = setTimeout(startVideo, 2000);

        // Fungsi untuk membuka undangan
        function startInvitation() {
            // Hentikan video jika sedang berjalan
            const coverVideo = document.getElementById('coverVideo');
            if (coverVideo) {
                coverVideo.pause();
            }

            // Hapus timer video jika masih berjalan
            if (videoTimer) {
                clearTimeout(videoTimer);
                videoTimer = null;
            }

            // Tambahkan class opened untuk transisi cover
            document.body.classList.add('opened');

            // Mainkan musik
            const audio = document.getElementById("weddingMusic");
            if (audio) {
                audio.play().catch(error => {
                    console.log("Browser memblokir autoplay: ", error);
                });
            }

            // Scroll halus ke atas
            setTimeout(() => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 1100);
        }

        // Pastikan tombol bisa diklik - tambahkan event listener manual
        document.addEventListener('DOMContentLoaded', function () {
            const btnOpen = document.querySelector('.btn-open');
            if (btnOpen) {
                // Hapus atribut onclick jika ada
                btnOpen.removeAttribute('onclick');
                // Tambahkan event listener baru
                btnOpen.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    startInvitation();
                });
            }

            // Hentikan propagasi event pada cover content
            const coverContent = document.querySelector('.cover-content');
            if (coverContent) {
                coverContent.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            }
        });

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
        const comments = document.querySelectorAll('.comment-item');
        const commentsList = document.querySelector('.comments-list');

        if (comments.length > 3) {
            commentsList.style.maxHeight = "380px";
            commentsList.style.overflowY = "auto";
        } else {
            commentsList.style.maxHeight = "none";
            commentsList.style.overflowY = "hidden";
        }

        (function () {
            // Tambahkan class untuk elemen yang akan dianimasi
            document.addEventListener('DOMContentLoaded', function () {

                // Kumpulkan semua elemen yang ingin dianimasi saat scroll
                const elementsToAnimate = [
                    // Quotes container
                    { selector: '.quotes-container', type: 'reveal' },
                    // Countdown container
                    { selector: '.countdown-container', type: 'reveal' },
                    // Section title gallery
                    { selector: '.section-title', type: 'reveal' },
                    { selector: '.section-subtitle', type: 'reveal', delay: 'delay-1' },
                    // Setiap gallery item
                    { selector: '.gallery-item', type: 'reveal', each: true, delayClass: ['delay-1', 'delay-2', 'delay-3', 'delay-4'] },
                    // Story section title
                    { selector: '.story-section .salam-h3', type: 'reveal' },
                    // Setiap timeline item
                    { selector: '.timeline-item', type: 'reveal', each: true },
                    // Event card
                    { selector: '.event-card', type: 'reveal-scale' },
                    // Setiap event item di dalam event card
                    { selector: '.event-item', type: 'reveal-left', each: true, delayClass: ['delay-1', 'delay-2'] },
                    // Maps container
                    { selector: '.maps-container', type: 'reveal' },
                    // Tombol maps
                    { selector: '.btn-maps', type: 'reveal-scale', delay: 'delay-1' },
                    // Comment section
                    { selector: '.comment-section', type: 'reveal' },
                    // Gift container
                    { selector: '.gift-container', type: 'reveal' },
                    // Gift cards
                    { selector: '.gift-card', type: 'reveal-scale', each: true, delayClass: ['delay-1', 'delay-2', 'delay-3'] },
                    // Setiap comment item yang sudah ada
                    { selector: '.comment-item', type: 'reveal-right', each: true },
                    // Footer
                    { selector: 'footer', type: 'reveal' },
                    // Mempelai detail
                    { selector: '.mempelai-detail', type: 'reveal-scale', each: true, delayClass: ['delay-1', 'delay-3'] },
                    // Salam pembuka
                    { selector: '.salam-h3:first-of-type', type: 'reveal' },
                    // Teks salam
                    { selector: '.container > p:first-of-type', type: 'reveal', delay: 'delay-1' },
                    // Flower decorations
                    { selector: '.flower', type: 'reveal-scale', each: true, delayClass: ['delay-2', 'delay-4', 'delay-1'] }
                ];

                // Fungsi untuk menambahkan class ke elemen
                function addScrollClass(element, type, delayClass = '') {
                    if (type === 'reveal') {
                        element.classList.add('scroll-reveal');
                    } else if (type === 'reveal-left') {
                        element.classList.add('scroll-reveal-left');
                    } else if (type === 'reveal-right') {
                        element.classList.add('scroll-reveal-right');
                    } else if (type === 'reveal-scale') {
                        element.classList.add('scroll-reveal-scale');
                    }
                    if (delayClass) {
                        element.classList.add(delayClass);
                    }
                }

                // Terapkan class ke elemen
                elementsToAnimate.forEach(item => {
                    if (item.each) {
                        const elements = document.querySelectorAll(item.selector);
                        elements.forEach((el, index) => {
                            let delay = '';
                            if (item.delayClass) {
                                if (Array.isArray(item.delayClass)) {
                                    delay = item.delayClass[index % item.delayClass.length];
                                } else {
                                    delay = item.delayClass;
                                }
                            } else if (item.delay) {
                                delay = item.delay;
                            }
                            addScrollClass(el, item.type, delay);
                        });
                    } else {
                        const el = document.querySelector(item.selector);
                        if (el) {
                            let delay = item.delay || '';
                            addScrollClass(el, item.type, delay);
                        }
                    }
                });

                // OBSERVER UNTUK MENDETEKSI SCROLL DENGAN REPEAT (BISA BERULANG)
                const observerOptions = {
                    threshold: 0.12,  // Sedikit lebih rendah agar lebih sensitif
                    rootMargin: '0px 0px -20px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            // Tambah class revealed saat elemen masuk viewport
                            setTimeout(() => {
                                entry.target.classList.add('revealed');
                            }, 50);
                        } else {
                            // HAPUS class revealed saat elemen keluar viewport
                            // Ini yang membuat animasi bisa berulang saat scroll ke atas
                            entry.target.classList.remove('revealed');
                        }
                    });
                }, observerOptions);

                // Observe semua elemen yang sudah diberi class animasi
                const animatedElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale');
                animatedElements.forEach(el => observer.observe(el));

                // JIKA ELEMEN SUDAH TERLIHAT SAAT PERTAMA KALI (setelah cover hilang)
                setTimeout(() => {
                    animatedElements.forEach((el, index) => {
                        const rect = el.getBoundingClientRect();
                        const windowHeight = window.innerHeight;
                        if (rect.top < windowHeight - 80) {
                            setTimeout(() => {
                                el.classList.add('revealed');
                            }, index * 30);
                        }
                    });
                }, 1600);
            });
        })();

        function copyAlamatHadiah() {
            const btn = event.target;
            // Ambil teks alamat dari span, ganti <br> dengan newline
            const alamatElement = document.getElementById('alamatHadiah');
            let alamat = alamatElement.innerText || alamatElement.textContent;

            // Bersihkan dan format alamat
            alamat = alamat.replace(/\n\s*\n/g, '\n').trim();

            navigator.clipboard.writeText(alamat).then(() => {
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
            }).catch(() => {
                // Fallback untuk browser lama
                const textarea = document.createElement('textarea');
                textarea.value = alamat;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);

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
    </script>
</body>

</html>
