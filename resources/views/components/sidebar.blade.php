<div
    class="px-5  h-screen fixed transform  xl:translate-x-0  ease-in-out transition duration-500 flex w-56 justify-start  items-start bg-blue-800 flex-col">


    <a href="{{ route('dashboard') }}" class="flex justify-center mt-5 w-full items-center">
        <h1 class=" text-center font-bold">
            <span class="text-gray-800 text-4xl">R</span><span class="text-3xl text-white">uralCare<span
                    class="text-4xl text-red-600 [text-shadow:_1px_1px_0_#fff]">+</span></span>
        </h1>
    </a>

    <div class="mt-6 text-sm flex flex-col justify-start items-center w-full  pb-5 ">
        <a href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'hover:bg-blue-500 text-white'}} flex justify-start  py-2 px-4 gap-2 items-center w-full rounded">
            <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <p class=" leading-4 ">Dashboard</p>
        </a>
        <a href="{{ route('ai-support') }}"
            class="{{ request()->routeIs('ai-support') ? 'bg-gray-100 text-gray-900' : 'hover:bg-blue-500 text-white'}} flex justify-start  py-2 px-4 gap-2 items-center w-full rounded">
            <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
            </svg>

            <p class=" leading-4">AI Health Support</p>
        </a>
        <a href="{{ route('inventory') }}"
            class="{{ request()->routeIs('inventory') ? 'bg-gray-100 text-gray-900' : 'hover:bg-blue-500 text-white'}} flex justify-start  py-2 px-4 gap-2 items-center w-full rounded">

            <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
            </svg>

            <p class=" leading-4">Inventory</p>
        </a>

        <a href="{{ route('patientRecord') }}"
            class="{{ request()->routeIs('patientRecord', 'patientInfo') ? 'bg-gray-100 text-gray-900' : 'hover:bg-blue-500 text-white'}} flex justify-start  py-2 px-4 gap-2 items-center w-full rounded">
            <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap=" round" stroke-linejoin="round"
                    d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>

            <p class=" leading-4">Patient Records</p>
        </a>
        <a href="{{ route('settings') }}"
            class="{{ request()->routeIs('settings') ? 'bg-gray-100 text-gray-900' : 'hover:bg-blue-500 text-white'}} flex justify-start  py-2 px-4 gap-2 items-center w-full rounded">
            <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <p class=" leading-4">Settings</p>
        </a>

        <!-- Log Out -->
        <form class="w-full" action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                class="flex justify-start items-center hover:bg-blue-500 w-full py-2 px-4 gap-2 focus:outline-none text-white  rounded">
                <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <p class=" leading-4">Log Out</p>
            </button>
        </form>

    </div>




    <a href="{{ route('dashboard') }}" class="absolute bottom-4 px-6 right-0 flex justify-between items-center w-full">
        <div class="flex justify-center items-center  space-x-2">
            <div>
                 @if(Auth::user()->profile_photo_base64)
                    <img class="rounded-full h-10 w-10 object-cover" src="data:image/png;base64,{{ Auth::user()->profile_photo_base64 }}" alt="avatar" />
                 @else
                <img class="rounded-full" src="https://i.ibb.co/L1LQtBm/Ellipse-1.png" alt="avatar" />
                @endif
                
            </div>
            <div class="flex justify-center flex-col items-start">
                <p class="cursor-pointer font-semibold text-sm leading-5 text-white">{{ auth()->user()->name }}</p>
                <p class="cursor-pointer text-xs leading-3 text-gray-300">{{ auth()->user()->email }}</p>
            </div>
        </div>


    </a>

</div>