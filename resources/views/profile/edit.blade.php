<x-layout title="Edit Account">
    <x-form.form title="Edit your account" description="Need to make a tweak?">
        <form action="/profile" method="POST" class="mt-8 space-y-6">
            @csrf
            @method("PATCH")
            <div class="space-y-4">
                <x-form.field
                    label="Name"
                    name="name"
                    type="text"
                    :value="$user->name"
                    required
                />
                <x-form.field
                    label="Email"
                    name="email"
                    type="email"
                    :value="$user->email"
                    required
                />
                <x-form.field
                    label="New Password"
                    name="password"
                    type="password"
                />

                <div class="flex w-full justify-center">
                    <button class="btn" type="submit">Update Account</button>
                </div>
            </div>
        </form>
    </x-form.form>
</x-layout>
