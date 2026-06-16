<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR === */
        .sidebar { width: 280px; background-color: #2b6cb0; color: white; padding: 25px 20px; display: flex; flex-direction: column; gap: 20px; flex-shrink: 0; }
        
        /* LOGO AREA TRANSMEDIAL & TOGGLE BUTTON */
        .logo-area { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding: 0 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; }
        .brand-wrapper img { width: 32px; height: 32px; object-fit: contain; }
        .toggle-btn { width: 22px; height: 22px; cursor: pointer; object-fit: contain; opacity: 0.9; transition: 0.2s; }
        .toggle-btn:hover { opacity: 1; }
        
        /* SIDEBAR PROFILE */
        .sidebar-profile { background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.1); padding: 16px; border-radius: 12px; display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .sidebar-avatar { width: 45px; height: 45px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
        .sidebar-profile h3 { font-size: 15px; font-weight: 700; margin: 0; }
        .sidebar-profile p { font-size: 11px; color: #e2e8f0; margin: 3px 0 0 0; line-height: 1.3; }
        
        /* NAV MENU */
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .nav-item { padding: 14px 18px; border-radius: 10px; font-size: 15px; cursor: pointer; display: flex; align-items: center; gap: 15px; font-weight: 600; transition: 0.2s; color: #f8fafc; text-decoration: none; }
        .nav-item:hover { background-color: rgba(255, 255, 255, 0.1); }
        .nav-item.active { background-color: #1e3a8a; color: white; }
        .nav-item img { width: 20px; height: 20px; object-fit: contain; }

        /* === MAIN CONTENT AREA === */
        .main-content { flex: 1; padding: 35px 45px; overflow-y: auto; height: 100vh; }
        
        /* STRUKTUR LAYOUT 2 KOLOM UTAMA */
        .main-layout { display: flex; gap: 30px; }
        .left-column { flex: 7; display: flex; flex-direction: column; gap: 20px; }
        .right-column { flex: 3; display: flex; flex-direction: column; gap: 20px; }
        
        /* HEADER UTAMA KIRI & KANAN */
        .dashboard-header { display: flex; align-items: center; height: 40px; margin-bottom: 5px; }
        .greeting { display: flex; align-items: center; gap: 12px; font-size: 32px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; }
        
        .right-header { display: flex; justify-content: flex-end; align-items: center; height: 40px; margin-bottom: 5px; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }

        /* === STATS WIDGETS (3x2) === */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .stat-card { border-radius: 16px; padding: 22px; color: white; display: flex; flex-direction: column; justify-content: space-between; min-height: 130px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative; overflow: hidden; }
        
        .stat-icon { margin-bottom: 15px; background: rgba(255,255,255,0.2); width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 12px; padding: 8px; }
        .stat-icon img { width: 100%; height: 100%; object-fit: contain; }
        
        .stat-title { font-size: 14px; font-weight: 500; opacity: 0.95; margin-bottom: 6px; }
        .stat-value { font-size: 24px; font-weight: 800; }
        .stat-value span { font-size: 14px; font-weight: 500; opacity: 0.8; }
        
        /* STATS BACKGROUND */
        .bg-blue { background-color: #0284c7; }
        .bg-green { background-color: #10b981; }
        .bg-orange { background-color: #f59e0b; }
        .bg-purple { background-color: #8b5cf6; }
        .bg-navy { background-color: #1e40af; }
        .bg-red { background-color: #ef4444; }

        /* === GRID SUB-KONTEN KIRI (Kelas & Tugas) === */
        .content-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; align-items: start; }
        
        .widget-panel { background-color: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .widget-header { display: flex; align-items: center; font-size: 16px; font-weight: 800; margin-bottom: 5px; color: #0f172a; }
        .widget-subheader { font-size: 13px; color: #64748b; margin-bottom: 5px; font-weight: 500; }
        .widget-date { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }

        /* KARTU KELAS HARI INI */
        .kelas-card { border: 2px solid #bfdbfe; border-radius: 16px; padding: 18px; margin-bottom: 15px; display: flex; gap: 15px; background-color: #f8fafc; align-items: center; }
        .kelas-icon { width: 36px; height: 36px; display: flex; justify-content: center; align-items: center; }
        .kelas-icon img { width: 100%; height: 100%; object-fit: contain; }
        .kelas-info h4 { margin: 0 0 6px 0; color: #1e40af; font-size: 16px; font-weight: 700; }
        .kelas-detail { font-size: 12px; color: #475569; display: flex; align-items: center; gap: 6px; margin-bottom: 4px; font-weight: 500; }

        /* KARTU PENGUMUMAN KANAN */
        .pengumuman-card { border: 2px solid #bfdbfe; border-radius: 16px; padding: 18px; margin-bottom: 15px; background-color: white; }
        .pengumuman-card h4 { margin: 0 0 8px 0; color: #1e40af; font-size: 15px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .pengumuman-card p { margin: 0 0 15px 0; font-size: 11px; color: #475569; font-weight: 500; line-height: 1.4; }
        .pengumuman-btn { display: block; width: 100%; text-align: center; background-color: #1e40af; color: white; text-decoration: none; padding: 8px 0; border-radius: 8px; font-size: 13px; font-weight: 600; }
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
            <a href="{{ url('/dashboard') }}" class="nav-item active"><img src="{{ asset('dashboard.png') }}" alt="Dashboard"> Dashboard</a>
            
            <a href="{{ url('/profil') }}" class="nav-item"><img src="{{ asset('profil-mahasiswa.png') }}" alt="Profil"> Profil Mahasiswa</a>
            
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
        <div class="main-layout">
            
            <div class="left-column">
                
                <div class="dashboard-header">
                    <div class="greeting">
                        <img src="{{ asset('judul.png') }}" style="width: 38px; height: 38px; object-fit: contain;" alt="Toga">
                        {{ $salam }}, {{ strtok($mahasiswa->nama_lengkap, " ") }} 
                        <img src="{{ asset('wave.png') }}" style="width: 38px; height: 38px; object-fit: contain;" alt="Wave">
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card bg-blue">
                        <div class="stat-icon"><img src="{{ asset('pesan.png') }}" alt="Pesan"></div>
                        <div>
                            <div class="stat-title">Konsultasi Mahasiswa</div>
                            <div class="stat-value">0 <span>Pesan</span></div>
                        </div>
                    </div>
                    <div class="stat-card bg-green">
                        <div class="stat-icon"><img src="{{ asset('sks-program.png') }}" alt="SKS Program"></div>
                        <div>
                            <div class="stat-title">SKS Program</div>
                            <div class="stat-value">{{ $sks_semester }} <span>SKS</span></div>
                        </div>
                    </div>
                    <div class="stat-card bg-orange">
                        <div class="stat-icon"><img src="{{ asset('sks-tempuh.png') }}" alt="SKS Tempuh"></div>
                        <div>
                            <div class="stat-title">SKS Tempuh</div>
                            <div class="stat-value">{{ $mahasiswa->sks_lulus ?? 0 }} / 144 <span>SKS</span></div>
                        </div>
                    </div>
                    <div class="stat-card bg-purple">
                        <div class="stat-icon"><img src="{{ asset('ipk.png') }}" alt="IPK"></div>
                        <div>
                            <div class="stat-title">IPK</div>
                            <div class="stat-value">{{ $mahasiswa->ipk ?? '0.00' }} / 4.00</div>
                        </div>
                    </div>
                    <div class="stat-card bg-navy">
                        <div class="stat-icon"><img src="{{ asset('tugas.png') }}" alt="Tugas"></div>
                        <div>
                            <div class="stat-title">Tugas Mata Kuliah</div>
                            <div class="stat-value">10 <span>Tugas</span></div>
                        </div>
                    </div>
                    <div class="stat-card bg-red">
                        <div class="stat-icon"><img src="{{ asset('keuangan.png') }}" alt="Keuangan"></div>
                        <div>
                            <div class="stat-title">Keuangan Aktif</div>
                            <div class="stat-value">Rp. 0</div>
                        </div>
                    </div>
                </div>

                <div class="content-grid">
                    
                    <div class="widget-panel">
                        <div class="widget-header">
                            <img src="{{ asset('kelas-hari-ini.png') }}" alt="Guru" style="width: 24px; height: 24px; margin-right: 8px; object-fit: contain;"> 
                            Kelas Hari Ini
                        </div>
                        <div class="widget-subheader">Jadwal Kuliah Hari Ini</div>
                        <div class="widget-date">{{ ucfirst($namaHariIni) }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                        
                        @forelse($kelas_hari_ini as $krs)
                            <div class="kelas-card">
                                <div class="kelas-icon">
                                    <img src="{{ asset('buku.png') }}" alt="Buku" style="width: 32px; height: 32px; object-fit: contain;">
                                </div>
                                <div class="kelas-info">
                                    <h4>{{ $krs->courseClass->course->nama_mk }}</h4>
                                    <div class="kelas-detail">
                                        <img src="{{ asset('jam.png') }}" alt="Jam" style="width: 14px; height: 14px;"> 
                                        Waktu: {{ substr($krs->courseClass->jam_mulai, 0, 5) }} - {{ substr($krs->courseClass->jam_selesai, 0, 5) }} 
                                        <span style="margin: 0 5px;">|</span> 
                                        <img src="{{ asset('lokasi.png') }}" alt="Lokasi" style="width: 14px; height: 14px;"> 
                                        {{ $krs->courseClass->ruangan }}
                                    </div>
                                    <div class="kelas-detail" style="margin-top: 4px;">
                                        <img src="{{ asset('dosen.png') }}" alt="Dosen" style="width: 14px; height: 14px;"> 
                                        {{ $krs->courseClass->lecturer->nama_lengkap }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; color: #64748b; padding: 20px; border: 2px dashed #bfdbfe; border-radius: 16px;">
                                Tidak ada jadwal kuliah hari ini. 🎉
                            </div>
                        @endforelse
                    </div>

                    <div class="widget-panel">
                        <div class="widget-header">
                            <img src="{{ asset('tugas3.png') }}" alt="Clipboard" style="width: 24px; height: 24px; margin-right: 8px; object-fit: contain;"> 
                            Timeline Tugas
                        </div>
                        
                        @php
                            $grouped_tasks = $tugas_mahasiswa->groupBy(function($task) {
                                return \Carbon\Carbon::parse($task->tenggat_waktu)->translatedFormat('l, d F Y');
                            });
                        @endphp

                        @forelse($grouped_tasks as $tanggal => $tugas_group)
                            <div class="widget-date" style="margin-top: 15px; margin-bottom: 10px; font-size: 18px;">
                                {{ $tanggal }}
                            </div>
                            
                            <div style="background-color: #2b6cb0; padding: 20px; border-radius: 20px; margin-bottom: 15px;">
                                @foreach($tugas_group as $tugas)
                                    <div style="background-color: white; border-radius: 12px; padding: 16px; margin-bottom: {{ $loop->last ? '0' : '15px' }};">
                                        <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px;">
                                            <img src="{{ asset('tugas2.png') }}" alt="Dokumen" style="width: 20px; height: 20px; object-fit: contain; margin-top: 2px;"> 
                                            <div>
                                                <h4 style="margin: 0; color: #2b6cb0; font-size: 15px; font-weight: 700;">{{ $tugas->judul }}</h4>
                                                <p style="margin: 4px 0 0 0; font-size: 11px; color: #475569;">
                                                    {{ $mahasiswa->semester_aktif ?? 'Semester Berjalan' }} | {{ $tugas->courseClass->course->nama_mk }}
                                                </p>
                                            </div>
                                        </div>
                                        <div style="height: 1px; background-color: #e2e8f0; margin-bottom: 10px;"></div>
                                        <p style="margin: 0 0 15px 0; font-size: 11px; color: #334155;">
                                            Tenggat Waktu : <strong style="color: #b45309;">{{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->translatedFormat('d F Y | H:i') }}</strong>
                                        </p>
                                        <a href="#" style="display: block; width: 100%; text-align: center; background-color: #2b6cb0; color: white; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 600;">Lihat Tugas &rarr;</a>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="widget-date" style="margin-top: 15px; margin-bottom: 10px; font-size: 18px;">
                                {{ ucfirst($namaHariIni) }}, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                            </div>
                            <div style="background-color: #2b6cb0; padding: 20px; border-radius: 20px;">
                                <div style="background-color: white; border-radius: 12px; padding: 20px; text-align: center; color: #64748b; font-size: 14px; font-weight: 500;">
                                    Belum ada tugas saat ini. Selamat bersantai! 🎉
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

            <div class="right-column">
                
                <div class="right-header">
                    <div class="date-time" id="realtime-clock"></div>
                </div>

                <div class="widget-panel">
                    <div class="widget-header" style="margin-bottom: 15px;">
                        <img src="{{ asset('pusat-informasi.png') }}" alt="Toa" style="width: 24px; height: 24px; margin-right: 8px; object-fit: contain;"> 
                        Pusat Informasi & Beasiswa
                    </div>
                    
                    <div style="background-color: #2b6cb0; padding: 20px; border-radius: 20px;">
                        <div style="background-color: white; border-radius: 12px; padding: 16px; margin-bottom: 15px;">
                            <h4 style="margin: 0 0 10px 0; color: #2b6cb0; font-size: 15px; font-weight: 700; display: flex; align-items: flex-start; gap: 10px;">
                                <img src="{{ asset('beasiswa1.png') }}" alt="Toga" style="width: 20px; height: 20px; object-fit: contain; margin-top: 2px;"> 
                                <span>Beasiswa Unggulan<br>PPA 2026/2027</span>
                            </h4>
                            <div style="height: 1px; background-color: #e2e8f0; margin-bottom: 10px;"></div>
                            <p style="margin: 0 0 15px 0; font-size: 11px; color: #334155;">Tenggat : <strong>15 Juli 2026</strong> | Kuota Terbatas</p>
                            <a href="#" style="display: block; width: 100%; text-align: center; background-color: #2b6cb0; color: white; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 600;">Detail Beasiswa &rarr;</a>
                        </div>

                        <div style="background-color: white; border-radius: 12px; padding: 16px; margin-bottom: 15px;">
                            <h4 style="margin: 0 0 10px 0; color: #2b6cb0; font-size: 15px; font-weight: 700; display: flex; align-items: flex-start; gap: 10px;">
                                <img src="{{ asset('beasiswa1.png') }}" alt="Toga" style="width: 20px; height: 20px; object-fit: contain; margin-top: 2px;"> 
                                <span>Beasiswa Industri<br>'Global Tech'</span>
                            </h4>
                            <div style="height: 1px; background-color: #e2e8f0; margin-bottom: 10px;"></div>
                            <p style="margin: 0 0 15px 0; font-size: 11px; color: #334155;">Tenggat : <strong>10 Juli 2026</strong> | Kuota Terbatas</p>
                            <a href="#" style="display: block; width: 100%; text-align: center; background-color: #2b6cb0; color: white; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 600;">Detail Beasiswa &rarr;</a>
                        </div>

                        <div style="background-color: white; border-radius: 12px; padding: 16px; margin-bottom: 15px;">
                            <h4 style="margin: 0 0 10px 0; color: #2b6cb0; font-size: 15px; font-weight: 700; display: flex; align-items: flex-start; gap: 10px;">
                                <img src="{{ asset('sosialisasi.png') }}" alt="Pin" style="width: 20px; height: 20px; object-fit: contain; margin-top: 2px;"> 
                                <span>Sosialisasi PKM 2026</span>
                            </h4>
                            <div style="height: 1px; background-color: #e2e8f0; margin-bottom: 10px;"></div>
                            <p style="margin: 0 0 15px 0; font-size: 11px; color: #334155;">Tenggat : <strong>20 Juni 2026</strong> | Auditorium BTI</p>
                            <a href="#" style="display: block; width: 100%; text-align: center; background-color: #2b6cb0; color: white; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 600;">Registrasi &rarr;</a>
                        </div>

                        <div style="background-color: white; border-radius: 12px; padding: 16px; margin-bottom: 0;">
                            <h4 style="margin: 0 0 10px 0; color: #2b6cb0; font-size: 15px; font-weight: 700; display: flex; align-items: flex-start; gap: 10px;">
                                <img src="{{ asset('beasiswa1.png') }}" alt="Toga" style="width: 20px; height: 20px; object-fit: contain; margin-top: 2px;"> 
                                <span>Seminar Karir &<br>Lulusan Sukses</span>
                            </h4>
                            <div style="height: 1px; background-color: #e2e8f0; margin-bottom: 10px;"></div>
                            <p style="margin: 0 0 15px 0; font-size: 11px; color: #334155;">Tenggat : <strong>12 Juni 2026</strong> | Zoom Online</p>
                            <a href="#" style="display: block; width: 100%; text-align: center; background-color: #2b6cb0; color: white; text-decoration: none; padding: 10px 0; border-radius: 8px; font-size: 13px; font-weight: 600;">Registrasi &rarr;</a>
                        </div>
                    </div>
                </div>

                <div class="widget-panel">
                    <div class="widget-header" style="margin-bottom: 15px;">
                        <img src="{{ asset('pengumuman-kampus.png') }}" alt="Toa" style="width: 24px; height: 24px; margin-right: 8px; object-fit: contain;"> 
                        Pengumuman Kampus & Akademik
                    </div>
                    
                    <div class="pengumuman-card">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            <img src="{{ asset('jadwal.png') }}" alt="Kalender" style="width: 18px; height: 18px; object-fit: contain;"> 
                            Jadwal Ujian Akhir Semester Genap
                        </h4>
                        <p>Pelaksanaan : 20 Juni - 3 Juli 2026</p>
                        <a href="#" class="pengumuman-btn">Lihat Jadwal →</a>
                    </div>

                    <div class="pengumuman-card">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            <img src="{{ asset('jadwal.png') }}" alt="Kalender" style="width: 18px; height: 18px; object-fit: contain;"> 
                            Pameran Diseminasi Poster PKM 2026
                        </h4>
                        <p>Lokasi : Gedung Rektorat, 23 Juli 2026</p>
                        <a href="#" class="pengumuman-btn">Informasi →</a>
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