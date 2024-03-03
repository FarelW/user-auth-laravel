<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HomePage</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('tes.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 min-h-screen text-white">
    <div class="fixed bottom-0 right-0 p-4 m-4">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="toast w-[325px] bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-md opacity-0 transition-opacity duration-300">
                    <div>{{ $error }}</div>
                    <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 mr-2 mt-1 text-red-700">&times;</button>
                </div>
            @endforeach
        @endif
        @if(session()->has("error"))
            <div id="errorToast" class="toast w-[325px] mt-10 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 max-w-md opacity-0 transition-opacity duration-300">
                {{ session("error") }}
                <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 mr-2 mt-1 text-red-700">&times;</button>
            </div>
        @endif
        @if(session()->has("success"))
            <div id="successToast" class="toast w-[325px] mt-10 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 max-w-md opacity-0 transition-opacity duration-300">
                {{ session("success") }}
                <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 mr-2 mt-1 text-green-700">&times;</button>
            </div>
        @endif
    </div>
    <div class="bg-gray-800 py-4 flex justify-between">
        <a href="{{ url('/') }}" class="pl-4 bg-gray-800">
            <img src="https://i.ibb.co/xHDc5KR/tes.png" alt="Logo" class=" h-6 sm:h-8 w-auto">
        </a>
        @if (Auth::check())
            <form action="{{ url('/signout') }}" method="GET">
                @csrf
                <button type="submit" class="sm:text-sm text-xs mr-4 bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded transition duration-300">Signout</button>
            </form>
        @else
            <a href="{{ url('/signin') }}" class="sm:text-sm text-xs mr-4 bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded transition duration-300">Signin</a>
        @endif
    </div>
    <div class="flex justify-center items-center mt-20 px-6">
        @if (Auth::check())
            <form action="{{route('updateuser')}}" method="POST">
            @csrf
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h1 class="text-2xl font-semibold text-white mb-4 text-center">Profile</h1>
                    <div class="text-white flex flex-col">
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Name</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base">
                                <strong>:</strong>
                                <input type="text" id="nameInput" name="name" value="{{ auth()->user()->name }}" readonly class=" h-6 sm:h-8 rounded p-2 bg-inherit"></input>
                                <button type="button" onclick="changeValue('name')"><img src="https://svgshare.com/i/13rG.svg"/></button>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Email</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base">
                                <strong>:</strong>
                                <input type="text" id="emailInput" name="email" value="{{ auth()->user()->email }}" readonly class=" h-6 sm:h-8 rounded p-2 bg-inherit"></input>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text- text-xs sm:text-base"><strong>Age</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base">
                                <strong>:</strong>
                                <input type="text" id="ageInput" name="age" value="{{ auth()->user()->age }}" readonly class=" h-6 sm:h-8 rounded p-2 bg-inherit"></input>
                                <button type="button" onclick="changeValue('age')"><img src="https://svgshare.com/i/13rG.svg"/></button>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Address</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base">
                                <strong>:</strong>
                                <input type="text" id="addressInput" name="address" value="{{ auth()->user()->address }}" readonly class=" h-6 sm:h-8 rounded p-2 bg-inherit"></input>
                                <button type="button" onclick="changeValue('address')"><img src="https://svgshare.com/i/13rG.svg"/></button>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Phone Number</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base">
                                <strong>:</strong>
                                <input type="text" id="phoneInput" name="phone_number" value="{{ auth()->user()->phone_number }}" readonly class=" h-6 sm:h-8 rounded p-2 bg-inherit"></input>
                                <button type="button" onclick="changeValue('phone')"><img src="https://svgshare.com/i/13rG.svg"/></button>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Created at</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base"><strong>:</strong><span class="pl-4">{{ auth()->user()->createdAt }}</span></div>
                        </div>
                        <div class="flex mb-2 mt-2">
                            <div class=" w-[80px] sm:w-40 text-xs sm:text-base"><strong>Last updated at</strong></div>
                            <div class="sm:ml-10 text-xs sm:text-base"><strong>:</strong><span class="pl-4">{{ auth()->user()->updatedAt }}</span></div>
                        </div>
                        <div class="flex justify-end mt-4 sm:mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-300">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <h1 class="text-5xl mb-4 text-center">Welcome to The Website!</h1>
        @endif
    </div>
</body>
<script>
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    });

    function changeValue(field) {
        var input = document.getElementById(field + 'Input');
        if (input.hasAttribute('readonly')) {
            input.removeAttribute('readonly');
            input.classList.remove('bg-inherit');
            input.classList.add('bg-gray-700');
        } else {
            input.setAttribute('readonly', true);
            input.classList.remove('bg-gray-700');
            input.classList.add('bg-inherit');
        }
    }
</script>
</html>