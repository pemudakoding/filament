<?php

use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Component;
use Filament\Tests\Forms\Fixtures\Livewire;
use Filament\Tests\TestCase;
use Illuminate\Support\Str;

uses(TestCase::class);

test('component state binding is deferred by default', function () {
    $component = (new Component())->container(ComponentContainer::make(Livewire::make()));

    expect($component)
        ->getStateBindingModifiers()->toBe(['defer']);
});

test('component state binding can be reactive', function () {
    $component = (new Component())
        ->container(ComponentContainer::make(Livewire::make()))
        ->reactive();

    expect($component)
        ->getStateBindingModifiers()->toBe([]);
});

test('component state binding can be lazy', function () {
    $component = (new Component())
        ->container(ComponentContainer::make(Livewire::make()))
        ->lazy();

    expect($component)
        ->getStateBindingModifiers()->toBe(['lazy']);
});

test('component state binding can be debounced', function () {
    $component = (new Component())
        ->container(ComponentContainer::make(Livewire::make()))
        ->debounce('750ms');

    expect($component)
        ->getStateBindingModifiers()->toBe(['debounce', '750ms']);
});

test('components inherit their state binding modifiers', function () {
    $component = (new Component())
        ->container(
            ComponentContainer::make(Livewire::make())
                ->parentComponent(
                    (new Component())->stateBindingModifiers($modifiers = [Str::random()]),
                ),
        );

    expect($component)
        ->getStateBindingModifiers()->toBe($modifiers);
});
