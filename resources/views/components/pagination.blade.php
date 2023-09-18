<div style="display: flex; gap:2rem; justify-content:center;">
    @foreach ($pages as $page)
        <div>
            <a href="{{ $page['url'] }}">{{ $page['text'] }}</a>
        </div>
    @endforeach
</div>