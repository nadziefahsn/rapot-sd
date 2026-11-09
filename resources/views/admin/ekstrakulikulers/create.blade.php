<div class="modal fade" id="modalTambahEskul" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('ekstrakulikuler.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Ekstrakulikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}" readonly>
                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id ?? '' }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Nama Ekstrakulikuler</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_ekstrakulikuler" class="form-control" placeholder="Nama ekstrakulikuler" required>
                        </div>
                    </div>
                    <div class="mb-3 row form-group">
                        <label class="col-sm-3 col-form-label">Pembimbing</label>
                        <div class="col-sm-9">
                            <select name="pendamping_id" class="form-control" required>
                                <option value="">-- Pilih Pembimbing --</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>