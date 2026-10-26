<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Raport SD GIS Prima Insani - Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Source Sans Pro', sans-serif; background-color: #f4f6f9; }
        .small-box { border-radius: 0.25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); display: block; margin-bottom: 20px; position: relative; color: #fff; overflow: hidden; }
        .small-box .inner { padding: 15px; }
        .small-box h3 { font-size: 2.2rem; font-weight: 700; margin: 0 0 5px 0; }
        .small-box p { font-size: 1rem; margin-bottom: 0; }
        .small-box .icon { color: rgba(0,0,0,.15); position: absolute; right: 15px; top: 10px; transition: transform .3s linear; }
        .small-box .icon i { font-size: 65px; }
        .small-box:hover .icon { transform: scale(1.1); }
        .small-box-footer { background-color: rgba(0,0,0,.1); color: rgba(255,255,255,.8); display: block; padding: 5px 0; text-align: center; font-size: 0.875rem; transition: background-color .2s ease; }
        .small-box-footer:hover { background-color: rgba(0,0,0,.25); color: #fff; }
        .bg-info-custom { background-color: #17a2b8; }
        .bg-success-custom { background-color: #28a745; }
        .bg-warning-custom { background-color: #ffc107; color: #1f2d3d !important; }
        .bg-warning-custom .small-box-footer { color: #1f2d3d !important; }
        .bg-danger-custom { background-color: #dc3545; }
        .bg-teal-header { background-color: #17a2b8; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-gray-800">

    <div class="flex min-h-screen">

        <!-- SIDEBAR LEFT -->
        <aside class="w-64 bg-[#343a40] text-gray-300 flex-shrink-0 flex flex-col min-h-screen">
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-[#343a40] border-b border-gray-700">
                <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center font-bold text-white text-sm">GIS</div>
                <span class="font-bold text-sm text-white tracking-wide">E-RAPORT SD</span>
            </a>

            <div class="p-3 flex-grow overflow-y-auto">
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" placeholder="mencari..." class="w-full bg-[#3f474e] text-sm text-gray-200 pl-3 pr-8 py-1.5 rounded border border-gray-600 focus:outline-none">
                        <i class="fas fa-search absolute right-3 top-2.5 text-xs text-gray-400"></i>
                    </div>
                </div>

                <nav class="space-y-1 text-sm">
                    <!-- Menu Dashboard -->
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded text-white bg-blue-600 font-medium mb-1">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Menu Informasi Sekolah -->
                    <a href="{{ url('/admin/sekolah') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-300 hover:bg-white/5 hover:text-white transition">
                        <i class="fas fa-school w-5 text-center"></i>
                        <span>Informasi Sekolah</span>
                    </a>

                    <div class="pt-4 pb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">PENGATURAN AKUN</div>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-300 hover:bg-white/5 hover:text-white transition">
                        <i class="far fa-user w-5 text-center"></i>
                        <span>Profil</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-300 hover:bg-white/5 hover:text-white transition">
                        <i class="fas fa-lock w-5 text-center"></i>
                        <span>Ubah Kata Sandi</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-grow flex flex-col min-w-0">
            
            <!-- Header Topbar -->
            <header class="bg-white border-b border-gray-200 px-4 py-2.5 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-bars"></i></button>
                    <span class="text-sm font-semibold text-gray-700">E-Raport SD GIS PRIMA INSANI</span>
                </div>
                <div class="flex items-center gap-2 cursor-pointer">
                    <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">AF</div>
                    <span class="text-sm font-semibold text-gray-700">Anwar Fauzi</span>
                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded">Administrator</span>
                </div>
            </header>

            <!-- Isi Dashboard -->
            <div class="p-6 flex-grow">
                
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                </div>

                <!-- Banner Sekolah -->
                <div class="bg-white rounded border border-gray-200 shadow-sm p-5 mb-6 border-l-4 border-l-green-600">
                    <h2 class="text-xl font-bold text-gray-800">SD GIS PRIMA INSANI</h2>
                    <p class="text-gray-500 text-sm mt-1">Tahun Pelajaran 2025/2026 Semester Genap</p>
                </div>

                <!-- 4 Kotak Statistik Ke Samping -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    
                    <!-- Rombel -->
                    <div class="small-box bg-info-custom shadow-sm">
                        <div class="inner">
                            <h3>{{ $rombel ?? 17 }}</h3>
                            <p>Rombel</p>
                        </div>
                        <div class="icon"><i class="fas fa-layer-group"></i></div>
                        <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right ml-1"></i></a>
                    </div>

                    <!-- Peserta Didik -->
                    <div class="small-box bg-success-custom shadow-sm">
                        <div class="inner">
                            <h3>{{ $peserta_didik ?? 466 }}</h3>
                            <p>Peserta Didik</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right ml-1"></i></a>
                    </div>

                    <!-- Guru dan Tendik -->
                    <div class="small-box bg-warning-custom shadow-sm">
                        <div class="inner">
                            <h3>{{ $guru_tendik ?? 79 }}</h3>
                            <p>Guru dan Tendik</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-tie"></i></div>
                        <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right ml-1"></i></a>
                    </div>

                    <!-- Ruang Kelas -->
                    <div class="small-box bg-danger-custom shadow-sm">
                        <div class="inner">
                            <h3>{{ $ruang_kelas ?? 17 }}</h3>
                            <p>Ruang Kelas</p>
                        </div>
                        <div class="icon"><i class="fas fa-building"></i></div>
                        <a href="#" class="small-box-footer">Informasi selengkapnya <i class="fas fa-arrow-circle-right ml-1"></i></a>
                    </div>

                </div>

                <!-- Informasi Sekolah -->
                <div class="w-full max-w-2xl">
                    <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden">
                        <div class="bg-teal-header text-white px-4 py-2.5 font-bold flex items-center gap-2 text-sm">
                            <i class="fas fa-university"></i>
                            <span>Informasi Sekolah</span>
                        </div>
                        <div class="p-4 text-sm divide-y divide-gray-100">
                            <div class="py-2.5 grid grid-cols-12">
                                <span class="col-span-4 font-semibold text-gray-700">NPSN</span>
                                <span class="col-span-8 text-gray-800">: {{ $npsn ?? '69956855' }}</span>
                            </div>
                            <div class="py-2.5 grid grid-cols-12">
                                <span class="col-span-4 font-semibold text-gray-700">Sekolah</span>
                                <span class="col-span-8 text-gray-800">: {{ $sekolah ?? 'SD GIS PRIMA INSANI' }}</span>
                            </div>
                            <div class="py-2.5 grid grid-cols-12">
                                <span class="col-span-4 font-semibold text-gray-700">Kepala Sekolah</span>
                                <span class="col-span-8 text-gray-800">: {{ $kepsek ?? 'PUJI FAUZIAH, S.Pd.SD.' }}</span>
                            </div>
                            <div class="py-2.5 grid grid-cols-12">
                                <span class="col-span-4 font-semibold text-gray-700">NRKS</span>
                                <span class="col-span-8 text-gray-800">: {{ $nrks ?? '19023L1040211212119042' }}</span>
                            </div>
                            <div class="py-2.5 grid grid-cols-12">
                                <span class="col-span-4 font-semibold text-gray-700">Email</span>
                                <span class="col-span-8 text-gray-800">: <span class="text-blue-600">{{ $email ?? 'gis@primainsani.sch.id' }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-6 py-3 text-xs text-gray-500 flex justify-between items-center">
                <div><strong>Copyright &copy; 2026 SD GIS PRIMA INSANI.</strong> All rights reserved.</div>
                <div><b>Version</b> 2.1.0</div>
            </footer>

        </main>
    </div>

</body>
</html>