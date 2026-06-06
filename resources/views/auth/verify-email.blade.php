@extends('frontend.layout')

@section('title', 'Verifikasi Email')

@section('content')
<div style="min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 16px; background:var(--off-white);">

    <div style="background:var(--white); border-radius:12px; border:1px solid var(--gray-200); box-shadow:var(--shadow-md); max-width:460px; width:100%; overflow:hidden;">

        {{-- Header biru dengan ikon --}}
        <div style="background:var(--blue); padding:32px 32px 28px; text-align:center;">
            <div style="width:72px; height:72px; border-radius:50%; background:rgba(255,255,255,.12); border:2px solid rgba(255,255,255,.25); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i class="fas fa-envelope" style="font-size:30px; color:#fff;"></i>
            </div>
            <h2 style="font-family:var(--font-display); font-size:22px; font-weight:700; color:#fff; margin:0 0 6px;">
                Verifikasi Email Anda
            </h2>
            <p style="font-size:13.5px; color:rgba(255,255,255,.72); margin:0;">
                Satu langkah lagi untuk mengaktifkan akun Anda
            </p>
        </div>

        {{-- Body --}}
        <div style="padding:28px 32px 32px;">

            {{-- Alert sukses --}}
            @if(session('status') == 'verification-link-sent')
            <div style="background:#e8f5e9; border:1px solid #a5d6a7; border-radius:var(--radius-md); padding:12px 16px; font-size:13px; color:#2e7d32; margin-bottom:20px; display:flex; gap:10px; align-items:flex-start;">
                <i class="fas fa-check-circle" style="margin-top:2px; flex-shrink:0;"></i>
                <span>Email verifikasi berhasil dikirim ulang. Periksa folder <strong>Spam</strong> jika tidak muncul di Inbox.</span>
            </div>
            @endif

            {{-- Info email --}}
            <div style="background:var(--off-white); border:1px solid var(--gray-200); border-left:4px solid var(--blue-mid); border-radius:0 var(--radius-md) var(--radius-md) 0; padding:14px 16px; margin-bottom:24px; font-size:13.5px; color:var(--text-soft);">
                Link verifikasi telah dikirim ke <strong style="color:var(--text-main);">{{ auth()->user()->email }}</strong>
            </div>

            {{-- Langkah-langkah --}}
            <ul style="list-style:none; margin:0 0 24px; padding:0; display:flex; flex-direction:column; gap:10px;">
                @foreach([['Buka aplikasi email Anda'], ['Cari email dari Poros Kie Raha'], ['Klik tombol verifikasi di dalam email']] as $i => $step)
                <li style="display:flex; align-items:flex-start; gap:12px; font-size:13px; color:var(--gray-600);">
                    <span style="width:22px; height:22px; border-radius:50%; background:var(--blue); color:#fff; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px;">
                        {{ $i + 1 }}
                    </span>
                    {{ $step[0] }}
                </li>
                @endforeach
            </ul>

            {{-- Tombol kirim ulang --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-pkr-primary" style="width:100%; justify-content:center; margin-bottom:12px;">
                    <i class="fas fa-paper-plane"></i> Kirim Ulang Email Verifikasi
                </button>
            </form>

            {{-- Divider --}}
            <div style="display:flex; align-items:center; gap:12px; margin:20px 0;">
                <div style="flex:1; height:1px; background:var(--gray-200);"></div>
                <span style="font-size:12px; color:var(--gray-400);">atau</span>
                <div style="flex:1; height:1px; background:var(--gray-200);"></div>
            </div>

            {{-- Tombol logout --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <button onclick="document.getElementById('logout-form').submit()" class="btn-pkr-outline" style="width:100%; justify-content:center;">
                <i class="fas fa-sign-out-alt"></i> Keluar &amp; Login Ulang
            </button>

        </div>
    </div>

</div>
@endsection