<div>
    @if ($follow_state == 'Pending')
    <div class="flex flex-row gap-3">
        <span class="{{$this->pendding_classes}} rounded text-center">
            {{ __('Pending') }}
        </span>
        <button wire:click="cancel_request" class="{{$this->cancel_classes}} rounded text-center">
            {{ __('Cancel') }}
        </button>
    </div>
    @else
    <button wire:click="toggle_follow" class="{{$this->classes}} rounded text-center">
        {{ __($follow_state) }}
    </button>
    @endif
</div>
