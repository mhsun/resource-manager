<x-app-layout>
    <slot name="content">
        <div class="row">
            @forelse($snippets as $snippet)
                <div class="col-md-6">
                    <x-snippet-tile :snippet="$snippet"/>
                </div>
            @empty
                No HTML snippet found.
            @endforelse
        </div>
    </slot>
</x-app-layout>
