<div class="px-4 mb-3">
    @if ($this->likes > 0)
    {{ __('Liked By') }}
    <strong>
        <a href="/users/{{$this->firstname}}">{{ $this->firstname }}</a>
    </strong>
    @endif

    @if ($this->likes > 1)
    {{ __('and') }} <strong>{{ __('others') }}</strong>
    @endif
</div>
