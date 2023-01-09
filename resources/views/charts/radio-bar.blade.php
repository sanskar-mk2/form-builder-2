<div class="w-1/3" x-data="alpine_bar()" x-init="make(@js($content->name), @js($content), @js($answers), pics)">
    <canvas id="{{ $content->name }}">
    </canvas>
</div>
