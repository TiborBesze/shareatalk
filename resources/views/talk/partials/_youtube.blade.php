<div class="video-embed" style="padding-bottom: {{ round(($talk->height / $talk->width) * 100, 2) }}%">
    <iframe
        width="560"
        height="315"
        src="{{ str_replace('youtube', 'youtube-nocookie', $talk->embed_url) }}?rel=0&amp;showinfo=0"
        frameborder="0"
        gesture="media"
        allowfullscreen>
    </iframe>
</div>
