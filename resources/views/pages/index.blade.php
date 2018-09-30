@extends('layouts.app')
<!-- View voor pagina lijst in de backend -->
@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
    @endif
    <br />
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Create</a>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th></th>
            </tr>
        </thead>

        @foreach ($pages as $page)
            <tr>
                <td>
                    <a href="{{ route('pages.edit', ['page' => $page->id])}}">{{ $page->title }}</a> <!-- paddedTitle enzo verwijderen -->
                </td>
                <td>{{ $page->url }}</td>
                <td class="text-right">
                    <!-- Waarschuwing bij het verwijderen van een post -->
                    <a href="{{ route('pages.destroy', ['page' => $page->id])}}" class="btn btn-danger delete-link"
                        data-message="Are you sure you want to delete this page?"
                        data-form="delete-form">
                            Delete
                    </a>

                </td>
            </tr>

        @endforeach

    </table>

    {{ $pages->links() }}
</div>
<!-- Voor het verwijderen van een post moet dit eerst mogelijk worden gemaakt met method_field('DELETE') -->
<form id="delete-form" action="" method="POST">
    {{ method_field('DELETE') }}
    {!! csrf_field() !!}
</form>

@endsection
