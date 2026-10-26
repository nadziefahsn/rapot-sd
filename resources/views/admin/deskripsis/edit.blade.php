@foreach($deskripsis as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Edit Deskripsi Mata Pelajaran</h5>
            </div>
            <form action="{{ route('deskripsi.update', $item->id) }}" method="POST">
                @csrf
                <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif?->id }}">
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas_id" class="form-select rounded-3" required>
                            <option value="" disabled>-- Pilih Kelas --</option>
                            @foreach($kelases as $kelas)
                                <option value="{{ $kelas->id }}" {{ old('kelas_id', $item->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->rombel ?? $kelas->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select name="mapel_id" class="form-select rounded-3" required>
                            <option value="" disabled>-- Pilih Mata Pelajaran --</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}" {{ old('mapel_id', $item->mapel_id) == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Capaian</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="4" placeholder="Masukkan deskripsi capaian mata pelajaran untuk kelas ini...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
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
@endforeach