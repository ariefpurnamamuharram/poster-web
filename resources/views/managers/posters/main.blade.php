@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Poster Collections Manager</h3>

        <hr/>

        <div class="mt-2">
            <span>Total poster <span class="badge badge-primary">{{ count(Poster::get()) }}</span></span>
        </div>

        <div class="table-responsive pt-3">
            <table class="table table-hover">
                <thead>
                <tr class="table-primary text-center">
                    <th class="text-nowrap">ID</th>
                    <th class="text-nowrap">Title</th>
                    <th class="text-nowrap">Authors</th>
                    <th class="text-nowrap">Category</th>
                    <th class="text-nowrap">Total Likes</th>
                    <th class="text-nowrap">Total Dislikes</th>
                    <th class="text-nowrap">Total Comments</th>
                </tr>
                </thead>
                <tbody>
                @if(count($posters) != 0)
                    @foreach($posters as $poster)
                        <tr>
                            <td class="text-center text-nowrap">{{ $poster->id }}</td>
                            <td style="min-width: 240px; max-width: 320px">
                                <a class="text-decoration-none text-dark"
                                   href="{{ route('show.poster', $poster->id) }}">{{ $poster->poster_title }}</a>
                                <br/>
                                <span>[<a href="{{ route('administrator.manager.poster.edit', $poster->id) }}" class="text-warning">Edit</a>]
                                    [<a href="#" class="text-danger" data-toggle="modal" data-target="#modalDelete"
                                        data-poster-id="{{ $poster->id }}">Delete</a>]</span>
                            </td>
                            <td style="min-width: 240px;">{{ $poster->poster_authors }}</td>
                            <td class="text-center text-nowrap">
                                @switch($poster->poster_category)
                                    @case(1)
                                    <span>Diabetes melitus</span>
                                    @break
                                    @case(2)
                                    <span>Diabetic foot</span>
                                    @break
                                    @case(3)
                                    <span>Metabolic syndrome</span>
                                    @break
                                    @case(4)
                                    <span>Dyslipidemia</span>
                                    @break
                                    @case(5)
                                    <span>Obesity</span>
                                @endswitch
                            </td>
                            <td class="text-center text-nowrap">{{ $poster->total_likes }}</td>
                            <td class="text-center text-nowrap">{{ $poster->total_dislikes }}</td>
                            <td class="text-center text-nowrap">{{ $poster->total_comments }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="7">Belum ada data</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-2">
            {{ $posters->links() }}
        </div>
    </div>

    {{-- Delete dialog --}}
    @include('managers.posters.dialog.delete.dialog')
@endsection

@section('script')
    {{-- Delete dialog script --}}
    @include('managers.posters.dialog.delete.dialog_script')
@endsection
