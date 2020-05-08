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

                    <!-- New Town Form -->
                    <form action="{{ url('town')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Town Name -->
                        <div class="form-group">
                            <label for="town-name" class="col-sm-3 control-label">Town</label>

                            <div class="col-sm-6">
                                <input type="text" name="town" id="town-name" class="form-control" value="{{ old('town') }}">
                            </div>
                        </div>

                        <!-- Add Town Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
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
                                        <td class="table-text"><div>{{ $town->town }}</div></td>

                                        <!-- Town Delete Button -->
                                        <td>
                                            <form action="{{ url('town/'.$town->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
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
@endsection
