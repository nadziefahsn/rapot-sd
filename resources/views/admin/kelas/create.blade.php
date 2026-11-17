<div class="modal fade" id="modalTambahKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Tambah Data Kelas</h5>
            </div>

            <form action="{{ route('kelas.store') }}" method="post">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rombel</label>
                            <input type="text" name="rombel" class="form-control rounded-3" placeholder="Contoh: Kelas 1A" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-control rounded-3" required>
                                @if($tahunAjarans)
                                    <option value="{{ $tahunAjarans->id }}" selected>
                                        {{ $tahunAjarans->tahun_ajaran }} - {{ $tahunAjarans->semester }}
                                    </option>
                                @else
                                    <option value="" selected disabled>-- Belum Ada Data Tahun Ajaran --</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Wali Kelas</label>
                            <select name="wali_kelas_id" class="form-control rounded-3" required>
                                <option value="" selected disabled>-- Pilih Wali Kelas --</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pendamping</label>
                            <select name="pendamping_id" class="form-control rounded-3" required>
                                <option value="" selected disabled>-- Pilih Pendamping --</option>
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                                @endforeach
                            </select>
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