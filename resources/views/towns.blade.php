@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Town
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <div class="alert alert-success" id="alert-success" role="alert" style=" display: none;">
                    <strong>Населенный пункт успешно добавлен!</strong> <a href="javascript:location.reload();" class="link">Перезагрузите</a> страницу.
                </div>
                <div id="validation-errors"></div>
                <!-- New Town Form -->
                <form action="{{ url('town')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Town Name -->
                    <div class="form-group">
                        <label for="town-name" class="col-sm-4 control-label">Название населенного пункта</label>

                        <div class="col-sm-6">
                            <input type="text" name="town" id="town-name" class="form-control" value="{{ old('town') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="town-population" class="col-sm-4 control-label">Население</label>

                        <div class="col-sm-6">
                            <input type="text" name="population" id="town-population" class="form-control" value="{{ old('population') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="town-lat" class="col-sm-4 control-label">Широта</label>

                        <div class="col-sm-6">
                            <input type="text" name="lat" id="town-lat" class="form-control" value="{{ old('lat') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="town-lon" class="col-sm-4 control-label">Долгота</label>

                        <div class="col-sm-6">
                            <input type="text" name="lon" id="town-lon" class="form-control" value="{{ old('lon') }}">
                        </div>
                    </div>

                    <!-- Add Town Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="button" class="btn btn-default" onClick="getMessage();">
                                <i class="fa fa-btn fa-plus"></i>Add Town
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Towns -->
        @if (count($towns) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Towns
            </div>

            <div class="panel-body">
                <table class="table table-striped town-table">
                    <thead>
                        <th>Town</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($towns as $town)
                        <tr>
                            <td class="table-text">
                                <table>
                                    <tr>
                                        <td>
                                            <div>{{ $town->town }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>{{ $town->population }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>{{ $town->lat }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>{{ $town->lon }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    function getMessage() {
        $('#validation-errors').html('');
        $('#alert-success').hide();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'ajax',
            data: {
                "town_name": $("#town-name").val(),
                "town_population": $("#town-population").val(),
                "town_lat": $("#town-lat").val(),
                "town_lon": $("#town-lon").val()
            },
            success: function(data) {
                $('#alert-success').show();
            },
            error: function(xhr) {
                $('#validation-errors').show();
                $('#validation-errors').html('');
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
                });
            }
        });
    }

</script>
@endsection
