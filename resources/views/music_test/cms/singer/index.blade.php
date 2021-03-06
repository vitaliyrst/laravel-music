@extends('music_test.layouts.app')

@section('title-block')Albums @endsection

@section('breadcrumbs', \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('Cms-Singers'))

@section('content')

    <div>
        <div class="row mb-3">
            <div class="col-3">
                <a class="btn btn-dark btn-block active" role="button" aria-pressed="true"
                   href="{{ route('cms.music.singers.create') }}">Новая запись</a>
            </div>
            <div class="col-3">
                <a class="btn btn-dark btn-block active" role="button" aria-pressed="true"
                   href="{{ route('cms.music.groups.index') }}">Группы</a>
            </div>
            <div class="col-3">
                <a class="btn btn-dark btn-block active" role="button" aria-pressed="true"
                   href="{{ route('cms.music.albums.index') }}">Альбомы</a>
            </div>
            <div class="col-3">
                <a class="btn btn-dark btn-block active" role="button" aria-pressed="true"
                   href="{{ route('cms.music.songs.index') }}">Треки</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group mb-5">
                    <label for="group">Выберите группу</label>
                    <select name="id" class="form-control bg-dark text-white" id="group">
                        <option disabled selected>Выберите группу</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">
                                {{ $group->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-active">
                    <thead>
                    <tr class="bg-dark text-white">
                        <th>id</th>
                        <th>исполнитель</th>
                        <th>позиция</th>
                        <th>пользователь</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="singer">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#group').on('change', function () {
                let group_id = $(this).val();
                if (group_id) {
                    $.ajax({
                        url: '/cms/ajax/singer/' + group_id,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            $('tbody[id="singer"]').empty();
                            $.each(data, function (key, value) {
                                $('tbody[id="singer"]').append
                                (
                                    `<tr><td>${value['id']}</td>
                                    <td>${value['id']}</td>
                                    <td>${value['name']}</td>
                                    <td>${value['position']}</td>
                                    <td>${value['user']['name']}</td>
                                    <td><a class="text-dark" href="/cms/singers/${value['id']}/edit">
                                    <img src="/storage/buttons/edit.png" class="edit-img"></a>
                                    <button class="btn-1" form="delete">
                                    <img src="storage/buttons/delete.png" class="edit-img">
                                    </button></td></tr>`
                                );
                            });
                        }
                    });
                }
            })
        })
    </script>
@endsection

