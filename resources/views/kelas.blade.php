<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Mahasiswa - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR (Konsisten) === */
        .sidebar { width: 280px; background-color: #2b6cb0; color: white; padding: 25px 20px; display: flex; flex-direction: column; gap: 20px; flex-shrink: 0; }
        
        .logo-area { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding: 0 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; }
        .brand-wrapper img { width: 32px; height: 32px; object-fit: contain; }
        .toggle-btn { width: 22px; height: 22px; cursor: pointer; object-fit: contain; opacity: 0.9; transition: 0.2s; }
        .toggle-btn:hover { opacity: 1; }
        
        .sidebar-profile { background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.1); padding: 16px; border-radius: 12px; display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .sidebar-avatar { width: 45px; height: 45px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
        .sidebar-profile h3 { font-size: 15px; font-weight: 700; margin: 0; }
        .sidebar-profile p { font-size: 11px; color: #e2e8f0; margin: 3px 0 0 0; line-height: 1.3; }

        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .nav-item { padding: 14px 18px; border-radius: 10px; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 15px; font-weight: 600; transition: 0.2s; color: white; text-decoration: none; }
        .nav-item:hover { background-color: rgba(255, 255, 255, 0.1); }
        .nav-item.active { background-color: #1e3a8a; } 
        .nav-item img { width: 20px; height: 20px; object-fit: contain; }

        /* === KONTEN UTAMA === */
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; height: 100vh;}
        
        .page-header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }

        /* === FILTER & SEARCH BAR === */
        .filter-bar { background-color: white; border-radius: 12px; padding: 12px 20px; display: flex; align-items: center; gap: 15px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .search-box { flex: 1; display: flex; align-items: center; gap: 10px; border-right: 1px solid #e2e8f0; padding-right: 15px; }
        .search-box input { border: none; outline: none; font-size: 15px; width: 100%; font-family: 'Inter', sans-serif; font-weight: 600; color: #0f172a; }
        .search-box input::placeholder { color: #0f172a; }
        .filter-buttons { display: flex; gap: 10px; align-items: center; }
        .filter-pill { padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; color: #475569; background-color: #cbd5e1; transition: 0.2s; }
        .filter-pill.active { background-color: #64748b; color: white; }
        .filter-divider { width: 1px; height: 24px; background-color: #cbd5e1; margin: 0 5px; }

        /* === CARD KELAS === */
        .class-list { display: flex; flex-direction: column; gap: 20px; }
        .class-card { background-color: #5c8cb3; border-radius: 16px; padding: 20px; display: flex; gap: 25px; position: relative; border: 2px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        
        /* Ikon Titik Tiga Kanan Atas */
        .card-options { position: absolute; top: 15px; right: 20px; color: white; font-size: 24px; cursor: pointer; letter-spacing: 2px; line-height: 1; }
        
        .class-thumbnail { width: 220px; height: 130px; background-color: white; border-radius: 12px; flex-shrink: 0; }
        
        .class-info { flex: 1; display: flex; flex-direction: column; justify-content: center; color: white; }
        .class-prodi { font-size: 14px; font-weight: 500; opacity: 0.9; margin-bottom: 4px; }
        .class-title { font-size: 20px; font-weight: 700; margin-bottom: 12px; }
        
        /* Progress & Badge */
        .class-meta { display: flex; align-items: center; gap: 15px; margin-bottom: 12px; }
        .badge-published { background-color: #334155; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .progress-wrapper { flex: 1; max-width: 300px; display: flex; flex-direction: column; gap: 4px; }
        .progress-bar-bg { width: 100%; height: 6px; background-color: rgba(255,255,255,0.3); border-radius: 4px; overflow: hidden; }
        .progress-bar-fill { height: 100%; background-color: #22c55e; border-radius: 4px; }
        .progress-text { font-size: 10px; font-weight: 500; opacity: 0.9; }

        .class-lecturer { font-size: 14px; font-weight: 500; margin-bottom: 15px; opacity: 0.95; }
        .btn-buka-kelas { background-color: #334155; color: white; text-decoration: none; padding: 8px 20px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; width: fit-content; transition: 0.2s; }
        .btn-buka-kelas:hover { background-color: #1e293b; }
    </style>
</head>
<body>

    <div class="sidebar">
        <!-- AREA LOGO & TOGGLE -->
        <div class="logo-area">
            <div class="brand-wrapper">
                <img src="{{ asset('logo-simbelwa.png') }}" alt="Logo">
                <span>SimBelWa</span>
            </div>
            <img src="{{ asset('sidebar.png') }}" class="toggle-btn" alt="Toggle Sidebar">
        </div>

        <!-- AREA PROFIL -->
        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                <img src="{{ asset('profil-simbelwa.png') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="User">
            </div>
            <div>
                <h3>{{ $mahasiswa->nama_lengkap }}</h3>
                <p>Mahasiswa<br>{{ $mahasiswa->semester_aktif ?? 'Semester Genap 2025' }}</p>
            </div>
        </div>

        <!-- MENU NAVIGASI -->
        <ul class="nav-menu">
            <!-- Ganti url('/...') dengan URL/Route yang sesuai dengan aplikasi Anda -->
            <a href="{{ url('/dashboard') }}" class="nav-item"><img src="{{ asset('dashboard.png') }}" alt="Dashboard"> Dashboard</a>
            
            <a href="{{ url('/profil') }}" class="nav-item"><img src="{{ asset('profil-mahasiswa.png') }}" alt="Profil"> Profil Mahasiswa</a>
            
            <a href="{{ url('/krs') }}" class="nav-item"><img src="{{ asset('krs-online.png') }}" alt="KRS"> KRS Online</a>
            
            <a href="{{ url('/kelas') }}" class="nav-item active"><img src="{{ asset('kelas-mahasiswa.png') }}" alt="Kelas"> Kelas Mahasiswa</a>
            
            <a href="{{ url('/jadwal-uts') }}" class="nav-item"><img src="{{ asset('jadwal-uts.png') }}" alt="Jadwal UTS"> Jadwal UTS</a>
            
            <a href="{{ url('/jadwal-uas') }}" class="nav-item"><img src="{{ asset('jadwal-uas.png') }}" alt="Jadwal UAS"> Jadwal UAS</a>
            
            <a href="{{ url('/transkrip') }}" class="nav-item"><img src="{{ asset('transkrip-nilai.png') }}" alt="Transkrip"> Transkrip Nilai</a>
            
            <a href="{{ url('/keuangan') }}" class="nav-item"><img src="{{ asset('keuangan-mahasiswa.png') }}" alt="Keuangan"> Keuangan</a>
            
            <a href="{{ url('/logout') }}" class="nav-item"><img src="{{ asset('logout.png') }}" alt="Logout"> Logout</a>
        </ul>
    </div>

    <div class="main-content">
        
        <!-- HEADER JUDUL DAN JAM REALTIME -->
        <div class="page-header-wrapper">
            <h2 class="page-title">Kelas Mahasiswa</h2>
            <div class="date-time" id="realtime-clock"></div>
        </div>

        <!-- BAR PENCARIAN & FILTER -->
        <div class="filter-bar">
            <div class="search-box">
                <span>Kelas</span>
                <input type="text" placeholder="">
                <span style="font-size: 20px; cursor: pointer;">🔍</span>
            </div>
            <div class="filter-buttons">
                <a href="#" class="filter-pill active">Aktif</a>
                <a href="#" class="filter-pill">Arsip</a>
                <div class="filter-divider"></div>
                <a href="#" class="filter-pill">Ganjil 2025</a>
                <a href="#" class="filter-pill">Genap 2025</a>
            </div>
        </div>

        <!-- DAFTAR KARTU KELAS DINAMIS DARI DATABASE -->
        <div class="class-list">
            @forelse($kelas_list as $kelas)
                @php 
                    // Membuat angka random untuk tampilan progress bar sbg contoh
                    $progress = rand(5, 45); 
                @endphp
                <div class="class-card">
                    <div class="card-options">...</div>
                    <div class="class-thumbnail"></div>
                    <div class="class-info">
                        <div class="class-prodi">{{ $mahasiswa->prodi->nama_prodi ?? 'S1 Informatika' }}</div>
                        <div class="class-title">
                            {{ $mahasiswa->semester_aktif ?? '2025 Genap' }} | {{ $kelas->courseClass->course->nama_mk }}
                        </div>
                        
                        <div class="class-meta">
                            <span class="badge-published">Published</span>
                            <div class="progress-wrapper">
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: {{ $progress }}%;"></div>
                                </div>
                                <div class="progress-text">{{ $progress }}% Complete</div>
                            </div>
                        </div>

                        <div class="class-lecturer">Dosen : {{ $kelas->courseClass->lecturer->nama_lengkap }}</div>
                        <!-- Tombol ini nanti bisa diarahkan ke halaman detail (Gambar 2) -->
                        <a href="{{ url('/kelas/' . $kelas->courseClass->id) }}" class="btn-buka-kelas">Buka Kelas &rarr;</a>
                    </div>
                </div>
            @empty
                <div style="background-color: white; padding: 40px; border-radius: 16px; text-align: center; color: #64748b; font-weight: 500;">
                    Belum ada kelas yang terdaftar pada semester ini.
                </div>
            @endforelse
        </div>

    </div>

    <!-- SCRIPT UNTUK JAM REAL-TIME -->
    <script>
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const day = String(now.getDate()).padStart(2, '0');
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const dateString = `${dayName}, ${day} ${monthName} ${year} | ${hours}.${minutes}.${seconds}`;
            
            const clockElement = document.getElementById('realtime-clock');
            if(clockElement) {
                clockElement.innerText = dateString;
            }
        }

        setInterval(updateClock, 1000);
        updateClock(); 
    </script>
</body>
</html> 