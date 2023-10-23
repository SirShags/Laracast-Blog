<!doctype html>

<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<!-- {{-- @vite('resources/css/app.css') --}} -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    html {
        scroll-behavior: smooth;
    }

    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line {
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
                </a>
            </div>

            <div class="flex items-center mt-8 md:mt-0">
                @auth
                    <x-dropdown>
                        <x-slot name='trigger'>
                            <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}
                        </x-slot>

                        <form method="POST" action="/logout" class="ml-6 text-xs font-semibold text-blue-500 pr-6">
                            @csrf

                            @if (auth()->user()?->username == 'JeffWay')
                                <a href="/admin/posts/create" class='block mb-1'>
                                    Create Post
                                </a>
                            @endif

                            <button type="submit" class='block'>Log Out</button>
                        </form>
                    </x-dropdown>

                    <!-- {{-- <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</span>

                    <form method="POST" action="/logout" class="ml-6 text-xs font-semibold text-blue-500">
                        @csrf

                        <button type="submit">Log Out</button>
                    </form> --}} -->
                @else
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>
                    <a href="/login" class="ml-6 text-xs font-bold uppercase">Log In</a>
                @endauth

                <a href="#newsletter"
                    class="px-5 py-3 ml-3 text-xs font-semibold text-white uppercase bg-blue-500 rounded-full">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

        {{ $slot }}

        <footer id='newsletter' class="px-10 py-16 mt-16 text-center bg-gray-100 border border-black border-opacity-5 rounded-xl">
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="mt-3 text-sm">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto rounded-full lg:bg-gray-200">

                    <form method="POST" action="/newsletter" class="text-sm lg:flex">
                        @csrf

                        <div class="flex items-center lg:py-3 lg:px-5">
                            <label for="email"
                                   class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <div>
                                <input  id="email"
                                        name='email'
                                        type="text"
                                        placeholder="Your email address"
                                        class="py-2 pl-4 lg:bg-transparent lg:py-0 focus-within:outline-none">

                                @error('email')
                                    <span class="text-xs text-red-500">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="px-8 py-3 mt-4 text-xs font-semibold text-white uppercase transition-colors duration-300 bg-blue-500 rounded-full hover:bg-blue-600 lg:mt-0 lg:ml-3">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>

    <x-flash />
</body>
