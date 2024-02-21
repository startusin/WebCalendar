@extends('admin.layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard products</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-6">Key</th>
                                        <th class="col-6">Is_required</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    @foreach($settings as $key => $item)
                                        <tr data-id="{{$item->id}}">
                                            <td  class="col-1">{{$item->key}}</td>
                                            <td  class="col-1">
                                                <input class="FormCheckbox form-check-input" type="checkbox" value="" {{$item->is_required == 0?"":"checked"}}   id="flexCheckDefault">
                                            </td>

{{--                                            <td class="col-1">--}}
{{--                                                <form action="{{route('customer.product.delete',$product->id)}}" method="POST">--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    @csrf--}}
{{--                                                    <button type="submit" class="bg-transparent border-0">--}}
{{--                                                        <i class="fas fa-trash text-danger"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
            @include('customer.product.modals.showMyModal')
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".FormCheckbox").click(function() {
                let trElement = $(this).closest('tr');

                let id = trElement.data('id');

                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                let dataToSend = {
                    id: id
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/changeFormSettings',
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
