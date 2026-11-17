@foreach($mapels as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius:24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Edit Mata Pelajaran</h5>
            </div>
            <form action="{{ route('mapel.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select rounded-3" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="Intrakulikuler" {{ old('kategori', $item->kategori) == 'Intrakulikuler' ? 'selected' : '' }}>Intrakulikuler</option>
                            <option value="KO Kulikuler dan Extrakulikuler" {{ old('kategori', $item->kategori) == 'KO Kulikuler dan Extrakulikuler' ? 'selected' : '' }}>KO Kulikuler dan Extrakulikuler</option>
                            <option value="Mulok PAI Khas Prima Insani" {{ old('kategori', $item->kategori) == 'Mulok PAI Khas Prima Insani' ? 'selected' : '' }}>Mulok PAI Khas Prima Insani</option>
                            <option value="Amal Ibadah" {{ old('kategori', $item->kategori) == 'Amal Ibadah' ? 'selected' : '' }}>Amal Ibadah</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                        <input type="text" name="mapel" class="form-control rounded-3" placeholder="Contoh: Matematika" value="{{ old('mapel', $item->mapel) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Ringkasan</label>
                        <input type="text" name="ringkas" class="form-control rounded-3" placeholder="Contoh: MTK" value="{{ old('ringkas', $item->ringkas) }}">
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