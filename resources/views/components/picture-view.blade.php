<div style="border-width:4px" class="p-2" :class="{ 'border-4 border-green-500' : _.includes(contents[item.name], option.value)}" x-data="{pictures: @js($pictures)}">
    <img :src="_.find(pictures, {id: parseInt(option.value)})?.url" class="h-64" :alt="_.find(pictures, {id: parseInt(option.value)})?.name">
</div>