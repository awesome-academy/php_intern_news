<div class="sidebar" data-color="red"
    data-image="{{ asset('bower_components/demo-lightdashboard-nnc/assets/img/sidebar-5.jpg') }}">

    <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

            -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                {{ Auth::user()->username }}
            </a>
        </div>

        <ul class="nav">
            <li class="active">
                <a id="l-dashboard" href="{{ route('admin.index') }}">
                    <i class="pe-7s-graph"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a id="l-writer" href="{{ route('admin.users.index') }}">
                    <i class="pe-7s-user"></i>
                    <p>{{ __('Writer Management') }}</p>
                </a>
            </li>
            <li>
                <a id="l-article" href="{{ route('admin.articles.index') }}">
                    <i class="pe-7s-note2"></i>
                    <p>{{ __('Article Management') }}</p>
                </a>
            </li>
            <li>
                <a id="l-category" href="{{ route('admin.categories.index') }}">
                    <i class="pe-7s-science"></i>
                    <p>{{ __('Category Management') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
