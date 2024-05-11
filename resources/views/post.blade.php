<x-layout>

    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
            <h2>{{ $post->title }}</h2>

            @can('update', $post)
                <span class="pt-2">
                    <a href="/post/{{$post->id}}/edit" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i
                            class="fas fa-edit"></i></a>
                    <form class="delete-post-form d-inline" action="/post/{{ $post->id }}" method="POST">
                        @csrf
                        <!--Cause HTML forms do not support DELETE method but Laravel does...-->
                        @method('DELETE')
                        <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                            title="Delete"><i class="fas fa-trash"></i></button>
                    </form>
                </span>
            </div>
        @endcan

        <p class="text-muted small mb-4">
            <a href="#"><img class="avatar-tiny"
                    src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
            Posted by <a href="#">{{ $post->getUserById->username }}</a> on
            {{ $post->created_at->format('F j, Y') }}
        </p>

        <div class="body-content">
            <!--Render content as HTML so post can support Markdown(Dangerous)-->
            {!! $post->content !!}
        </div>
    </div>

</x-layout>
