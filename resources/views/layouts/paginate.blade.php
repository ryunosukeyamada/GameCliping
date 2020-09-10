<div class="mt-5 d-flex justify-content-center">
    @if ($clips->hasPages())
        {{ $clips->links('pagination.default') }}
    @else
        <div class="g_pager">
            <a class="prev"></a>
            <a class="current" href="">1</a>
            <a class="next"></a>
        </div>
    @endif
</div>
