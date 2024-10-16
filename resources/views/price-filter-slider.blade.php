<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <div
            x-ignore
            ax-load
            ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-price-filter', package: 'codewithdennis/filament-price-filter') }}"
            x-data="priceFilterSlider({
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        })"
    >
        <span class="text-xs">
            {{ $symbol }}  {{ $getState() ?? 0 }}
        </span>
        <input x-model="state" type="range" min="0" max="100" value="0" step="5" class="w-full"/>
    </div>
</x-dynamic-component>