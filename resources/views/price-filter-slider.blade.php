<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <div
            x-ignore
            ax-load
            ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-price-filter', package: 'codewithdennis/filament-price-filter') }}"
            ax-load-css="{{ \Filament\Support\Facades\FilamentAsset::getStyleHref('filament-price-filter', package: 'codewithdennis/filament-price-filter') }}"
            x-data="priceFilterSlider({
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        })"
            class="filament-price-filter"
    >
        <span class="text-xs font-semibold">
            {{ $symbol }} {{ $getState() ?? 0 }}
        </span>

        <input x-model="state"
               type="range" min="{{ $min }}" max="{{ $max }}" value="0" step="{{ $steps }}"
               class="w-full slider mt-2"
        />
    </div>
</x-dynamic-component>