@extends('admin.layouts.main')

@section('content')




    <div class="container-fluid">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-body table-responsive p-0">

                        <div id="tableContainer"></div>
                        <input name="calendar_id" value="2" hidden="">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th class="col-2">Name</th>
                                <th class="col-1">Alpha Code</th>
                                <th class="col-2">Full alpha code</th>
                                <th class="col-2">Numeric code</th>
                                <th class="col-2">Is enabled</th>
                            </tr>
                            </thead>
                            <tbody id="sortable" style="cursor: pointer;" class="ui-sortable">
                            @foreach($countries as $country)
                            <tr data-id="{{$country->id}}">
                                <td>
                                    {{$country->country['name']['en']}}
                                </td>

                                <td>
                                    {{$country->country['alpha_code']}}
                                </td>

                                <td>
                                    {{$country->country['full_alpha_code']}}
                                </td>

                                <td>
                                    {{$country->country['numeric_code']}}
                                </td>

                                <td>
                                    <input class="CountryEnabled form-check-input" type="checkbox" value="" {{$country->is_enabled == 0?"":"checked"}}   id="flexCheckDefault">
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <!-- /.card-body -->
                    </div>

                </div>
                <button class="col-2 btn btn-primary mt-3 ml-4 mb-3" id="SavePriority">Save Priority</button>

            </div>
            <!-- /.row -->
        </div>
    </div><!-- /.container-fluid -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#SavePriority").click(function() {
                let idsArray = {};
                let i = 1;
                $("#sortable tr").each(function() {
                    let id = $(this).data('id');
                    idsArray[id] = i;
                    i++;
                });
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log(idsArray);
                let dataToSend = {
                    idsArray: idsArray
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/countries/changePriority',
                    method: 'PUT',
                    data: dataToSend,
                    success: function(response) {
                        alert('Saved');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });


            $(".CountryEnabled").click(function() {
                let trElement = $(this).closest('tr');
                let id = trElement.data('id');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let dataToSend = {
                    id: id,
                }
                console.log(csrfToken);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/setCalendarCountry',
                    method: 'PUT',
                    data: dataToSend,
                    success: function(response) {
                        console.log("Good");
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

    </script>
@endpush
