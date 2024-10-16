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
            class="price-filter-slider"
    >
        <span class="text-xs font-bold">
            {{ $symbol }} {{ $getState() ?? 0 }}
        </span>

        <input x-model="state"
               type="range" min="0" max="10000" value="0" step="100"
               class="w-full slider mt-2 bg-gray-50 dark:bg-gray-950 rounded-md"/>
    </div>
</x-dynamic-component>