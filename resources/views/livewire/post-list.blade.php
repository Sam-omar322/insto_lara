<div class="w-[60rem] mx-auto lg:m[95rem]">
    @forelse ($this->posts as $post)
        <livewire:post :post="$post" :wire:key="'post_'.$post->id"/>
    @empty
    <div class="max-w-2xl gap-8 mx-auto">
        {{__("There is no post yet")}}
    </div>
    @endforelse
</div>