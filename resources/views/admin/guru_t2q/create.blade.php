<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Tambah Anggota Kelompok T2Q</h5>
            </div>

            <form action="{{ route('guru-t2q.store', $guru->id) }}" method="POST">
                @csrf
                <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                <div class="modal-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Pilih Siswa <span class="text-danger">*</span></label>
                            <select name="anggota_kelas_ids[]" class="form-select select2-modal" multiple="multiple" data-placeholder="Cari Nama Siswa atau Kelas..." style="width: 100%;" required>
                                @foreach($allAnggotaKelas as $ak)
                                    <option value="{{ $ak->id }}">
                                        {{ $ak->siswa->nama ?? $ak->siswa->nama_siswa ?? 'Siswa' }} (Kelas: {{ $ak->kelas->rombel ?? $ak->kelas->nama ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted mt-2">
                                * Bisa memilih lebih dari satu siswa sekaligus.
                            </small>
                        </div>
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