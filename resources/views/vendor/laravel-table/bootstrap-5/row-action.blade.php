<a wire:key="{{ Str::of($rowAction->identifier)->snake('-')->slug() }}-{{ $rowAction->modelKey }}"
   wire:click.prevent="rowAction('{{ $rowAction->identifier }}', '{{ $rowAction->modelKey }}', {{ $shouldBeConfirmed ? 1 : 0 }})"
   @class([...$class, 'p-1'])
   data-action="{{ $rowAction->identifier }}"
   data-id="{{ $rowAction->modelKey }}"
   href=""
   title="{{ $title }}"
   data-bs-toggle="tooltip">
    {!! $icon !!}
    (+)
</a>
