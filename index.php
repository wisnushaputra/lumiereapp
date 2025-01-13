<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: view/login.php');

    }

    $current_page = basename($_SERVER['PHP_SELF']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumiereapp</title>
    <link rel="stylesheet" href="css/styles_message.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 2em;
            font-family: 'Dancing Script', cursive;
            color: #7a73c7;  /* Warna utama */
            margin-left: 0.5em;
        }

        section{
        margin:auto;
        display:flex;
        margin-bottom:5em
       }

       

       .kolom .deskripsi{
        font-size:1.5em;
        font-weight: bold;
        font-family:'Poppins', Arial, sans-serif;
        color: rgb(83, 104, 183);
       }
       .kolom .deskripsi2{
        font-size:1em;
        font-weight: bold;
        font-family:'Poppins', Arial, sans-serif;
        color: rgb(83, 104, 183);
       }
       

       h2{
        font-family:'Poppins', Arial, sans-serif;
        font-weight:800;
        font-size:2.5em;
        margin-top:2em;
        color: rgb(83, 104, 183);
        width:100%;
       }

       h3{
        font-family: Arial, sans-serif;
        font-weight:bold;
        font-size:1.5em;
        color:black;
       }



    .container-tab {
    max-width: 100%;
    background-color:white;
    border-radius: 1em;
    padding: 1em;
    margin-right:1em;
}

/* Tab Header */
.tab {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    background-color: white; /* Sama dengan konten */
    border-bottom: none; /* Hilangkan border bawah */
    padding: 0;
    gap: 5px; /* Mengatur jarak antar tab */
}
.tab button {
    background-color: white;
    border: 2px solid transparent;
    color: #333;
    text-align: center;
    cursor: pointer;
    padding: 0.3em 0.8em; /* Ukuran lebih kecil */
    border-radius: 1em 1em 0 0; /* Membuat sudut atas melengkung */
    transition: all 0.3s ease;
    font-weight: bold;
    font-size: 1em; /* Ukuran font lebih kecil */
}
.tab button.active {
    background-color: rgb(230, 226, 250); /* Warna konten */
    border-bottom: none; /* Hilangkan border bawah */
    color:rgb(83, 104, 183);
}
.tab button img {
    display: block;
    margin: 0 auto 0.5em;
    width: 3em;
    height: 3em;
}

/* Tab Konten */
.tab-content {
    display: none;
    background-color:rgb(230, 226, 250);
    border-radius: 0 0 0.5em 0.5em; /* Membuat sudut bawah melengkung */
    padding: 1em;
}
.tab-content.active {
    display: block;
}   

/* Gaya untuk setiap tab */
.tablinks {
    display: inline-flex;
    padding: 0.3em 0.5em; /* Ukuran lebih kecil */
    cursor: pointer;
    font-weight: bold;
    text-decoration: none;
    color: black;
    border: none;
    border-bottom: 0.3em solid transparent;
    transition: all 0.3s ease;
    display: grid;
    grid-template-rows: auto auto; /* Dua baris: satu untuk gambar, satu untuk teks */
    justify-items: center; /* Pusatkan elemen secara horizontal */
   
}

.tablinks:hover, .tablinks.active {
    border-bottom: 0.3em solid #63b3ed; /* Garis bawah tab aktif */
    color: #63b3ed; /* Warna teks untuk tab aktif */
}

.text{
    color:rgb(83, 104, 183);
    font-family:'Poppins', Arial, sans-serif;
    font-weight: bold;
    font-size:2em;

}

.content-container {
    display: flex;
    align-items: center; /* Mengatur vertikal sejajar */
    gap: 20px; /* Memberi jarak antara gambar dan teks */
}



.text-content {
    flex: 1; /* Memastikan teks mengambil sisa ruang */
    font-family: Arial, sans-serif;
    color: #4a4a4a;
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column; /* Susunan vertikal di layar kecil */
        align-items: center;
    }

   
}



.header-container {
    display: flex;
    justify-content: space-between; /* Logo di kiri, menu di kanan */
    align-items: center; /* Sejajar secara vertikal */
    flex-wrap: wrap; /* Agar elemen melipat saat ruang tidak cukup */
    padding: 10px 20px;
    background-color: #e6e6fa;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Gaya untuk desktop */
@media (min-width: 769px) {
    .image-left {
        width: 600px; /* Lebar gambar */
        height: 600px; /* Tinggi gambar */
        object-fit: cover; /* Sesuaikan gambar tanpa distorsi */
        
    }

    .text-content {
        text-align: left; /* Rata kiri untuk teks pada desktop */
    }
}

/* Gaya untuk mobile */
@media (max-width: 768px) {
    .content-container {
        flex-direction: column; /* Susunan vertikal untuk mobile */
    }

    .image-left {
        order: -1; /* Tempatkan gambar di atas teks */
        width: 100%; /* Skala gambar sesuai layar */
        height: auto; /* Jaga proporsi gambar */
        margin-bottom: 20px;
    }

    .text-content {
        text-align: center; /* Teks rata tengah pada mobile */
    }

}
    </style>
</head>
  <body class="container">
  <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #beb3ff; color: white;">
            <div class="container">
                <!-- Logo Navbar -->
                <a class="navbar-brand" >
                    Lumière
                    <div class="navbar-tagline" style="font-size: 0.5em; color: #7a73c7;">together, we find strength</div>
                </a>

                <!-- Button Toggle untuk Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto"> <!-- Tambahkan ms-auto untuk menggeser ke kanan -->
                    <li class="nav-item"><a class="<?= $current_page == 'index.php' ? 'active' : '' ?>"  ><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item "><a class="nav-link "   style="color: white; " href="view/diary.php"><i class="fas fa-book"></i> Jurnal</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white; " href="view/message.php"><i class="fas fa-comments"></i> Chat</a></li>
                
                        <!-- Dropdown Profil dan Logout -->
                        

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li> -->
                                <li><a class="dropdown-item" href="view/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
           <section >
                <div class="kolom" >
                <div class="content-container" >
                    <!-- <img src="img/index.jpg" alt="Deskripsi gambar" class="image-left img-fluid"> -->
                    <img src="img/index.jpg" alt="Deskripsi gambar" class="img-fluid image-left"  >
                    
                    <div class="text-content">
                        <p>Yuk, Curahkan Hati Dan Pikiranmu Yang Selama Ini Terpendam Bersama Lumière.</p>
                        <p>Kamu tidak harus menghadapi semuanya sendiri. Kami hadir untuk memberikan layanan konseling online dengan orang yang terpercaya.</p>
                        <h2>Tetap Sehat, Tetap Semangat!!</h2>
                    </div>
                </div>
                </div>
           </section>

           <section >
                <div class="container-tab" >
                    <div class="kolom">
                        <p class="text">Apa Yang Sedang Kamu Rasakan?</p>
                        <p class="deskripsi" style="color:black;font-weight: 400;">Yuk, pilih perasaan yang sedang kamu hadapi dan temukan bantuan yang
                            kamu butuhkan sekarang!</p>  
                    
                    </div>
                    <!-- Tab Header -->
                    <div class="tab">
                    
                        <button class="tablinks active" onclick="openTab(event, 'Kecemasan')">
                        <img src="img/kecemasan.svg" alt="Kecemasan" class="img-fluid">
                        <span>Kecemasan</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Stres')" >
                            <img src="img/stres.svg" alt="stres" class="img-fluid">
                            <span>Stres</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Trauma')">
                        <img src="img/trauma.png" alt="trauma" class="img-fluid">
                        <span>Trauma</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Burnout')">
                        <img src="img/burnout.png" alt="burnout" class="img-fluid">
                        <span>Burnout</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Depresi')">
                        <img src="img/depresi.png" alt="depresi" class="img-fluid">
                        <span>Depresi</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Keluarga')">
                        <img src="img/keluarga.png" alt="keluarga" class="img-fluid">
                        <span>Hubungan</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Mood')">
                        <img src="img/mood.png" alt="mood" class="img-fluid">
                        <span>Gangguan Mood</span>
                        </button>
                        <button class="tablinks" onclick="openTab(event, 'Kecanduan')">
                        <img src="img/kecanduan.png" alt="kecanduan" class="img-fluid">
                        <span>Kecanduan</span>
                        </button>
                    </div>

                    <!-- Tab Konten -->
                    <div id="Kecemasan" class="tab-content active">
                        <h3>Kecemasan: Lebih dari Sekadar Gugup Biasa</h3>
                        <p style="color:black;font-weight: 400;">Kecemasan adalah perasaan khawatir atau takut yang intens dan menetap. 
                            Meskipun rasa cemas sesekali adalah normal, terutama dalam situasi yang penuh tekanan, 
                            kecemasan yang berlebihan dan berkepanjangan dapat mengganggu kehidupan sehari-hari.</p>
                    </div>
                    <div id="Stres" class="tab-content">
                        <h3>Stres: Musuh Terselubung Kesehatan Mental Kita</h3>
                        <p style="color:black;font-weight: 400;">Stres adalah reaksi alami tubuh terhadap situasi yang penuh tekanan. 
                            Ini adalah alarm internal yang memperingatkan kita bahwa ada sesuatu yang perlu dihadapi. 
                            Dalam kadar yang wajar, stres bisa memotivasi kita untuk bertindak dan mencapai tujuan. 
                            Namun, jika dibiarkan berlarut-larut dan tidak dikelola dengan baik, 
                            stres bisa menjadi musuh terselubung kesehatan mental kita.</p>
                    </div>
                    <div id="Trauma" class="tab-content">
                        <h3>Trauma: Luka Tak Kasat Mata yang Mempengaruhi Kesehatan Mental </h3>
                        <p style="color:black;font-weight: 400;">Trauma adalah reaksi emosional yang intens dan berkepanjangan terhadap peristiwa yang sangat menegangkan atau menakutkan. 
                            Peristiwa tersebut bisa berupa kekerasan fisik atau seksual, kecelakaan, bencana alam, perang, 
                            atau penganiayaan.</p>
                    </div>
                    <div id="Burnout" class="tab-content">
                        <h3>Burnout: Musuh Terselubung Kesehatan Mental Kita </h3>
                        <p style="color:black;font-weight: 400;">Burnout adalah keadaan kelelahan emosional, mental, dan fisik yang disebabkan oleh stres berkepanjangan. 
                            Ini terjadi ketika seseorang merasa terlalu tertekan dan kewalahan, 
                            dan tidak dapat lagi mengatasi tuntutan yang dihadapi. 
                            Burnout dapat berdampak negatif pada semua aspek kehidupan Anda, termasuk pekerjaan, 
                            hubungan, dan kesehatan fisik.</p>
                    </div>
                    <div id="Depresi" class="tab-content">
                        <h3>Depresi: Lebih dari Sekadar Sedih Biasa</h3>
                        <p style="color:black;font-weight: 400;">Depresi adalah gangguan kesehatan mental yang umum dan serius yang ditandai dengan suasana 
                            hati yang rendah, kehilangan minat atau kesenangan, dan berbagai gejala fisik dan mental lainnya. 
                            Meskipun kesedihan adalah emosi yang normal, depresi berbeda karena intensitas dan durasinya yang 
                            lebih besar, serta dampaknya yang signifikan pada kehidupan sehari-hari.</p>
                    </div>
                    <div id="Keluarga" class="tab-content">
                        <h3>Terapi Keluarga dan Hubungan: Meraih Harmoni Bersama</h3>
                        <p style="color:black;font-weight: 400;">Terapi keluarga dan hubungan adalah bentuk terapi bicara yang bertujuan membantu individu, 
                            pasangan, atau keluarga mengatasi berbagai masalah hubungan. Terapis berlatih membantu para 
                            peserta untuk memahami pola komunikasi dan interaksi mereka, mengidentifikasi sumber konflik, 
                            dan mengembangkan keterampilan komunikasi dan manajemen konflik yang lebih efektif.</p>
                    </div>
                    <div id="Mood" class="tab-content">
                        <h3>Permainan Suasana Hati: Mengenal Gangguan Mood </h3>
                        <p style="color:black;font-weight: 400;">Gangguan mood adalah kelompok gangguan kesehatan mental yang ditandai dengan perubahan 
                            suasana hati yang ekstrem dan berlangsung lama. Gangguan ini berbeda dengan fluktuasi 
                            emosi normal yang dialami semua orang, karena intensitas, durasi, dan dampaknya yang lebih 
                            signifikan terhadap kehidupan sehari-hari.</p>
                    </div>
                    <div id="Kecanduan" class="tab-content">
                        <h3>Kecanduan: Memahami dan Mengatasi Ketergantungan</h3>
                        <p style="color:black;font-weight: 400;">Kecanduan atau adiksi adalah kondisi saat seseorang tidak dapat berhenti mengkonsumsi suatu 
                            zat atau melakukan sebuah kegiatan. Orang dengan kecanduan akan kehilangan kontrol terhadap 
                            perilakunya meskipun hal itu bisa merusak kehidupan rumah tangga, pekerjaan, atau hubungan 
                            pertemanannya. Segera dapatkan bantuan profesional untuk mengatasi kecanduan serta mendapatkan 
                            cara yang tepat untuk mengatasinya.</p>
                    </div>
                    <!-- Tambahkan konten tab lain sesuai kebutuhan -->   
                </div>

            </section>

            <section class="content-container" style="margin-left:20px;">
                
                <div class="kolom  " style="margin-top:20px;" >
                    <h2>Hai! Salam Kenal Dari</h2>
                    <h3 class="desk-lumiere">
                        Lumière
                        <div class="tagline-lumiere">together, we find strength</div>
                    </h3> 
                    <br>
                    <p class="deskripsi2" style="color:black; font-weight: 400;">Lumière adalah layanan dukungan emosional daring. 
                        Melalui teknologi penghubung yang aman dan anonim, kami menghubungkan mereka yang membutuhkan dukungan 
                        emosional dengan jaringan Active Listeners kami, individu dari berbagai latar belakang yang ingin 
                        memberikan perhatian dan dukungan penuh kasih. Koneksi dengan Listener bersifat pribadi, 
                        berupa percakapan satu lawan satu yang dimulai berdasarkan permintaan.</p>

                        <p class="deskripsi2" style="color:black; font-weight: 400;">
                        Mendengarkan Aktif adalah serangkaian keterampilan komunikasi yang menunjukkan empati, 
                        kasih sayang, pemahaman, dan rasa hormat. Mendengarkan aktif berbeda dari mendengarkan 
                        biasa yang kita lakukan dalam percakapan sehari-hari. Alih-alih hanya “menunggu giliran 
                        untuk berbicara” atau memikirkan apa yang akan kita katakan setelah lawan bicara selesai 
                        berbicara, mendengarkan aktif mengharuskan pendengar untuk sepenuhnya fokus pada menyerap, 
                        memahami, dan merefleksikan apa yang dibagikan oleh pembicara.</p>

                        <p class="deskripsi2" style="color:black; font-weight: 400;">
                        Mendengarkan aktif adalah teknik yang sangat baik untuk membantu orang merasa lebih baik 
                        ketika mereka sedang menghadapi masa sulit, berurusan dengan kehilangan, bergumul dengan 
                        masalah kesehatan, atau sekadar ingin melampiaskan perasaan. Karena mendengarkan aktif 
                        mengarahkan seluruh perhatian pada pembicara, teknik ini menghilangkan potensi sumber 
                        stres, konflik, dan ketidaknyamanan yang dapat terjadi dalam percakapan biasa.</p>
                    
                </div>
                <!-- <img src="img/mental2.jpg" alt="Deskripsi gambar" class="img-fluid"  style="margin-top:8em;"> -->
                <img src="img/mental2.jpg" alt="Deskripsi gambar" class="img-fluid image-left"  >

            
            </section>

        </div>
    </main>

    <script>
        function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}
    </script>

    <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>
    
    
</body>
</html>

