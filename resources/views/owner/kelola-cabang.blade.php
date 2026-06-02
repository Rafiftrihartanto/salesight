@extends('layouts.owner')

@section('content')

<div class="kc-wrapper">
    
    <div class="kc-header">
        <div class="kc-title-group">
            <h1 class="kc-title">Kelola Cabang</h1>
            <p class="kc-subtitle">Tambah, edit, dan pantau status semua cabang bisnis</p>
        </div>
        <button class="kc-btn-primary" onclick="toggleModal('modalTambahCabang')">
            <i data-lucide="plus"></i> Tambah Cabang
        </button>
    </div>

    <div class="kc-stats">
        <div class="kc-stat-card">
            <h2 class="kc-stat-value text-blue">5</h2>
            <p class="kc-stat-label">Total Cabang</p>
        </div>
        <div class="kc-stat-card">
            <h2 class="kc-stat-value text-green">4</h2>
            <p class="kc-stat-label">Cabang Aktif</p>
        </div>
        <div class="kc-stat-card">
            <h2 class="kc-stat-value text-red">1</h2>
            <p class="kc-stat-label">Cabang Nonaktif</p>
        </div>
    </div>

    <div class="kc-table-card">
        
        <div class="kc-table-header">
            <h3 class="kc-table-title">Daftar Cabang</h3>
            <span class="kc-table-count">5 cabang terdaftar</span>
        </div>

        <div class="kc-table-responsive">
            <table class="kc-table">
                <thead>
                    <tr>
                        <th>CABANG</th>
                        <th>LOKASI</th>
                        <th>KODE CABANG</th>
                        <th style="text-align: center;">STATUS</th>
                        <th style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>
                            <div class="kc-td-cabang">
                                <div class="kc-icon-box bg-blue-light text-blue"><i data-lucide="store"></i></div>
                                <span class="kc-cabang-name">Toko Jakarta Pusat</span>
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-lokasi">
                                <i data-lucide="map-pin"></i> Jakarta Pusat, DKI Jakarta
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-kode">
                                <span class="kc-badge-kode">SLS-JKT-01</span>
                                <button class="kc-btn-salin"><i data-lucide="copy"></i> Salin</button>
                            </div>
                        </td>
                        <td>
                            <span class="kc-badge-status status-aktif"><span class="dot"></span> Aktif</span>
                        </td>
                        <td>
                            <div class="kc-td-aksi">
                                <button class="kc-btn-edit" onclick="toggleModal('modalEditCabang')"><i data-lucide="edit-2"></i> Edit</button>
                                <button class="kc-btn-hapus" onclick="toggleModal('modalHapusCabang')"><i data-lucide="trash-2"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="kc-td-cabang">
                                <div class="kc-icon-box bg-teal-light text-teal"><i data-lucide="store"></i></div>
                                <span class="kc-cabang-name">Toko Bandung Kota</span>
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-lokasi">
                                <i data-lucide="map-pin"></i> Bandung, Jawa Barat
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-kode">
                                <span class="kc-badge-kode">SLS-BDG-02</span>
                                <button class="kc-btn-salin"><i data-lucide="copy"></i> Salin</button>
                            </div>
                        </td>
                        <td>
                            <span class="kc-badge-status status-aktif"><span class="dot"></span> Aktif</span>
                        </td>
                        <td>
                            <div class="kc-td-aksi">
                                <button class="kc-btn-edit" onclick="toggleModal('modalEditCabang')"><i data-lucide="edit-2"></i> Edit</button>
                                <button class="kc-btn-hapus" onclick="toggleModal('modalHapusCabang')"><i data-lucide="trash-2"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="kc-td-cabang">
                                <div class="kc-icon-box bg-orange-light text-orange"><i data-lucide="store"></i></div>
                                <span class="kc-cabang-name">Toko Surabaya</span>
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-lokasi">
                                <i data-lucide="map-pin"></i> Surabaya, Jawa Timur
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-kode">
                                <span class="kc-badge-kode">SLS-SBY-03</span>
                                <button class="kc-btn-salin"><i data-lucide="copy"></i> Salin</button>
                            </div>
                        </td>
                        <td>
                            <span class="kc-badge-status status-aktif"><span class="dot"></span> Aktif</span>
                        </td>
                        <td>
                            <div class="kc-td-aksi">
                                <button class="kc-btn-edit" onclick="toggleModal('modalEditCabang')"><i data-lucide="edit-2"></i> Edit</button>
                                <button class="kc-btn-hapus" onclick="toggleModal('modalHapusCabang')"><i data-lucide="trash-2"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="kc-td-cabang">
                                <div class="kc-icon-box bg-red-light text-red"><i data-lucide="store"></i></div>
                                <span class="kc-cabang-name">Toko Yogyakarta</span>
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-lokasi">
                                <i data-lucide="map-pin"></i> Yogyakarta, DIY
                            </div>
                        </td>
                        <td>
                            <div class="kc-td-kode">
                                <span class="kc-badge-kode">SLS-YGY-04</span>
                                <button class="kc-btn-salin"><i data-lucide="copy"></i> Salin</button>
                            </div>
                        </td>
                        <td>
                            <span class="kc-badge-status status-nonaktif"><i data-lucide="circle"></i> Nonaktif</span>
                        </td>
                        <td>
                            <div class="kc-td-aksi">
                                <button class="kc-btn-edit" onclick="toggleModal('modalEditCabang')"><i data-lucide="edit-2"></i> Edit</button>
                                <button class="kc-btn-hapus" onclick="toggleModal('modalHapusCabang')"><i data-lucide="trash-2"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>

<div id="modalTambahCabang" class="kc-modal-overlay">
    <div class="kc-modal-backdrop" onclick="toggleModal('modalTambahCabang')"></div>
    
    <div class="kc-modal-box">
        <button class="kc-modal-close" onclick="toggleModal('modalTambahCabang')">
            <i data-lucide="x"></i>
        </button>

        <div class="kc-modal-header">
            <h2>Tambah Cabang Baru</h2>
            <p>Daftarkan cabang baru ke sistem</p>
        </div>

        <form action="#" method="POST" class="kc-modal-form">
            <div class="kc-form-group">
                <label>Nama Cabang <span class="text-red">*</span></label>
                <input type="text" placeholder="Contoh: Toko Semarang Tengah" required>
            </div>

            <div class="kc-form-group">
                <label>Lokasi <span class="text-red">*</span></label>
                <input type="text" placeholder="Contoh: Semarang, Jawa Tengah" required>
            </div>

            <div class="kc-auto-generate">
                <p class="kc-ag-title">Kode Cabang (Auto-Generate)</p>
                <div class="kc-ag-value">
                    <i data-lucide="hash"></i> SLS-???-00
                </div>
                <p class="kc-ag-desc">Kode dibuat otomatis berdasarkan nama dan lokasi cabang setelah disimpan.</p>
            </div>

            <div class="kc-modal-actions">
                <button type="button" class="kc-btn-cancel" onclick="toggleModal('modalTambahCabang')">Batal</button>
                <button type="submit" class="kc-btn-submit">Tambah Cabang</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditCabang" class="kc-modal-overlay">
    <div class="kc-modal-backdrop" onclick="toggleModal('modalEditCabang')"></div>
    
    <div class="kc-modal-box">
        <button class="kc-modal-close" onclick="toggleModal('modalEditCabang')">
            <i data-lucide="x"></i>
        </button>

        <div class="kc-modal-header">
            <h2>Edit Data Cabang</h2>
            <p>Perbarui informasi cabang yang sudah terdaftar</p>
        </div>

        <form action="#" method="POST" class="kc-modal-form">
            <div class="kc-form-group">
                <label>Nama Cabang <span class="text-red">*</span></label>
                <input type="text" value="Toko Jakarta Pusat" required>
            </div>

            <div class="kc-form-group">
                <label>Lokasi <span class="text-red">*</span></label>
                <input type="text" value="Jakarta Pusat, DKI Jakarta" required>
            </div>

            <div class="kc-form-group">
                <label>Status Cabang</label>
                <select class="kc-select" required>
                    <option value="aktif" selected>Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="kc-modal-actions">
                <button type="button" class="kc-btn-cancel" onclick="toggleModal('modalEditCabang')">Batal</button>
                <button type="submit" class="kc-btn-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalHapusCabang" class="kc-modal-overlay">
    <div class="kc-modal-backdrop" onclick="toggleModal('modalHapusCabang')"></div>
    
    <div class="kc-modal-box text-center">
        <button class="kc-modal-close" onclick="toggleModal('modalHapusCabang')">
            <i data-lucide="x"></i>
        </button>

        <div class="kc-modal-icon-warning">
            <i data-lucide="alert-triangle"></i>
        </div>

        <div class="kc-modal-header">
            <h2>Hapus Cabang?</h2>
            <p>Apakah Anda yakin ingin menghapus cabang ini? Semua data transaksi yang terhubung dengan cabang ini akan ikut terhapus permanen.</p>
        </div>

        <form action="#" method="POST" class="kc-modal-form mt-4">
            <div class="kc-modal-actions">
                <button type="button" class="kc-btn-cancel" onclick="toggleModal('modalHapusCabang')">Batal</button>
                <button type="submit" class="kc-btn-delete-confirm">Ya, Hapus Cabang</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        modal.classList.toggle('active');
    }
</script>

@endsection