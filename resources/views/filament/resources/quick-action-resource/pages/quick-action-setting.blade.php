<x-filament-panels::page>
    <form wire:submit="update">
        {{ $this->form }}
        <button type="submit"class="inline-block w-full px-8 py-3 mb-0 mt-3 font-bold text-center text-white uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" style="background: #19a5a1;">
            Submit
        </button>
    </form>
    <x-filament-actions::modals />
</x-filament-panels::page>
