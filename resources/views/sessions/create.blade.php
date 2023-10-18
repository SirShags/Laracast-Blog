<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class='text-center font-bold text-xl'>
                Log In!
            </h1>

            <form method='POST' action='/sessions' class='mt-10'>
                @csrf

                <div class='mb-6'>
                    <label  for='email'
                            class='block mb-2 uppercase font-bold text-xs text-gray-700'
                    >
                        Email
                    </label>
                    <input  type='text'
                            class='border border-gray-400 p-2 w-full'
                            value='{{ old('email') }}'
                            name='email'
                            id='email'
                            required
                    >

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class='mb-6'>
                    <label  for='password'
                            class='block mb-2 uppercase font-bold text-xs text-gray-700'
                    >
                      Password
                    </label>
                    <input  type='password'
                            class='border border-gray-400 p-2 w-full'
                            name='password'
                            id='password'
                            required
                    >

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <x-submit-button>
                        Login
                    </x-submit-button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
