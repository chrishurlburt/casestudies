<article class="study-listing">
    <h4 class="study-title"><a href="/study/{{ $study->slug }}">{!! $study->title !!}</a></h4>
    <p class="meta-data"><i class="fa fa-clock-o"></i> {!! date('F d, Y', strtotime($study->created_at)) !!}</p>
    <p class="excerpt">{!! $study->excerpt !!} <a href="/study/{{ $study->slug }}">Read More <i class="fa fa-arrow-right"></i></a></p>
</article>