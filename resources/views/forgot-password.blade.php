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
                    <h1 class="font-semibold w-full text-center mb-4 text-lg">Forgot password</h1>
                </div>
                <form method="POST" class="space-y-6" action="{{ route('forgot-password') }}">
                    @csrf
                    @if(session('error'))
                    <div id="alertMessage"
                        class="transition-opacity duration-1000 text-start text-sm text-red-700 border w-full border-red-200 bg-red-100 px-4 py-2 rounded mb-3">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="2039912@ruralcareplus.com" required="">
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-primary-600 hover:underline">Continue with password.</a>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-800 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg  px-5 py-2.5 text-center ">Reset password</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    sessionStorage.clear();
</script>
</x-authentication-layout>