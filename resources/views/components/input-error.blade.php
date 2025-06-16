@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
            {{ $message }}
        </div>
    @endforeach
@endif
