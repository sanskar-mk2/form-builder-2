<div class="w-1/3" x-data="alpine_pie()" x-init="make(@js($content->name), @js($content), @js($answers))">
    <canvas id="{{ $content->name }}">
    </canvas>
</div>