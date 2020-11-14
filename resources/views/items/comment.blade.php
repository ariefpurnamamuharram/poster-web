<section>
    <div class="row">
        {{-- Avatar --}}
        <div class="col-md-1">
            <img src="{{ asset('assets/images/avatar.png') }}" height="54px" alt="Avatar">
        </div>

        <div class="col-md-11">
            {{-- Name --}}
            <span>
                <span class="font-weight-bold">{{ $comment->name }}</span> says:
            </span>

            <br/>

            {{-- Date and time --}}
            <span class="text-secondary">
                {{ date('F j, Y', strtotime($comment->created_at)) }} at {{ date('H:i', strtotime($comment->created_at)) }}
            </span>
        </div>
    </div>

    <br/>

    {{-- Comment --}}
    <div>
        {{ $comment->comment }}
    </div>
</section>
