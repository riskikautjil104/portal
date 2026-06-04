<x-guest-layout>
    <div style="
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1A3A6B 0%, #2A5298 50%, #4A90E2 100%);
        position: relative;
        overflow: hidden;
        padding: 20px;
    ">
        <!-- Decorative Blobs -->
        <div style="
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
        "></div>
        <div style="
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
        "></div>
        <div style="
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(74,144,226,0.1);
            filter: blur(60px);
        "></div>

        <!-- Login Card -->
        <div style="
            width: 100%;
            max-width: 450px;
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.1);
            position: relative;
            z-index: 10;
            animation: slideUp 0.6s ease-out;
        ">
            
            <!-- Logo Icon -->
            <div style="
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #EEF3FC 0%, #D4E0F8 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 24px;
                box-shadow: 0 8px 24px rgba(26,58,107,0.15);
            ">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#1A3A6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>

            <!-- Header -->
            <div style="text-align: center; margin-bottom: 32px;">
                <h2 style="
                    font-family: 'Poppins', sans-serif;
                    font-size: 28px;
                    font-weight: 700;
                    color: #1A3A6B;
                    margin: 0 0 8px;
                ">Selamat Datang Kembali</h2>
                <p style="
                    font-family: 'Inter', sans-serif;
                    font-size: 14px;
                    color: #6B7280;
                    margin: 0;
                ">Silakan masuk ke Portal SMAN 5 Morotai</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div style="
                    background: #D1FAE5;
                    border: 1px solid #6EE7B7;
                    color: #065F46;
                    padding: 12px 16px;
                    border-radius: 12px;
                    margin-bottom: 20px;
                    font-size: 14px;
                    font-weight: 500;
                ">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 20px;">
                @csrf

                <!-- Email Input -->
                <div>
                    <label style="
                        display: block;
                        font-family: 'Inter', sans-serif;
                        font-size: 13px;
                        font-weight: 600;
                        color: #374151;
                        margin-bottom: 8px;
                    ">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="nama@sekolah.sch.id"
                        style="
                            width: 100%;
                            padding: 14px 18px;
                            font-family: 'Inter', sans-serif;
                            font-size: 15px;
                            border: 2px solid #E5E7EB;
                            border-radius: 14px;
                            background: #F9FAFB;
                            color: #111827;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='#4A90E2'; this.style.background='#FFFFFF'; this.style.boxShadow='0 0 0 4px rgba(74,144,226,0.1)'"
                        onblur="this.style.borderColor='#E5E7EB'; this.style.background='#F9FAFB'; this.style.boxShadow='none'"
                    >
                    @error('email')
                        <p style="
                            font-family: 'Inter', sans-serif;
                            font-size: 13px;
                            color: #EF4444;
                            margin-top: 8px;
                            display: flex;
                            align-items: center;
                            gap: 6px;
                        ">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label style="
                        display: block;
                        font-family: 'Inter', sans-serif;
                        font-size: 13px;
                        font-weight: 600;
                        color: #374151;
                        margin-bottom: 8px;
                    ">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="••••••••"
                        style="
                            width: 100%;
                            padding: 14px 18px;
                            font-family: 'Inter', sans-serif;
                            font-size: 15px;
                            border: 2px solid #E5E7EB;
                            border-radius: 14px;
                            background: #F9FAFB;
                            color: #111827;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                        "
                        onfocus="this.style.borderColor='#4A90E2'; this.style.background='#FFFFFF'; this.style.boxShadow='0 0 0 4px rgba(74,144,226,0.1)'"
                        onblur="this.style.borderColor='#E5E7EB'; this.style.background='#F9FAFB'; this.style.boxShadow='none'"
                    >
                    @error('password')
                        <p style="
                            font-family: 'Inter', sans-serif;
                            font-size: 13px;
                            color: #EF4444;
                            margin-top: 8px;
                            display: flex;
                            align-items: center;
                            gap: 6px;
                        ">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    font-size: 14px;
                ">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: #4B5563;">
                        <input 
                            type="checkbox" 
                            name="remember"
                            style="
                                width: 18px;
                                height: 18px;
                                border: 2px solid #D1D5DB;
                                border-radius: 6px;
                                cursor: pointer;
                                accent-color: #1A3A6B;
                            "
                        >
                        <span style="font-family: 'Inter', sans-serif;">Ingat saya</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="
                            font-family: 'Inter', sans-serif;
                            color: #4A90E2;
                            text-decoration: none;
                            font-weight: 600;
                            transition: color 0.2s;
                        " onmouseover="this.style.color='#1A3A6B'" onmouseout="this.style.color='#4A90E2'">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    style="
                        width: 100%;
                        padding: 16px;
                        background: linear-gradient(135deg, #1A3A6B 0%, #2A5298 100%);
                        color: white;
                        border: none;
                        border-radius: 14px;
                        font-family: 'Poppins', sans-serif;
                        font-size: 16px;
                        font-weight: 700;
                        cursor: pointer;
                        box-shadow: 0 8px 24px rgba(26,58,107,0.3);
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                    "
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 32px rgba(26,58,107,0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(26,58,107,0.3)'"
                >
                    <span>Masuk ke Portal</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            <!-- Footer -->
            <div style="
                margin-top: 32px;
                padding-top: 24px;
                border-top: 1px solid #E5E7EB;
                text-align: center;
            ">
                <p style="
                    font-family: 'Inter', sans-serif;
                    font-size: 12px;
                    color: #9CA3AF;
                    margin: 0;
                ">
                    © {{ date('Y') }} SMA Negeri 5 Morotai. All rights reserved.
                </p>
            </div>
        </div>

        <style>
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </div>
</x-guest-layout>