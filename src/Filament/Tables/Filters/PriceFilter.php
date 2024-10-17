<?php

namespace CodeWithDennis\FilamentPriceFilter\Filament\Tables\Filters;

use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;

class PriceFilter extends Filter
{
    public Closure | string | null $currency = null;

    public Closure | string | null $column = null;

    public Closure | string | null $locale = null;

    public Closure | bool | null $cents = null;

    public Closure | bool | null $slider = false;

    public Closure | int $steps = 1;

    public static function getDefaultName(): ?string
    {
        return 'priceFilter';
    }

    public function currency(Closure | string | null $currency = null, Closure | string | null $locale = null, Closure | bool $cents = true, Closure | string | null $column = null): static
    {
        $this->currency = $currency;
        $this->locale = $locale;
        $this->cents = $cents;
        $this->column = $column;

        return $this;
    }

    public function slider(Closure | bool | null $slider = true): static
    {
        $this->slider = $slider;

        return $this;
    }

    public function steps(Closure | int $steps): static
    {
        $this->steps = $steps;

        return $this;
    }

    public function getSteps(): int
    {
        return $this->evaluate($this->steps);
    }

    public function getSlider(): string
    {
        return $this->evaluate($this->slider);
    }

    public function getCurrency(): string
    {
        if ($this->currency === null) {
            return config('filament-price-filter.currency');
        }

        return $this->evaluate($this->currency);
    }

    public function getLocale(): string
    {
        if ($this->locale === null) {
            return config('app.locale');
        }

        return $this->evaluate($this->locale);
    }

    public function getColumn(): string
    {
        if ($this->column === null) {
            return config('filament-price-filter.column');
        }

        return $this->evaluate($this->column);
    }

    public function getCents(): bool
    {
        if ($this->cents === null) {
            return config('filament-price-filter.cents');
        }

        return $this->evaluate($this->cents);
    }

    // TODO: This is a workaround and need to find a better way to get the currency symbol
    protected function getCurrencySymbol(string $currency): string
    {
        $formatter = Number::currency(number: 0, in: $currency);

        return str($formatter)->before('0');
    }

    protected function setUp(): void
    {
        parent::setUp();

        // TODO: Grab the slider settings, right now its not grabbing the settings
        //        $sliderView = $this->getSlider() ? 'filament-price-filter::price-filter-slider' : null;

        $sliderView = 'filament-price-filter::price-filter-slider';

        $viewData = [
            'symbol' => $this->getCurrencySymbol($this->getCurrency()),
            'steps' => $this->getSteps(),
        ];

        $this->form([
            TextInput::make('from')
                ->label(__('Price range from'))
                ->prefix(fn () => $this->getCurrencySymbol($this->getCurrency()))
                ->numeric()
                ->view($sliderView, $viewData),
            TextInput::make('to')
                ->label(__('Price range to'))
                ->prefix(fn () => $this->getCurrencySymbol($this->getCurrency()))
                ->numeric()
                ->view($sliderView, $viewData),
        ]);

        $this->indicateUsing(function (array $data) {
            $from = isset($data['from']) && is_numeric($data['from']) ? Number::currency(number: (float) $data['from'], in: $this->getCurrency(), locale: $this->getlocale()) : null;
            $to = isset($data['to']) && is_numeric($data['to']) ? Number::currency(number: (float) $data['to'], in: $this->getCurrency(), locale: $this->getlocale()) : null;

            $fromIndicator = $from !== null ? __('Price range from') . ": $from" : null;
            $toIndicator = $to !== null ? __('Price range to') . ": $to" : null;

            if ($from !== null && $to !== null) {
                return "{$fromIndicator} - {$toIndicator}";
            }

            return $fromIndicator ?: $toIndicator;
        });

        $this->query(function (Builder $query, array $data) {
            $cents = $this->getCents();

            return $query
                ->when($data['from'] !== null, function (Builder $query) use ($cents, $data) {
                    return $query->where($this->getColumn(), '>=', $cents ? (float) $data['from'] * 100 : (float) $data['from']);
                })
                ->when($data['to'] !== null, function (Builder $query) use ($data, $cents) {
                    return $data['to'] > 0
                        ? $query->where($this->getColumn(), '<=', $cents ? (float) $data['to'] * 100 : (float) $data['to'])
                        : $query->where($this->getColumn(), 0);
                });
        });

    }
}
