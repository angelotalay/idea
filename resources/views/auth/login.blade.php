<x-layout title="Login">
    <x-form title="Login" description="Login to your account">
        <form action="/login" method="POST" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-4">
                <x-form.field
                    label="Email"
                    name="email"
                    type="email"
                    required
                />
                <x-form.field
                    label="Password"
                    name="password"
                    type="password"
                    required
                />
                <div class="flex w-full justify-center">
                    <button class="btn" type="submit" data-test="login-button">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </x-form>
</x-layout>
