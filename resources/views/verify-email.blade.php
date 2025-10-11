<x-authentication-layout title="Dashboard">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <h1 class="text-4xl font-bold">
            <span class="text-gray-800">R</span><span class="text-white">uralCare+</span>
        </h1>
        <p class=" mt-1">
            <span class="text-white">Digital Health Records Management System</span>
        </p>
        <div class=" w-full bg-white rounded-lg shadow  mt-5 s  max-w-sm">
            <div class="p-6 ">
                <div>
                    <h1 class="font-semibold w-full text-center mb-4 text-lg">Verify your email</h1>
                </div>
                <form method="POST" class="space-y-6" action="{{ route('verify-email') }}">
                    @csrf
                    @if(session('error'))
                    <div id="alertMessage"
                        class="transition-opacity duration-1000 text-start text-sm text-red-700 border w-full border-red-200 bg-red-100 px-4 py-2 rounded mb-3">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-900 ">Enter the OTP code sent to your email</label>
                        <input type="number" name="otp"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="">
                    </div>
                    <div class="flex text-sm font-medium items-center justify-start">
    Did not receive OTP?
    <button type="button" id="resendBtn"
        class="ml-1 text-blue-500 hover:underline disabled:text-gray-400 disabled:cursor-not-allowed">
        Resend
    </button>
</div>



                    <button type="submit"
                        class="w-full text-white bg-blue-800 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg  px-5 py-2.5 text-center ">Verify</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    const resendBtn = document.getElementById('resendBtn');
    let endTime = sessionStorage.getItem('otp_resend_end'); // ms timestamp or null
    let intervalId = null;

    // set button to show remaining seconds and disable it
    function setButtonStateRemaining(seconds) {
        resendBtn.disabled = true;
        resendBtn.textContent = `${seconds}s`;
    }

    // enable button and set text to "Resend"
    function setButtonResend() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
        resendBtn.disabled = false;
        resendBtn.textContent = 'Resend';
        sessionStorage.removeItem('otp_resend_end');
    }

    // start countdown and save endTime to sessionStorage
    function startCountdown(seconds) {
        const now = Date.now();
        endTime = now + seconds * 1000;
        sessionStorage.setItem('otp_resend_end', endTime.toString());

        // immediately show state so there's no clickable gap
        setButtonStateRemaining(seconds);

        if (intervalId) clearInterval(intervalId);
        intervalId = setInterval(() => {
            const remaining = Math.ceil((parseInt(endTime, 10) - Date.now()) / 1000);
            if (remaining > 0) {
                setButtonStateRemaining(remaining);
            } else {
                setButtonResend();
            }
        }, 1000);
    }

    // resume countdown from sessionStorage if still valid
    function resumeCountdownFromStorage() {
        if (!endTime) return false;
        endTime = parseInt(endTime, 10);
        const now = Date.now();
        if (now < endTime) {
            const remaining = Math.ceil((endTime - now) / 1000);
            // set state immediately
            setButtonStateRemaining(remaining);

            if (intervalId) clearInterval(intervalId);
            intervalId = setInterval(() => {
                const rem = Math.ceil((endTime - Date.now()) / 1000);
                if (rem > 0) {
                    setButtonStateRemaining(rem);
                } else {
                    setButtonResend();
                }
            }, 1000);
            return true;
        } else {
            sessionStorage.removeItem('otp_resend_end');
            setButtonResend();
            return false;
        }
    }

    // on page load: try resume; if none, start automatically
    if (!resumeCountdownFromStorage()) {
        // If you want countdown to start automatically after OTP send, keep this.
        startCountdown(120);
    }

    // click handler: send POST via fetch and immediately prevent clicks
    resendBtn.addEventListener('click', async () => {
        if (resendBtn.disabled) return; // extra safety
        resendBtn.disabled = true;
        resendBtn.textContent = 'Sending...';

        try {
            const response = await fetch("{{ route('resend-otp') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            });

            if (response.ok) {
                // restart countdown (server sets otp_expires_at = now + 120s)
                startCountdown(120);
            } else {
                const data = await response.json().catch(() => null);
                resendBtn.textContent = data?.message || 'Error';
                resendBtn.disabled = false;
            }
        } catch (err) {
            resendBtn.textContent = 'Error';
            resendBtn.disabled = false;
        }
    });
</script>

</x-authentication-layout>