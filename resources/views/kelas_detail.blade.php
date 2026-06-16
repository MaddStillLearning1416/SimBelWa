<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - SimBelWa</title>
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
        .main-content { flex: 1; padding: 35px 45px; overflow-y: auto; height: 100vh; }
        
        /* HEADER JAM */
        .page-header-wrapper { display: flex; justify-content: flex-end; margin-bottom: 15px; }
        .date-time { font-size: 14px; font-weight: 700; color: #1e293b; }
        
        /* === BANNER HEADER === */
        .course-banner { background: linear-gradient(135deg, #2b6cb0 0%, #5b21b6 100%); border-radius: 20px; padding: 35px; color: white; margin-bottom: 30px; box-shadow: 0 10px 25px rgba(43, 108, 176, 0.2); }
        .course-meta { font-size: 14px; font-weight: 600; opacity: 0.9; margin-bottom: 8px; letter-spacing: 0.5px; }
        .course-title { font-size: 42px; font-weight: 800; margin: 0 0 15px 0; letter-spacing: -1px; text-transform: uppercase; }
        .course-info { display: flex; gap: 30px; font-size: 15px; font-weight: 500; opacity: 0.95; align-items: center; }
        .course-info span { display: flex; align-items: center; gap: 8px; }

        /* === LAYOUT 2 KOLOM (70% - 30%) === */
        .content-layout { display: flex; gap: 30px; align-items: flex-start; }
        
        /* FIX: Menambahkan flex-direction column agar lurus ke bawah */
        .left-col { flex: 7; background-color: white; border-radius: 20px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 15px; }
        .right-col { flex: 3; display: flex; flex-direction: column; gap: 20px; }

        .section-title { font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 5px; }

        /* === ACCORDION KEGIATAN PERKULIAHAN === */
        .accordion-item { width: 100%; }
        details { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; width: 100%; }
        details[open] { border-color: #cbd5e1; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        
        summary { padding: 18px 20px; font-size: 14px; font-weight: 700; color: #1e293b; cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; background-color: #e2e8f0; transition: background-color 0.2s; }
        summary::-webkit-details-marker { display: none; } 
        summary::after { content: "▼"; font-size: 12px; color: #64748b; transition: transform 0.2s; }
        details[open] summary { background-color: #cbd5e1; }
        details[open] summary::after { transform: rotate(180deg); }

        .details-content { padding: 0; background-color: white; }
        
        /* List Item dalam Accordion */
        .activity-item { display: flex; align-items: flex-start; gap: 15px; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; transition: 0.2s; cursor: pointer; }
        .activity-item:hover { background-color: #f8fafc; }
        .activity-item:last-child { border-bottom: none; }
        
        .activity-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; justify-content: center; align-items: center; font-size: 18px; flex-shrink: 0; }
        .icon-blue { background-color: #dbeafe; color: #2563eb; }
        .icon-green { background-color: #dcfce7; color: #16a34a; }
        .icon-red { background-color: #fee2e2; color: #dc2626; }
        .icon-yellow { background-color: #fef3c7; color: #d97706; }
        
        .activity-text h4 { font-size: 14px; font-weight: 600; color: #0f172a; margin: 0 0 4px 0; }
        .activity-text p { font-size: 11px; color: #64748b; margin: 0; }

        /* === GAMIFIKASI LEVEL UP === */
        .widget-card { background-color: white; border-radius: 20px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        
        .level-circle-container { display: flex; justify-content: center; margin: 15px 0; }
        .level-circle { width: 120px; height: 120px; border-radius: 50%; background: conic-gradient(#1e3a8a 0% 15%, #e2e8f0 15% 100%); display: flex; justify-content: center; align-items: center; padding: 10px; }
        .level-inner { width: 100%; height: 100%; background-color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 32px; font-weight: 800; color: #0f172a; flex-direction: column; }
        .level-inner span { font-size: 12px; color: #64748b; font-weight: 600; margin-top: -5px; }

        .xp-bar-container { margin-top: 15px; }
        .xp-bar-bg { width: 100%; height: 8px; background-color: #e2e8f0; border-radius: 4px; overflow: hidden; margin-bottom: 8px; }
        .xp-bar-fill { width: 15%; height: 100%; background-color: #1e3a8a; border-radius: 4px; }
        .xp-text { display: flex; justify-content: space-between; font-size: 11px; font-weight: 600; color: #475569; }

        .tips-box { background-color: #eff6ff; border: 1px dashed #bfdbfe; padding: 12px; border-radius: 8px; font-size: 11px; color: #1e40af; font-weight: 500; text-align: center; margin-top: 15px; }

        /* === TUGAS MENDATANG === */
        .task-list { display: flex; flex-direction: column; gap: 12px; margin-top: 15px; }
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
                <h3>{{ $mahasiswa->nama_lengkap ?? 'Ahmad Billal' }}</h3>
                <p>Mahasiswa<br>{{ $mahasiswa->semester_aktif ?? 'Semester Genap 2025' }}</p>
            </div>
        </div>

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
        
        <div class="page-header-wrapper">
            <div class="date-time" id="realtime-clock"></div>
        </div>

        <!-- BANNER HEADER (DINAMIS DARI DATABASE) -->
        <div class="course-banner">
            <div class="course-meta">
                {{ $mahasiswa->semester_aktif ?? 'Genap 2025/2026' }} | {{ $mahasiswa->prodi->nama_prodi ?? 'S1 Informatika' }}
            </div>
            <h1 class="course-title">
                {{ $detail_kelas->course->nama_mk ?? 'NAMA MATA KULIAH' }}
            </h1>
            <div class="course-info">
                <span>
                    <!-- Menggunakan ikon dosen.png -->
                    <img src="{{ asset('dosen.png') }}" alt="Dosen" style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1);"> 
                    {{ $detail_kelas->lecturer->nama_lengkap ?? 'Nama Dosen' }}
                </span>
                <span>
                    <!-- Menggunakan ikon jam.png -->
                    <img src="{{ asset('jam.png') }}" alt="Jam" style="width: 16px; height: 16px; object-fit: contain; filter: brightness(0) invert(1);"> 
                    {{ $detail_kelas->hari ?? 'Hari' }}, {{ substr($detail_kelas->jam_mulai ?? '00:00', 0, 5) }} - {{ substr($detail_kelas->jam_selesai ?? '00:00', 0, 5) }}
                </span>
            </div>
        </div>

        <div class="content-layout">
            
            <div class="left-col">
                <h2 class="section-title">Kegiatan Perkuliahan</h2>
                
                <div class="accordion-item">
                    <details>
                        <summary>General</summary>
                        <div class="details-content" style="padding: 15px 20px; font-size: 13px; color: #475569;">
                            Ruang diskusi umum dan pengumuman dari dosen.
                        </div>
                    </details>
                </div>

                <!-- LOOPING PERTEMUAN DARI DATABASE -->
                @if(isset($detail_kelas->meetings) && $detail_kelas->meetings->count() > 0)
                    
                    @foreach($detail_kelas->meetings as $pertemuan)
                    <div class="accordion-item">
                        <details {{ $loop->first ? 'open' : '' }}>
                            <summary>Pertemuan {{ $pertemuan->pertemuan_ke }} ({{ $pertemuan->metode ?? 'Offline' }}) - {{ $pertemuan->judul_pertemuan }}</summary>
                            <div class="details-content">
                                
                                @foreach($pertemuan->materials as $materi)
                                <div class="activity-item">
                                    <div class="activity-icon icon-blue">
                                        <img src="{{ asset('materi.png') }}" alt="Materi" style="width: 20px; height: 20px; object-fit: contain;">
                                    </div>  
                                    <div class="activity-text">
                                        <h4>Materi - {{ $materi->judul_materi }}</h4>
                                        <p>{{ $materi->tipe_file ?? 'Dokumen PDF' }} • {{ $materi->ukuran_file ?? '-' }}</p>
                                    </div>
                                </div>
                                @endforeach

                                @foreach($pertemuan->forums as $forum)
                                <div class="activity-item">
                                    <div class="activity-icon icon-green">
                                        <img src="{{ asset('forum.png') }}" alt="Forum" style="width: 20px; height: 20px; object-fit: contain;">
                                    </div>
                                    <div class="activity-text">
                                        <h4>Forum Diskusi: {{ $forum->topik }}</h4>
                                        <p>Deadline: {{ \Carbon\Carbon::parse($forum->tenggat_waktu)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                @endforeach

                                @foreach($pertemuan->quizzes as $kuis)
                                <div class="activity-item">
                                    <div class="activity-icon icon-red">
                                        <img src="{{ asset('kuis.png') }}" alt="Kuis" style="width: 20px; height: 20px; object-fit: contain;">
                                    </div>
                                    <div class="activity-text">
                                        <h4>{{ $kuis->judul_kuis }}</h4>
                                        <p>Waktu: {{ $kuis->durasi_menit }} Menit • Jumlah Soal: {{ $kuis->jumlah_soal }}</p>
                                    </div>
                                </div>
                                @endforeach

                                @foreach($pertemuan->assignments as $tugas)
                                <div class="activity-item">
                                    <div class="activity-icon icon-yellow">
                                        <img src="{{ asset('tugas4.png') }}" alt="Tugas" style="width: 20px; height: 20px; object-fit: contain;">
                                    </div>
                                    <div class="activity-text">
                                        <h4>{{ $tugas->judul_tugas }}</h4>
                                        <p>Deadline: {{ \Carbon\Carbon::parse($tugas->tenggat_waktu)->translatedFormat('d F Y') }} • {{ $tugas->sifat_tugas ?? 'Wajib Dikerjakan' }}</p>
                                    </div>
                                </div>
                                @endforeach

                                @if($pertemuan->materials->isEmpty() && $pertemuan->forums->isEmpty() && $pertemuan->quizzes->isEmpty() && $pertemuan->assignments->isEmpty())
                                    <div style="padding: 15px 20px; font-size: 12px; color: #64748b; text-align: center;">
                                        Belum ada kegiatan/materi yang dipublikasikan pada pertemuan ini.
                                    </div>
                                @endif

                            </div>
                        </details>
                    </div>
                    @endforeach

                @else
                    <!-- TAMPILAN JIKA DATABASE MASIH KOSONG -->
                    <div style="background-color: #f8fafc; padding: 40px; text-align: center; border-radius: 12px; color: #64748b; border: 2px dashed #cbd5e1; margin-top: 10px;">
                        <span style="font-size: 30px; display: block; margin-bottom: 10px;">📭</span>
                        <h4 style="color: #0f172a; margin-bottom: 5px;">Belum Ada Pertemuan</h4>
                        Dosen belum membuat Rencana Pembelajaran (Pertemuan) untuk kelas ini di database.
                    </div>
                @endif

            </div>

            <div class="right-col">
                
                <div class="widget-card">
                    <h2 class="section-title">Level Up!</h2>
                    
                    <div class="level-circle-container">
                        <div class="level-circle">
                            <div class="level-inner">
                                ⭐1
                                <span>0 XP</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="xp-bar-container">
                        <div class="xp-bar-bg">
                            <div class="xp-bar-fill"></div>
                        </div>
                        <div class="xp-text">
                            <span>15% Complete</span>
                            <span>120 XP to go</span>
                        </div>
                    </div>

                    <div class="tips-box">
                        💡 Tips : Berpartisipasi penuh dalam setiap pertemuan
                    </div>
                </div>

               <div class="widget-card">
                    <h2 class="section-title" style="display: flex; align-items: center; gap: 8px;">
                        <img src="{{ asset('jam.png') }}" alt="Jam" style="width: 20px; height: 20px; object-fit: contain;">
                        Tugas Mendatang
                    </h2>
                    
                    <div class="task-list">
                        @if(isset($tugas_mendatang) && $tugas_mendatang->count() > 0)
                            @foreach($tugas_mendatang as $tugas_aktif)
                                <div class="activity-item" style="padding: 0; border: none;">
                                    <!-- Jika ingin mendeteksi Kuis vs Tugas, bisa menggunakan percabangan. Ini contoh menggunakan icon tugas -->
                                    <div class="activity-icon icon-yellow" style="width: 32px; height: 32px;">
                                        <img src="{{ asset('tugas4.png') }}" alt="Tugas" style="width: 16px; height: 16px; object-fit: contain;">
                                    </div>
                                    <div class="activity-text">
                                        <h4 style="font-size: 13px;">{{ $tugas_aktif->judul_tugas }}</h4>
                                        <p style="font-size: 10px;">Deadline: {{ \Carbon\Carbon::parse($tugas_aktif->tenggat_waktu)->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="font-size: 12px; color: #64748b; text-align: center; padding: 15px 0;">
                                Tidak ada tugas mendatang.<br>Santai dulu! 🎉
                            </div>
                        @endif
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