<x-base-layout>
    <section x-data="{survey:@js($survey), answers:@js($survey->answers)}">
        @foreach ($survey->contents as $content)
            @if($content->type == 'select')
                @include('charts.select-pie', ['content' => $content, 'answers' => $survey->answers->pluck('contents')->pluck($content->name)])
            @endif
        @endforeach
    </section>
</x-base-layout>
