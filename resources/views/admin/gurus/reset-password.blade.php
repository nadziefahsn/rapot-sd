@extends('adminlte::page')

@section('title', 'Reset Password Guru')

@section('content')
<style>
    /* Container untuk membuat posisi card presisi di tengah layar secara vertikal & horisontal */
    .reset-password-wrapper {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    /* Styling Card Elegan & Modern (Senada dengan Sidebar Dark AdminLTE) */
    .custom-card {
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(52, 58, 64, 0.12) !important;
        border: 1px solid #E9ECEF !important;
        overflow: hidden;
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
    }

    /* Header: Gradien Dark Slate Blue agar matching dengan Sidebar */
    .custom-card-header {
        background: linear-gradient(135deg, #343A40 0%, #495057 100%);
        color: #FFFFFF;
        padding: 26px 20px;
        text-align: center;
        border: none;
    }

    .custom-card-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        color: #FFFFFF;
    }

    .custom-card-header p {
        font-size: 0.88rem;
        margin: 6px 0 0 0;
        color: #CED4DA;
    }

    .custom-card-body {
        padding: 28px 26px;
        background-color: #FFFFFF;
    }

    .form-group-modern {
        margin-bottom: 20px;
    }

    .form-group-modern label {
        font-size: 0.88rem;
        font-weight: 600;
        color: #343A40;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-modern {
        width: 100%;
        padding: 11px 15px;
        border: 1.5px solid #CED4DA;
        border-radius: 10px;
        font-size: 0.93rem;
        transition: all 0.2s ease-in-out;
        outline: none;
        background-color: #FFFFFF;
        color: #212529;
    }

    .form-control-modern:focus {
        background-color: #FFFFFF;
        border-color: #007bff;
        box-shadow: 0 0 0 3.5px rgba(0, 123, 255, 0.15);
    }

    .custom-card-footer {
        background: #F8F9FA;
        padding: 18px 26px;
        border-top: 1px solid #DEE2E6;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
    }

    .btn-custom-cancel {
        color: #6C757D;
        font-weight: 600;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 10px;
        transition: all 0.2s;
    }

    .btn-custom-cancel:hover {
        background: #E9ECEF;
        color: #343A40;
        text-decoration: none;
    }

    .btn-custom-submit {
        background: #007bff;
        color: #FFFFFF;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
    }

    .btn-custom-submit:hover {
        background: #0056b3;
    }

    .alert-custom {
        background-color: #F8D7DA;
        border-left: 4px solid #DC3545;
        color: #842029;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }
</style>

<div class="reset-password-wrapper">
    <div class="card custom-card">
        
        <div class="custom-card-header">
            <h3>Reset Password Guru 🔒</h3>
            <p>Silakan buat kata sandi baru untuk akun ini</p>
        </div>
        
        <form action="{{ route('guru.update-password', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="custom-card-body">
                
                @if ($errors->any())
                    <div class="alert-custom">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group-modern">
                    <label for="password">Password Baru <span class="text-danger">*</span></label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control-modern" 
                        placeholder="6-8 karakter" 
                        maxlength="8" 
                        required>
                </div>

                <div class="form-group-modern">
                    <label for="password_confirmation">Ulangi Password Baru <span class="text-danger">*</span></label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="form-control-modern" 
                        placeholder="6-8 karakter" 
                        maxlength="8" 
                        required>
                </div>

            </div>

            <div class="custom-card-footer">
                <a href="{{ route('guru.index') }}" class="btn-custom-cancel">Batal</a>
                <button type="submit" class="btn-custom-submit">Kirim Password</button>
            </div>
        </form>

    </div>
</div>
@stop