<article class="study-listing">
    <h4 class="study-title"><a href="/study/{{ $study->slug }}">{!! $study->title !!}</a></h4>
    <p class="meta-data"><i class="fa fa-clock-o"></i> {!! date('F d, Y', strtotime($study->created_at)) !!}</p>
    <p class="excerpt">{!! $study->excerpt !!}</p>

    <a href="/study/{{ $study->slug }}">
        <button class="btn btn-secondary">
        Read More
        </button>
    </a>
</article>