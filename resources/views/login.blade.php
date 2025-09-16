<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Care +</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="{{ asset ('assets/js/tailwind.config.js') }}"></script>
</head>

<body>
    <section class="bg-blue-800 ">
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
                
                    <h1 class="font-semibold w-full text-center mb-4 text-lg">Welcome to RuralCare+</h1>
                    </div>
                    <form method="POST" class="space-y-6" action="{{ route('sign.in') }}">
                        @csrf
                        <div>
                            <label 
                                class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                            <input type="email" name="email" id="email"
                                class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                                placeholder="2039912@ruralcareplus.com" required="">
                        </div>
                        <div>
                            <label 
                                class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  "
                                required="">
                        </div>
                        <div class="flex items-center justify-between">      
                            <a href="#"
                                class="text-sm font-medium text-primary-600 hover:underline">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-800 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg  px-5 py-2.5 text-center ">Sign
                            in</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>