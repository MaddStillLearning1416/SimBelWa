<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR (KONSISTEN) === */
        .sidebar { width: 280px; background-color: #2b6cb0; color: white; padding: 25px 20px; display: flex; flex-direction: column; gap: 20px; flex-shrink: 0; }
        .logo-area { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding: 0 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; }
        .brand-wrapper img { width: 32px; height: 32px; object-fit: contain; }
        .toggle-btn { width: 22px; height: 22px; cursor: pointer; object-fit: contain; opacity: 0.9; transition: 0.2s; }
        
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
        .main-content { flex: 1; padding: 35px 45px; overflow-y: auto; height: 100vh; }
        
        .page-header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin: 0; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }

        /* === LAYOUT KONTEN === */
        .content-layout { display: flex; flex-direction: column; gap: 30px; }
        
        /* BAGIAN ATAS: STATISTIK & TRANSKRIP (KIRI - KANAN) */
        .top-section { display: flex; gap: 30px; align-items: flex-start; }
        
       /* KOLOM KIRI: STATISTIK */
        .left-col { flex: 3.5; background-color: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .stat-header { color: #0f172a; font-size: 16px; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; text-align: center;}
        .stat-body { display: flex; flex-direction: column; gap: 15px; }
        .stat-row { display: flex; justify-content: space-between; align-items: center; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0; font-size: 13px; color: #475569; }
        .stat-row:last-child { border-bottom: none; padding-bottom: 0; }
        .stat-val { font-weight: 800; color: #0f172a; }

        /* KOLOM KANAN: TABEL TRANSKRIP */
        .right-col { flex: 6.5; display: flex; flex-direction: column; gap: 25px; }
        .table-card { background-color: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        
        /* Filter Dropdowns */
        .filter-section { display: flex; gap: 20px; margin-bottom: 25px; }
        .filter-group { display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .filter-group label { font-size: 13px; font-weight: 700; color: #0f172a; }
        .filter-select { padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; color: #334155; outline: none; background-color: white; cursor: pointer; }
        
        .table-title { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }

        /* Desain Tabel Umum */
        .table-wrapper { overflow-x: auto; border-radius: 12px; border: 2px solid #e0e7ff; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th { background-color: #dbeafe; color: #1e3a8a; font-size: 13px; font-weight: 700; padding: 14px; border-bottom: 2px solid #bfdbfe; }
        td { padding: 14px; font-size: 13px; color: #475569; border-bottom: 1px solid #f1f5f9; font-weight: 500; }
        tr:last-child td { border-bottom: none; }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-dark { color: #0f172a; font-weight: 600; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo-area">
            <div class="brand-wrapper">
                <img src="{{ asset('logo-simbelwa.png') }}" alt="Logo">
                <span>SimBelWa</span>
            </div>
            <img src="{{ asset('sidebar.png') }}" class="toggle-btn" alt="Toggle">
        </div>

        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                <img src="{{ asset('profil-simbelwa.png') }}" style="width: 100%; height: 100%; object-fit: cover;" alt="User">
            </div>
            <div>
                <h3>{{ $mahasiswa->nama_lengkap ?? 'Ahmad Billal' }}</h3>
                <p>Mahasiswa<br>{{ $mahasiswa->semester_aktif ?? 'Semester Genap 2025' }}</p>
            </div>
        </div>

        <ul class="nav-menu">
            <!-- Ganti url('/...') dengan URL/Route yang sesuai dengan aplikasi Anda -->
            <a href="{{ url('/dashboard') }}" class="nav-item"><img src="{{ asset('dashboard.png') }}" alt="Dashboard"> Dashboard</a>
            
            <a href="{{ url('/profil') }}" class="nav-item"><img src="{{ asset('profil-mahasiswa.png') }}" alt="Profil"> Profil Mahasiswa</a>
            
            <a href="{{ url('/krs') }}" class="nav-item"><img src="{{ asset('krs-online.png') }}" alt="KRS"> KRS Online</a>
            
            <a href="{{ url('/kelas') }}" class="nav-item"><img src="{{ asset('kelas-mahasiswa.png') }}" alt="Kelas"> Kelas Mahasiswa</a>
            
            <a href="{{ url('/jadwal-uts') }}" class="nav-item"><img src="{{ asset('jadwal-uts.png') }}" alt="Jadwal UTS"> Jadwal UTS</a>
            
            <a href="{{ url('/jadwal-uas') }}" class="nav-item"><img src="{{ asset('jadwal-uas.png') }}" alt="Jadwal UAS"> Jadwal UAS</a>
            
            <a href="{{ url('/transkrip') }}" class="nav-item active"><img src="{{ asset('transkrip-nilai.png') }}" alt="Transkrip"> Transkrip Nilai</a>
            
            <a href="{{ url('/keuangan') }}" class="nav-item"><img src="{{ asset('keuangan-mahasiswa.png') }}" alt="Keuangan"> Keuangan</a>
            
            <a href="{{ url('/logout') }}" class="nav-item"><img src="{{ asset('logout.png') }}" alt="Logout"> Logout</a>
        </ul>   
    </div>

    <div class="main-content">
        
        <div class="page-header-wrapper">
            <h2 class="page-title">Transkrip Nilai Mahasiswa</h2>
            <div class="date-time" id="realtime-clock"></div>
        </div>

        <div class="content-layout">
            
            <div class="top-section">
                <div class="left-col">
                    <div class="stat-header">STATISTIK</div>
                    <div class="stat-body">
                        <div class="stat-row">
                            <span>Kurikulum</span>
                            <span class="stat-val">{{ $statistik['kurikulum'] ?? '511.2024' }}</span>
                        </div>
                        <div class="stat-row">
                            <span>SKS Lulus</span>
                            <span class="stat-val">{{ $statistik['sks_lulus'] ?? '64' }} Sks</span>
                        </div>
                        <div class="stat-row">
                            <span>Beban SKS</span>
                            <span class="stat-val">{{ $statistik['beban_sks'] ?? '144' }} Sks</span>
                        </div>
                        <div class="stat-row">
                            <span>IPK</span>
                            <span class="stat-val">{{ $statistik['ipk'] ?? '3.94' }}</span>
                        </div>
                        <div class="stat-row">
                            <span>Nilai A</span>
                            <span class="stat-val">{{ $statistik['nilai_A'] ?? 0 }}</span>
                        </div>
                        <div class="stat-row">
                            <span>Nilai B</span>
                            <span class="stat-val">{{ $statistik['nilai_B'] ?? 0 }}</span>
                        </div>
                        <div class="stat-row">
                            <span>Nilai C</span>
                            <span class="stat-val">{{ $statistik['nilai_C'] ?? 0 }}</span>
                        </div>
                        <div class="stat-row">
                            <span>Nilai D</span>
                            <span class="stat-val">{{ $statistik['nilai_D'] ?? 0 }}</span>
                        </div>
                        <div class="stat-row">
                            <span>Nilai E</span>
                            <span class="stat-val">{{ $statistik['nilai_E'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <div class="right-col">
                    <div class="table-card">
                        <div class="filter-section">
                            <div class="filter-group" style="flex: 1.5;">
                                <label>Tahun Akademik</label>
                                <select class="filter-select">
                                    <option>2025/2026</option>
                                    <option>2024/2025</option>
                                </select>
                            </div>
                            <div class="filter-group" style="flex: 2;">
                                <label>Semester</label>
                                <select class="filter-select">
                                    <option>Genap</option>
                                    <option>Ganjil</option>
                                </select>
                            </div>
                        </div>

                        <h3 class="table-title">Transkrip Nilai</h3>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th class="text-left" style="width: 15%;">KodeMK</th>
                                        <th class="text-left" style="width: 45%;">Mata Kuliah</th>
                                        <th class="text-center" style="width: 10%;">Kelas</th>
                                        <th class="text-center" style="width: 10%;">SKS</th>
                                        <th class="text-center" style="width: 15%;">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transkrip_list ?? [] as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}.</td>
                                        <td class="text-left">{{ $item->courseClass->course->kode_mk ?? '-' }}</td>
                                        <td class="text-left text-dark">{{ $item->courseClass->course->nama_mk ?? '-' }}</td>
                                        <td class="text-center">{{ $item->courseClass->nama_kelas ?? '-' }}</td>
                                        <td class="text-center">{{ $item->courseClass->course->sks ?? '-' }}</td>
                                        <td class="text-center text-dark">{{ $item->nilai_huruf ?? '-' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 20px;">Belum ada data transkrip.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-card" style="width: 100%;">
                <h3 class="table-title">Nilai Semester</h3>
                <div class="table-wrapper" style="border-color: #60a5fa;">
                    <table style="min-width: 1000px;"> <thead>
                            <tr style="background-color: #bfdbfe;">
                                <th class="text-center" style="width: 3%;">No</th>
                                <th class="text-left" style="width: 10%;">KodeMK</th>
                                <th class="text-left" style="width: 20%;">Mata Kuliah</th>
                                <th class="text-center" style="width: 5%;">Kelas</th>
                                <th class="text-center" style="width: 7%;">NA</th>
                                <th class="text-center" style="width: 5%;">Hadir</th>
                                <th class="text-center" style="width: 10%;">Partisipatif</th>
                                <th class="text-center" style="width: 10%;">Tugas Mandiri</th>
                                <th class="text-center" style="width: 12%;">Tugas Kelompok</th>
                                <th class="text-center" style="width: 8%;">UTS</th>
                                <th class="text-center" style="width: 8%;">UAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilai_semester_list ?? [] as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}.</td>
                                <td class="text-left">{{ $item->courseClass->course->kode_mk ?? '-' }}</td>
                                <td class="text-left text-dark">{{ $item->courseClass->course->nama_mk ?? '-' }}</td>
                                <td class="text-center">{{ $item->courseClass->nama_kelas ?? '-' }}</td>
                                <td class="text-center text-dark">{{ $item->nilai_angka ? number_format($item->nilai_angka, 2) : '-' }}</td>
                                <td class="text-center">{{ $item->kehadiran ?? '-' }}</td>
                                <td class="text-center">{{ $item->nilai_partisipatif ? number_format($item->nilai_partisipatif, 2) : '-' }}</td>
                                <td class="text-center">{{ $item->nilai_tugas_mandiri ? number_format($item->nilai_tugas_mandiri, 2) : '-' }}</td>
                                <td class="text-center">{{ $item->nilai_tugas_kelompok ? number_format($item->nilai_tugas_kelompok, 2) : '-' }}</td>
                                <td class="text-center">{{ $item->nilai_uts ? number_format($item->nilai_uts, 2) : '-' }}</td>
                                <td class="text-center">{{ $item->nilai_uas ? number_format($item->nilai_uas, 2) : '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center" style="padding: 20px;">Belum ada rincian nilai semester ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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