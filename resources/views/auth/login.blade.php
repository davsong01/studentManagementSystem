@extends('layouts.frontend')

@section('content')

<div class="w-full max-w-xs mx-auto">
    <div style="color:red;margin-bottom:20px">
    @include('layouts.alerts')

    </div>
    <div></div>
    <form method="POST" action="{{ route('login') }}" class="bg-white shadow rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Matric Number
            </label>
            <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="username" name="username" id="username" placeholder="Enter your matric no here" value="{{ old('username') }}">
            @error('username')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4" style="margin-bottom:0">
            <div style="float:left">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password (Your surname in Capital letters)</label>
            </div>
            {{-- <div style="float:right">
                <label class="ss"><input class="" type="checkbox" id="show" onclick="myFunction()"> Show password</label>
            </div>
             --}}
            
            <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="Your Surname is your default password" value="{{ old('password') }}">
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6 left">
            <label class="block text-gray-500 font-bold">
                <input class="mr-2 leading-tight" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="text-sm">
                    Remember Me
                </span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Sign In
            </button>
        </div>
        
    </form>
</div>
<script>
    // document.getElementById("#password").addEventListener("click", function(event){
    // event.preventDefault()
    // });
    // function myFunction() {
        
    //     var x = document.getElementById("#password");
    //     console.log(x);
    //     if (x.type === "password") {
    //         x.type = "text";
    //     } else {
    //         x.type = "password";
    //     }
    // };
   
</script>
@endsection
