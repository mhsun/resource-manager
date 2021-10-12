<header class="header sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container"><a class="navbar-brand" href="#">
                <strong class="h6 mb-0 font-weight-bold text-uppercase">The Company</strong></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (request()->is('administrator/*'))
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/administrator/attachments">PDFs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/administrator/snippets">HTML Snippets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/administrator/links">Links</a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/attachments">PDFs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/snippets">HTML Snippets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/links">Links</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</header>
