<article class="card mb-4" style="max-height: 300px; overflow: scroll">
    <div class="card-body">
        <p class="card-text">{{ $snippet->description }}</p>
        <div class="card pb-2">
            <div class="card-header">
                <button class="btn btn-sm btn-primary float-right snippet-{{$snippet->id}}"
                        onclick='copyToClipboard("snippet-{{$snippet->id}}")'>copy
                </button>
            </div>
            <div class="card-body">
                <code>
                    <pre id="snippet-{{$snippet->id}}">{{ $snippet->code }}</pre>
                </code>
            </div>
        </div>
    </div>
</article>
