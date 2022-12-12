<div class="flex items-center" x-data="{image:'', images: @js($pictures)}">
    <select x-model="option.option"
        class="input input-bordered w-full max-w-xs"
        x-on:change="option.value=slugify(option.option)">
        <option value="">
            Select Picture
        </option>
        @foreach ($pictures as $picture)
            <option value="{{ $picture->id }}">
                {{ $picture->name }}
            </option>
        @endforeach
    </select>
    <img x-show="option.option" class="h-32" :src="_.find(images, {id: parseInt(option.option)})?.url"
        alt="_.find(images, {id: parseInt(option.option)})?.name">
</div>
