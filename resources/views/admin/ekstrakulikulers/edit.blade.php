<div class="modal fade" id="modalEditEkstrakulikuler{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('ekstrakulikuler.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Ekstrakulikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Ekstrakulikuler</label>
                        <input type="text" name="nama_ekstrakulikuler" class="form-control" value="{{ $item->nama_ekstrakulikuler }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Ajaran</label>
                        <input type="text" class="form-control" value="{{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}" readonly>
                        <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pendamping / Pembina</label>
                        <select name="guru_id" class="form-control" required>
                            <option value="">-- Pilih Guru Pembimbing --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $item->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>