<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal UAS - SimBelWa</title>
    <style>
        /* === RESET & GOOGLE FONTS === */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #dbeafe; display: flex; color: #1e293b; min-height: 100vh; }
        
        /* === SIDEBAR === */
        .sidebar { width: 280px; background-color: #2b6cb0; color: white; padding: 25px 20px; display: flex; flex-direction: column; gap: 20px; flex-shrink: 0; }
        .logo-area { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding: 0 5px; }
        .brand-wrapper { display: flex; align-items: center; gap: 12px; font-size: 24px; font-weight: 800; }
        .brand-wrapper img { width: 32px; height: 32px; object-fit: contain; }
        .toggle-btn { width: 22px; height: 22px; cursor: pointer; opacity: 0.9; transition: 0.2s; }
        
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
        .page-title { font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 25px; }

        /* === KARTU JADWAL === */
        .content-card { background-color: white; border-radius: 20px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .academic-year { font-size: 16px; font-weight: 800; color: #0f172a; }
        .btn-print { background-color: #dcfce7; color: #166534; padding: 10px 18px; border-radius: 8px; font-weight: 700; font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 8px; border: 1px solid #bbf7d0; transition: 0.2s; }
        .btn-print:hover { background-color: #bbf7d0; }

        /* Tabel Jadwal */
        .table-wrapper { overflow-x: auto; border-radius: 12px; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        th { background-color: #dbeafe; color: #1e3a8a; font-size: 13px; font-weight: 700; padding: 15px; border-bottom: 2px solid #bfdbfe; }
        td { padding: 15px; font-size: 13px; color: #475569; border-bottom: 1px solid #f1f5f9; font-weight: 500; }
        tr:last-child td { border-bottom: none; }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-dark { color: #0f172a; font-weight: 600; }
        
        /* Badge Persentase Absen */
        .badge-absen { padding: 4px 8px; border-radius: 6px; font-weight: 700; font-size: 12px; }
        .badge-aman { background-color: #dcfce7; color: #166534; }
        .badge-bahaya { background-color: #fee2e2; color: #991b1b; }

        /* === KETENTUAN UAS === */
        .rules-section { margin-top: 35px; }
        .rules-title { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }
        .rules-list { font-size: 13px; color: #475569; line-height: 1.8; padding-left: 20px; font-weight: 500; }
        .rules-list li { margin-bottom: 8px; }
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
            
            <a href="{{ url('/jadwal-uas') }}" class="nav-item active"><img src="{{ asset('jadwal-uas.png') }}" alt="Jadwal UAS"> Jadwal UAS</a>
            
            <a href="{{ url('/transkrip') }}" class="nav-item"><img src="{{ asset('transkrip-nilai.png') }}" alt="Transkrip"> Transkrip Nilai</a>
            
            <a href="{{ url('/keuangan') }}" class="nav-item"><img src="{{ asset('keuangan-mahasiswa.png') }}" alt="Keuangan"> Keuangan</a>
            
            <a href="{{ url('/logout') }}" class="nav-item"><img src="{{ asset('logout.png') }}" alt="Logout"> Logout</a>
        </ul>
    </div>

    <div class="main-content">
        <h2 class="page-title">Jadwal Ujian Akhir Semester</h2>

        <div class="content-card">
            
             <div class="card-header">
                <div class="academic-year">Tahun Akademik {{ $mahasiswa->semester_aktif ?? '2025/2026 Genap' }}</div>
                <a href="#" class="btn-print">
                    <img src="{{ asset('pdf.png') }}" alt="Print"> Cetak KPU UAS
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th class="text-left" style="width: 10%;">KodeMK</th>
                            <th class="text-left" style="width: 25%;">Mata Kuliah</th>
                            <th class="text-center" style="width: 5%;">Kelas</th>
                            <th class="text-center" style="width: 5%;">SKS</th>
                            <th class="text-center" style="width: 10%;">Absen</th>
                            <th class="text-center" style="width: 20%;">Waktu Ujian</th>
                            <th class="text-center" style="width: 10%;">Ruang</th>
                            <th class="text-center" style="width: 10%;">No. Duduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal_uas ?? [] as $index => $item)
                        
                        @php
                            $total_pertemuan = 14;
                            $kehadiran = $item->kehadiran ?? 0;
                            $persentase = ($kehadiran / $total_pertemuan) * 100;
                            $badge_class = $persentase >= 75 ? 'badge-aman' : 'badge-bahaya';
                        @endphp

                        <tr>
                            <td class="text-center">{{ $index + 1 }}.</td>
                            <td class="text-left">{{ $item->courseClass->course->kode_mk ?? '-' }}</td>
                            <td class="text-left text-dark">{{ $item->courseClass->course->nama_mk ?? '-' }}</td>
                            <td class="text-center">{{ $item->courseClass->nama_kelas ?? '-' }}</td>
                            <td class="text-center">{{ $item->courseClass->course->sks ?? '-' }}</td>
                            
                            <td class="text-center">
                                <span class="badge-absen {{ $badge_class }}">
                                    {{ number_format($persentase, 0) }}%
                                </span>
                            </td>

                            <td class="text-center">{{ $item->waktu_uas ?? '-' }}</td>
                            <td class="text-center">{{ $item->ruang_uas ?? '-' }}</td>
                            <td class="text-center">{{ $item->no_duduk_uas ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center" style="padding: 20px;">Belum ada jadwal UAS.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="rules-section">
                <div class="rules-title">Ketentuan UAS :</div>
                <ul class="rules-list">
                    <li>Mahasiswa wajib memenuhi syarat kehadiran minimal 14 kali pertemuan (tatap muka maupun daring) untuk setiap mata kuliah yang diujikan. Jika kurang dari ketentuan tersebut, KPU UAS tidak dapat dicetak.</li>
                    <li>Mahasiswa diwajibkan telah melunasi administrasi keuangan (SPP/UKT atau cicilan yang berlaku).</li>
                    <li>Mahasiswa wajib mencetak dan membawa Kartu Peserta Ujian (KPU) fisik serta Kartu Tanda Mahasiswa (KTM) asli sebagai syarat validasi identitas saat memasuki ruang ujian.</li>
                    <li>Peserta ujian harus hadir di ruangan (atau masuk ke dalam Virtual Class Room untuk ujian daring) selambat-lambatnya 15 menit sebelum ujian dimulai. Toleransi keterlambatan maksimal adalah 30 menit tanpa ada tambahan waktu pengerjaan.</li>
                    <li>Mahasiswa diwajibkan mengenakan pakaian kemeja berkerah, rapi, bersepatu tertutup, dan sopan.</li>
                    <li>Peserta hanya diperkenankan membawa alat tulis dan perlengkapan lain yang diizinkan oleh dosen pengampu di atas meja. Alat komunikasi (ponsel, smartwatch) dan catatan harus dimasukkan ke dalam tas dan diletakkan di area yang ditentukan oleh pengawas.</li>
                </ul>
            </div>

        </div>
    </div>

</body>
</html>