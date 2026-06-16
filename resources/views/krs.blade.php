<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRS Online - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR (Diseragamkan dengan Profil & Dashboard) === */
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
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        
        /* Header Halaman (Judul & Jam) */
        .page-header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }
        
        .content-card { background-color: white; border-radius: 20px; padding: 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        
        /* HEADER CARD KRS */
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .card-header h3 { font-size: 18px; font-weight: 800; color: #0f172a; margin: 0; }
        .button-group { display: flex; gap: 12px; }
        
        /* Tombol Cetak */
        .btn-print { background-color: #ecfdf5; color: #059669; padding: 8px 18px; border-radius: 20px; font-size: 13px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: 0.2s; border: 1px solid #a7f3d0; }
        .btn-print:hover { background-color: #d1fae5; }
        .btn-print img { width: 16px; height: 16px; object-fit: contain; }

        /* === TABEL KRS (DISEMPURNAKAN) === */
        .table-wrapper { overflow-x: auto; margin-bottom: 40px; }
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
            min-width: 800px; 
        }
        th { 
            background-color: #e0e7ff; 
            color: #1e40af; 
            font-size: 13px; 
            font-weight: 700; 
            padding: 16px; 
            border: none;
        }
        th:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        th:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        
        td { 
            padding: 16px; 
            font-size: 13px; 
            color: #475569; 
            border-bottom: 1px solid #f1f5f9; 
            font-weight: 500; 
        }
        
        /* Pewarnaan Teks Spesifik */
        .text-dark { color: #0f172a; font-weight: 600; }
        .text-gray { color: #64748b; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }

        /* === KETENTUAN KRS === */
        .rules-section h4 { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }
        .rules-list { list-style-type: disc; padding-left: 20px; display: flex; flex-direction: column; gap: 12px; }
        .rules-list li { font-size: 13px; color: #334155; font-weight: 500; line-height: 1.6; }
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
            
            <a href="{{ url('/krs') }}" class="nav-item active"><img src="{{ asset('krs-online.png') }}" alt="KRS"> KRS Online</a>
            
            <a href="{{ url('/kelas') }}" class="nav-item"><img src="{{ asset('kelas-mahasiswa.png') }}" alt="Kelas"> Kelas Mahasiswa</a>
            
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
            <h2 class="page-title">KRS Online</h2>
            <div class="date-time" id="realtime-clock"></div>
        </div>

        <div class="content-card">
            
            <div class="card-header">
                <h3>KRS {{ $mahasiswa->semester_aktif ?? 'Genap 2025/2026' }}</h3>
                
                <div class="button-group">
                    <a href="#" class="btn-print">
                        <img src="{{ asset('pdf.png') }}" alt="Print"> Cetak KST
                    </a>
                    <a href="#" class="btn-print">
                        <img src="{{ asset('pdf.png') }}" alt="Print"> Cetak KRS
                    </a>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-left" style="width: 12%;">KodeMK</th>
                            <th class="text-left" style="width: 25%;">Mata Kuliah</th>
                            <th class="text-center" style="width: 8%;">Kelas</th>
                            <th class="text-center" style="width: 5%;">SKS</th>
                            <th class="text-left" style="width: 25%;">Jadwal</th>
                            <th class="text-left" style="width: 20%;">Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($krs_list as $index => $krs)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}.</td>
                            <td class="text-left">{{ $krs->courseClass->course->kode_mk ?? 'INF124404' }}</td>
                            <td class="text-left text-dark">{{ $krs->courseClass->course->nama_mk }}</td>
                            <td class="text-center">{{ $krs->courseClass->nama_kelas ?? 'C' }}</td>
                            <td class="text-center">{{ $krs->courseClass->course->sks }}</td>
                            <td class="text-left">{{ $krs->courseClass->hari }} - {{ substr($krs->courseClass->jam_mulai, 0, 5) }}-{{ substr($krs->courseClass->jam_selesai, 0, 5) }} ({{ $krs->courseClass->ruangan }})</td>
                            <td class="text-left text-gray">{{ $krs->courseClass->lecturer->nama_lengkap }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray" style="padding: 30px; border-bottom: none;">
                                Belum ada mata kuliah yang diambil atau disetujui pada semester ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="rules-section">
                <h4>Ketentuan KRS :</h4>
                <ul class="rules-list">
                    <li>Anda tidak diperkenankan menghapus record kelas yang timbul secara otomatis pada saat mengisi krs, hal ini dikarenakan anda diwajibkan untuk mengambil matakuliah yang belum Lulus disemester sebelumnya</li>
                    <li>KRS yang sudah memiliki Nilai tidak dapat dihapus, pastikan anda mengisi KRS di Tahun Akademik yang benar, laporkan apabila ada kejanggalan Tahun Akademik yang salah</li>
                    <li>Anda hanya dapat mengisi krs pada periode pengisian sesuai dengan range waktu yang ditampilkan</li>
                    <li>Syarat Pengisian KRS, anda sudah melakukan pembayaran kewajiban mahasiswa</li>
                    <li>Tidak Ada Pengisian KRS yang dilakukan oleh Staff Akademik, KRS hanya dapat dientri Mhs pada masa Pengisian Saja</li>
                    <li>Bagi Mhs yang telat melakukan Pengisian maka Status Akademik Akan Diubah Menjadi Non Aktif</li>
                </ul>
            </div>

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
        updateClock(); // Panggil sekali saat load
    </script>
</body>
</html>