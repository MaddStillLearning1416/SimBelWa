<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR === */
        .sidebar { width: 280px; background-color: #2b6cb0; color: white; padding: 25px 20px; display: flex; flex-direction: column; gap: 20px; flex-shrink: 0; }
        
        /* LOGO AREA YANG RAPI */
        .logo-area { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding: 0 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; }
        .brand-wrapper img { width: 32px; height: 32px; object-fit: contain; }
        .toggle-btn { width: 22px; height: 22px; cursor: pointer; object-fit: contain; opacity: 0.9; transition: 0.2s; }
        .toggle-btn:hover { opacity: 1; }
        
        /* PROFIL SIDEBAR */
        .sidebar-profile { background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.1); padding: 16px; border-radius: 12px; display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .sidebar-avatar { width: 45px; height: 45px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
        .sidebar-profile h3 { font-size: 15px; font-weight: 700; margin: 0; }
        .sidebar-profile p { font-size: 11px; color: #e2e8f0; margin: 3px 0 0 0; line-height: 1.3; }

        /* Menu Navigasi */
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .nav-item { padding: 14px 18px; border-radius: 10px; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 15px; font-weight: 600; transition: 0.2s; color: white; text-decoration: none; }
        .nav-item:hover { background-color: rgba(255, 255, 255, 0.1); }
        .nav-item.active { background-color: #1e3a8a; }
        .nav-item img { width: 20px; height: 20px; object-fit: contain; }

        /* === KONTEN UTAMA === */
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        
        /* Header Profil (Judul & Jam) */
        .profile-page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }
        
        .profile-card { background-color: white; border-radius: 20px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        
        /* Bagian Atas: Avatar & Identitas */
        .profile-header { display: flex; align-items: center; gap: 35px; margin-bottom: 40px; }
        .avatar-ring { width: 140px; height: 140px; border: 4px solid #3b82f6; border-radius: 50%; padding: 6px; display: flex; justify-content: center; align-items: center; flex-shrink: 0; }
        .avatar-inner { width: 100%; height: 100%; background-color: #cbd5e1; border-radius: 50%; overflow: hidden; }
        .avatar-inner img { width: 100%; height: 100%; object-fit: cover; }
        
        .user-info h1 { font-size: 32px; font-weight: 800; margin: 0 0 8px 0; color: #0f172a; letter-spacing: -0.5px; }
        .user-info p { font-size: 15px; color: #475569; margin: 0 0 8px 0; font-weight: 500; }
        .badge-status { background-color: #1e3a8a; color: white; padding: 6px 16px; border-radius: 6px; font-size: 13px; font-weight: 700; display: inline-block; margin-top: 5px; }

        /* Bagian Bawah: Grid Info */
        .info-layout { display: grid; grid-template-columns: 1.6fr 1fr; gap: 30px; align-items: start; }
        .left-column { display: flex; flex-direction: column; gap: 20px; }
        
        .box-gray { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .box-white { background-color: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; }
        .box-white.stats-box { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .data-label { font-size: 13px; color: #64748b; margin-bottom: 6px; font-weight: 500; }
        .data-value { font-size: 16px; font-weight: 700; color: #0f172a; }

        .stat-item { display: flex; align-items: center; gap: 15px; }
        .stat-text h2 { font-size: 28px; font-weight: 800; margin: 0; color: #0f172a; }
        
        .donut-chart { width: 50px; height: 50px; border-radius: 50%; display: flex; justify-content: center; align-items: center; }
        .donut-inner { width: 34px; height: 34px; background-color: white; border-radius: 50%; }

        .progress-bar-container { width: 120px; height: 8px; background-color: #e2e8f0; border-radius: 4px; overflow: hidden; }
        .progress-bar-fill { height: 100%; background-color: #2563eb; border-radius: 4px; }

        .contact-title { font-size: 16px; font-weight: 800; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px; color: #0f172a; }
        .contact-list { display: flex; flex-direction: column; gap: 18px; }
        .contact-item { display: flex; align-items: center; gap: 15px; font-size: 14px; color: #334155; font-weight: 500; }
        .contact-icon { width: 30px; height: 30px; background-color: #f1f5f9; border-radius: 8px; display: flex; justify-content: center; align-items: center; font-size: 16px; flex-shrink: 0; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo-area">
            <div class="brand-wrapper">
                <img src="{{ asset('logo-simbelwa.png') }}" alt="Logo">
                <span>SimBelWa</span>
            </div>
            <img src="{{ asset('sidebar.png') }}" class="toggle-btn" alt="Toggle Sidebar">
        </div>

        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                <img src="{{ asset('profil-simbelwa.png') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="User">
            </div>
            <div>
                <h3>{{ $mahasiswa->nama_lengkap }}</h3>
                <p>Mahasiswa<br>{{ $mahasiswa->semester_aktif ?? 'Semester Genap 2025' }}</p>
            </div>
        </div>

        <ul class="nav-menu">
            <!-- Ganti url('/...') dengan URL/Route yang sesuai dengan aplikasi Anda -->
            <a href="{{ url('/dashboard') }}" class="nav-item"><img src="{{ asset('dashboard.png') }}" alt="Dashboard"> Dashboard</a>
            
            <a href="{{ url('/profil') }}" class="nav-item active"><img src="{{ asset('profil-mahasiswa.png') }}" alt="Profil"> Profil Mahasiswa</a>
            
            <a href="{{ url('/krs') }}" class="nav-item"><img src="{{ asset('krs-online.png') }}" alt="KRS"> KRS Online</a>
            
            <a href="{{ url('/kelas') }}" class="nav-item"><img src="{{ asset('kelas-mahasiswa.png') }}" alt="Kelas"> Kelas Mahasiswa</a>
            
            <a href="{{ url('/jadwal-uts') }}" class="nav-item"><img src="{{ asset('jadwal-uts.png') }}" alt="Jadwal UTS"> Jadwal UTS</a>
            
            <a href="{{ url('/jadwal-uas') }}" class="nav-item"><img src="{{ asset('jadwal-uas.png') }}" alt="Jadwal UAS"> Jadwal UAS</a>
            
            <a href="{{ url('/transkrip') }}" class="nav-item"><img src="{{ asset('transkrip-nilai.png') }}" alt="Transkrip"> Transkrip Nilai</a>
            
            <a href="{{ url('/keuangan') }}" class="nav-item"><img src="{{ asset('keuangan-mahasiswa.png') }}" alt="Keuangan"> Keuangan</a>
            
            <a href="{{ url('/logout') }}" class="nav-item"><img src="{{ asset('logout.png') }}" alt="Logout"> Logout</a>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="profile-page-header">
            <h2 class="page-title">Profil Mahasiswa</h2>
            <div class="date-time" id="realtime-clock"></div>
        </div>

        <div class="profile-card">
            
            <div class="profile-header">
                <div class="avatar-ring">
                    <div class="avatar-inner">
                        <img src="{{ asset('profil-simbelwa.png') }}" alt="Foto Profil">
                    </div>
                </div>
                <div class="user-info">
                    <h1>{{ $mahasiswa->nama_lengkap }}</h1>
                    <p>NIM : {{ $mahasiswa->nim }}</p>
                    <p>Tempat, Tanggal Lahir : {{ $ttl ?? 'Jakarta, 14 Mei 2006' }}</p> 
                    <div class="badge-status">Mahasiswa {{ $mahasiswa->status ?? 'Aktif' }}</div>
                </div>
            </div>

            <div class="info-layout">
                
                <div class="left-column">
                    <div class="box-gray">
                        <div>
                            <div class="data-label">Fakultas</div>
                            <div class="data-value">{{ $mahasiswa->prodi->faculty->nama_fakultas ?? 'Fakultas Ilmu Komputer' }}</div>
                        </div>
                        <div>
                            <div class="data-label">Program Studi</div>
                            <div class="data-value">{{ $mahasiswa->prodi->nama_prodi ?? 'S1 Informatika' }}</div>
                        </div>
                        <div>
                            <div class="data-label">Tahun Masuk</div>
                            <div class="data-value">{{ $mahasiswa->tahun_masuk ?? '2024' }}</div>
                        </div>
                        <div>
                            <div class="data-label">Semester</div>
                            <div class="data-value">{{ $mahasiswa->semester_aktif ?? 'Genap 2025/2026' }}</div>
                        </div>
                    </div>

                    <div class="box-white stats-box">
                        <div>
                            <div class="data-label">IPK Kumulatif</div>
                            <div class="stat-item">
                                <div class="stat-text"><h2>{{ $mahasiswa->ipk ?? '4.00' }}</h2></div>
                                
                                @php 
                                    $persenIpk = (($mahasiswa->ipk ?? 4.00) / 4.00) * 100; 
                                @endphp
                                <div class="donut-chart" style="background: conic-gradient(#2563eb 0% {{ $persenIpk }}%, #e2e8f0 {{ $persenIpk }}% 100%);">
                                    <div class="donut-inner"></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="data-label">SKS Lulus</div>
                            <div class="stat-item" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                                <div class="stat-text">
                                    <h2>{{ $mahasiswa->sks_lulus ?? '64' }} SKS</h2>
                                </div>
                                @php 
                                    $persenSks = (($mahasiswa->sks_lulus ?? 64) / 144) * 100; 
                                @endphp
                                <div class="progress-bar-container">
                                    <div class="progress-bar-fill" style="width: {{ $persenSks }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-white">
                    <div class="contact-title">Detail Kontak</div>
                    <div class="contact-list">
                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <span>{{ $mahasiswa->user->email ?? 'ahmadbillal@student.upnvj.ac.id' }}</span>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">💬</div>
                            <span>{{ $mahasiswa->telepon ?? '081234567890' }}</span>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <span>{{ $mahasiswa->alamat ?? 'Jakarta Timur' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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