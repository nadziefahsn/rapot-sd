@foreach($siswas as $item)
<div class="modal fade" id="editModal{{ $item->nis }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Edit Data Siswa</h5>
            </div>
            <form action="{{ route('siswa.update', $item->nis) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NIS</label>
                            <input type="text" name="nis" class="form-control rounded-3" value="{{ $item->nis }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control rounded-3" value="{{ $item->nama_siswa }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NISN</label>
                            <input type="text" name="nisn" class="form-control rounded-3" value="{{ $item->nisn }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <select name="kelas_id" class="form-control rounded-3" required>
                                <option value="" disable>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k )
                                    <option value="{{ $k->id }}" 
                                        {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                        {{ $k->rombel }}
                                    </option>
                                    @endforeach>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light py-2 px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Kembali</button>
                    <button type="submit" class="btn btn-dark flex-grow-1 py-2 fw-bold" style="border-radius: 12px;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach