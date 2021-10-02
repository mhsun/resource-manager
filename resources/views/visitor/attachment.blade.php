<x-app-layout>
    <slot name="content">
        <div class="row">
            @forelse($attachments as $attachment)
                <div class="col-4">
                    <div class="card m-1" style="max-height: 200px;overflow: scroll">
                        <div class="card-header">
                            <a href="{{ route('attachment.download', $attachment->id) }}">
                                <button class="btn btn-sm btn-primary float-right">Download</button>
                            </a>
                        </div>
                        <div class="card-body">
                            {{ $attachment->title }}
                        </div>
                    </div>
                </div>
            @empty
                <p>No pdf found</p>
            @endforelse
        </div>
    </slot>
</x-app-layout>
