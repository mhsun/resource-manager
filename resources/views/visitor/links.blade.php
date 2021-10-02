<x-app-layout>
    <slot name="content">
        <div class="row">
            @forelse($links as $link)
                <div class="col-md-3">
                    <a href="{{ $link->url }}" target="{{ $link->new_tab ? '_blank' : '' }}">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center">
                                    <span><small class="font-weight-bold">{{ $link->title }}</small></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                No Link found.
            @endforelse
        </div>
    </slot>
</x-app-layout>
