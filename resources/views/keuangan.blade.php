<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Mahasiswa - SimBelWa</title>
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

        /* === KARTU KEUANGAN === */
        .content-card { background-color: white; border-radius: 20px; padding: 35px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .table-title { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 15px; }

        /* Tabel Keuangan */
        .table-wrapper { overflow-x: auto; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        th { background-color: #bfdbfe; color: #1e3a8a; font-size: 13px; font-weight: 700; padding: 15px; text-align: center; border-bottom: 2px solid #93c5fd; }
        td { padding: 15px; font-size: 13px; color: #475569; border-bottom: 1px solid #f1f5f9; font-weight: 500; text-align: center; }
        tr:last-child td { border-bottom: none; }
        
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        
        /* Summary Tagihan */
        .summary-box { display: flex; flex-direction: column; gap: 8px; font-size: 14px; color: #1e293b; margin-bottom: 30px; }
        .summary-box span { font-weight: 800; color: #0f172a; }

        /* Ketentuan Keuangan */
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
            <a href="{{ url('/dashboard') }}" class="nav-item"><img src="{{ asset('dashboard.png') }}" alt="Dashboard"> Dashboard</a>
            <a href="{{ url('/profil') }}" class="nav-item"><img src="{{ asset('profil-mahasiswa.png') }}" alt="Profil"> Profil Mahasiswa</a>
            <a href="{{ url('/krs') }}" class="nav-item"><img src="{{ asset('krs-online.png') }}" alt="KRS"> KRS Online</a>
            <a href="{{ url('/kelas') }}" class="nav-item"><img src="{{ asset('kelas-mahasiswa.png') }}" alt="Kelas"> Kelas Mahasiswa</a>
            <a href="{{ url('/jadwal-uts') }}" class="nav-item"><img src="{{ asset('jadwal-uts.png') }}" alt="Jadwal UTS"> Jadwal UTS</a>
            <a href="{{ url('/jadwal-uas') }}" class="nav-item"><img src="{{ asset('jadwal-uas.png') }}" alt="Jadwal UAS"> Jadwal UAS</a>
            <a href="{{ url('/transkrip') }}" class="nav-item"><img src="{{ asset('transkrip-nilai.png') }}" alt="Transkrip"> Transkrip Nilai</a>
            
            <a href="{{ url('/keuangan') }}" class="nav-item active"><img src="{{ asset('keuangan-mahasiswa.png') }}" alt="Keuangan" style="filter: brightness(0) invert(1);"> Keuangan Mahasiswa</a>
            
            <a href="{{ url('/logout') }}" class="nav-item"><img src="{{ asset('logout.png') }}" alt="Logout"> Logout</a>
        </ul>   
    </div>

    <div class="main-content">
        <h2 class="page-title">Keuangan Mahasiswa</h2>

        <div class="content-card">
            <h3 class="table-title">Transaksi Kewajiban Mahasiswa</h3>
            
            <div class="table-wrapper">
                <style>
                    /* Tambahan CSS khusus agar tabel tidak turun baris */
                    .whitespace-nowrap { white-space: nowrap; }
                </style>
                <table>
                    <thead style="border-radius: 10px 10px 0 0; overflow: hidden;">
                        <tr>
                            <th class="text-center" style="width: 5%; border-top-left-radius: 10px;">No</th>
                            <th class="text-center whitespace-nowrap" style="width: 12%;">Periode</th>
                            <th class="text-left" style="width: 25%;">Jenis Tagihan/Keterangan</th>
                            <th class="text-center whitespace-nowrap" style="width: 8%;">Cicilan ke-</th>
                            <th class="text-right whitespace-nowrap" style="width: 13%;">Nominal Tagihan</th>
                            <th class="text-right whitespace-nowrap" style="width: 10%;">Potongan</th>
                            <th class="text-right whitespace-nowrap" style="width: 10%;">Sisa Tagihan</th>
                            <th class="text-center whitespace-nowrap" style="width: 10%;">Status Bayar</th>
                            <th class="text-center whitespace-nowrap" style="width: 10%; border-top-right-radius: 10px;">Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($keuangan ?? [] as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}.</td>
                            <td class="text-center whitespace-nowrap">{{ $item->periode }}</td>
                            <td class="text-left">{{ $item->jenis_tagihan }}</td>
                            <td class="text-center">{{ $item->cicilan_ke }}</td>
                            <td class="text-right whitespace-nowrap">{{ number_format($item->nominal_tagihan, 0, ',', '.') }}</td>
                            <td class="text-right whitespace-nowrap">{{ number_format($item->potongan, 0, ',', '.') }}</td>
                            <td class="text-right whitespace-nowrap">{{ number_format($item->sisa_tagihan, 0, ',', '.') }}</td>
                            <td class="text-center whitespace-nowrap" style="font-weight: 700; color: {{ $item->status_bayar == 'LUNAS' ? '#166534' : '#991b1b' }};">{{ $item->status_bayar }}</td>
                            <td class="text-center whitespace-nowrap">{{ $item->tanggal_bayar ? date('d-m-Y', strtotime($item->tanggal_bayar)) : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center" style="padding: 20px;">Belum ada data tagihan keuangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="summary-box">
                <div>Sisa Tagihan : <span>Rp {{ number_format($total_sisa ?? 0, 0, ',', '.') }}</span></div>
                <div>Tagihan Aktif di Bank : <span>Rp {{ number_format($total_sisa ?? 0, 0, ',', '.') }}</span></div>
            </div>

            <div>
                <div class="rules-title">Ketentuan Keuangan Wajib Mahasiswa :</div>
                <ul class="rules-list">
                    <li>Apabila ada tagihan yang seharusnya sudah terbayar tapi masih belum lunas, silahkan laporkan langsung ke Loket Keuangan Rektorat Utk Rekonsiliasi.</li>
                    <li>Anda Dapat Melakukan Pembayaran Melalui Bank dengan hanya menyebutkan NPM, tanpa perlu menggunakan SLIP SETORAN TUNAI.</li>
                    <li>Gunakan Fasilitas Check Tagihan BNI46 yang ada di website ini sebelum melakukan Pembayaran di Bank BNI46.</li>
                    <li>Bukti Bayar Tidak Perlu diserahkan ke Loket Keuangan apabila anda menggunakan Fasilitas Pembayaran melalui Sistem SPC Online BNI46.</li>
                    <li>Silahkan Baca Panduan Pembayaran Kewajiban Mahasiswa yang tersedia di menu HELP website ini.</li>
                </ul>
            </div>

        </div>
    </div>

</body>
</html>