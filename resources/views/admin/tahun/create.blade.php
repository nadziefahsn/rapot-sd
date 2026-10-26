<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Tambah Tahun Pelajaran</h5>
            </div>
            <form action="{{ route('tahun_ajaran.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Pelajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control rounded-3" placeholder="Tahun Pelajaran" value="{{ old('tahun_ajaran') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold mb-2">Semester</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="semester" value="Ganjil" {{ old('semester') == 'Ganjil' ? 'checked' : '' }} required>
                                <label class="form-check-label">Semester Ganjil</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="semester" value="Genap" {{ old('semester') == 'Genap' ? 'checked' : '' }} required>
                                <label class="form-check-label">Semester Genap</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kepala Sekolah</label>
                        <input type="text" name="kepala_sekolah" class="form-control rounded-3" placeholder="Kepala Sekolah" value="{{ old('kepala_sekolah') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">NUPTK</label>
                        <input type="text" name="nuptk" class="form-control rounded-3" placeholder="NUPTK" value="{{ old('nuptk') }}" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="20">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Titimangsa</label>
                        <input type="date" name="titimangsa" class="form-control rounded-3" value="{{ old('titimangsa') }}" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>