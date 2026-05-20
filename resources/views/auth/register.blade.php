<x-layout title="Register">
    <x-form.form
        title="Register an account"
        description="Start tracking your ideas today"
    >
        <form action="/register" method="POST" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-4">
                <x-form.field label="Name" name="name" type="text" required />
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
                    <button class="btn" type="submit">Create Account</button>
                </div>
            </div>
        </form>
    </x-form.form>
</x-layout>
