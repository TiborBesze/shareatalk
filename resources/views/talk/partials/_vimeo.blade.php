<div class="video-embed" style="padding-bottom: {{ round(($talk->height / $talk->width) * 100, 2) }}%">
    <iframe
        src="{{ str_replace('?autoplay=1', '', $talk->embed_url) }}"
        width="640"
        height="360"
        frameborder="0"
        autoplay="0"
        webkitallowfullscreen
        mozallowfullscreen
        allowfullscreen>
    </iframe>
</div>
