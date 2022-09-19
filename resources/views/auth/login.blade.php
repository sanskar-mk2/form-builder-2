<x-base-layout>
    <section>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('authenticate') }}" class="flex flex-col gap-4 mt-12">
            @csrf
            <input required placeholder="Email" value="{{ old('email') }}" name="email" type="email" class="input input-bordered w-full max-w-xs" >
            <input placeholder="Password" required name="password" type="password" class="input input-bordered w-full max-w-xs" >
            <input type="submit" class="btn w-fit btn-primary" >
        </form>
    </section>
</x-base-layout>
