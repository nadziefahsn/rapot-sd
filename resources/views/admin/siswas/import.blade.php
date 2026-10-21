<div class="modal fade" id="modalImportSiswa" tabindex="-1" role="dialog" aria-labelledby="modalImportSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            <div class="modal-header text-white text-center d-block py-4 border-0" style="background: linear-gradient(135deg, #343A40 0%, #495057 100%);">
                <h5 class="modal-title font-weight-bold text-white mb-1" id="modalImportSiswaLabel">
                    Import Peserta Didik 📥
                </h5>
                <small class="text-white-50">Upload file Excel (.xlsx / .xls) untuk mengimpor data</small>
            </div>

            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data" onsubmit="document.getElementById('btnSubmitImportSiswa').disabled = true;">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label for="fileImportSiswa" class="form-label font-weight-bold text-dark">
                            File Excel <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="file" class="form-control form-control-lg" id="fileImportSiswa" required accept=".xlsx, .xls">
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 px-4 py-3 justify-content-end">
                    <button type="button" class="btn btn-link text-secondary text-decoration-none mr-2" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btnSubmitImportSiswa" class="btn btn-primary px-4 py-2 font-weight-bold rounded-3">Import Data</button>
                </div>
            </form>

        </div>
    </div>
</div>