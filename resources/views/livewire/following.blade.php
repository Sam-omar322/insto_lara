<div>
<li class="flex flex-col md:flex-row text-center rtl:ml-5 gap-2">
    <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
        {{$this->count}}
    </div>
    @if ($this->user->private_account)
    <button class='text-neutral-500 md:text-black'>{{ __('Following') }}</button>
    @else
    <button  onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} }})" class='text-neutral-500 md:text-black'>{{ __('Following') }}</button>
    @endif
</li>
</div>
