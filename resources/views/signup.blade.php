<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="../../public/tes.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 min-h-screen flex flex-col justify-center items-center px-6">
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
    <div class=" mt-5 mb-10 max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-4">Sign up</h1>
        <form action="{{route('signup.post')}}" method="POST">
            <div class=" space-y-2 sm:space-y-6">
                <div>
                    <label for="email" class="block text-xs sm:text-sm font-medium text-gray-300">Email</label>
                    <input id="email" name="email" placeholder="Ex: aaaaa@email.com" type="email" class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-300">Username</label>
                    <input id="name" name="name" placeholder="Your username.." type="text" class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
                <div>
                    <label for="password" class="block text-xs sm:text-sm font-medium text-gray-300">Password</label>
                    <input id="password" name="password" placeholder="Your password.." type="password" class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
                <div>
                    <label for="age" class="block text-xs sm:text-sm font-medium text-gray-300">Age</label>
                    <input id="age" name="age" type="number" placeholder="Your age.." class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
                <div>
                    <label for="address" class="block text-xs sm:text-sm font-medium text-gray-300">Address</label>
                    <input id="address" name="address" type="text" placeholder="Your address.." class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
                <div>
                    <label for="phone_number" class="block text-xs sm:text-sm font-medium text-gray-300">Phone Number</label>
                    <input id="phone_number" name="phone_number" placeholder="Ex: 000012345678" type="tel" pattern="[0-9]{12}" class="sm:mt-1 text-white p-5 sm:p-6 h-6 bg-gray-700  block w-full shadow-md text-xs sm:text-sm border-gray-600 rounded-md">
                </div>
            </div>
            <button type="submit" class="w-full mt-6 sm:mt-12 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300">Sign up</button>
        </form>
        <p class="text-center text-xs sm:text-sm text-gray-300 mt-2">Already have an account? <a href="/signin" class="text-blue-500 hover:underline">Sign in</a></p>
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
</script>
</html>
