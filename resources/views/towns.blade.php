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
                                <button type="button" class="btn btn-default"  onClick="getMessage();">
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
            $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),					
					'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                type: 'POST',
                url: 'ajax',
                data: {
					"town_name": $("#town-name").val()
				},
                success: function(data) {
                    $("#msg").html(data.msg);
                }
            });
        }

    </script>
@endsection
