<style>
    #modalResetPassword.modal-smooth {
        background: rgba(0, 0, 0, 0.5);
        transition: opacity 0.3s ease-in-out;
        opacity: 0;
    }
    #modalResetPassword.modal-smooth.show {
        opacity: 1;
    }

    #modalResetPassword.modal-smooth .modal-dialog {
        transform: scale(0.8) translateY(-30px);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
        opacity: 0;
    }
    #modalResetPassword.modal-smooth.show .modal-dialog {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
</style>

<div class="modal fade modal-smooth" id="modalResetPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            <div class="modal-header text-white text-center d-block py-4 border-0" style="background: linear-gradient(135deg, #343A40 0%, #495057 100%);">
                <h5 class="modal-title font-weight-bold text-white mb-1">
                    Reset Password Guru 🔒
                </h5>
                <small class="text-white-50">Silakan buat kata sandi baru untuk akun ini</small>
            </div>

            <form id="formResetPassword" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body p-4 text-left text-start">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark">
                            Password Baru <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="6-8 karakter" required minlength="6">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark">
                            Ulangi Password Baru <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="6-8 karakter" required minlength="6">
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 px-4 py-3 justify-content-end">
                    <button type="button" class="btn btn-link text-secondary text-decoration-none mr-2 me-2" onclick="tutupModalReset()">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold rounded-3">Kirim Password</button>
                </div>
            </form>

        </div>
    </div>
</div>