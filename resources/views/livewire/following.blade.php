<div>
<li class="flex flex-col md:flex-row text-center rtl:ml-5 gap-2">
    <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
        {{$this->count}}
    </div>
    <button  onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} }})" class='text-neutral-500 md:text-black'>{{ __('Following') }}</button>
</li>
</div>
