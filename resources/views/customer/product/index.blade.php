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
                    <div class="col-1">
                        <a href="{{route('customer.product.create')}}" class="btn btn-primary">Create</a>
                    </div>
                    <div class="col-12 mt-2">

                        <div class="card">

                            <div class="card-body table-responsive p-0 ">
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-5">Title</th>
                                        <th class="col-1">Price</th>
                                        <th class="col-1">Max quantity</th>
                                        <th class="col-4"  colspan="3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable" style="cursor: pointer;" class="text-center">
                                    @foreach($products as $key => $product)
                                        <tr data-id="{{$product->id}}">
                                            <td  class="col-1">{{$product->id}}</td>
                                            @foreach($product['title'] as $lg => $item)
                                                @if(\Illuminate\Support\Facades\Cookie::get('locale') == $lg)
                                                    <td class='col-5'>{{ $item }}</td>
                                                @endif
                                            @endforeach
                                            @foreach($product['price'] as $lg => $item)
                                                @if(\Illuminate\Support\Facades\Cookie::get('locale') == $lg)
                                                    <td class='col-1'>{{ $item }}</td>
                                                @endif
                                            @endforeach
                                            <td  class="col-1">{{$product->max_qty}}</td>
                                                <td class="col-1">
                                                    <a class="showProduct" href="#" data-route="{{ route('customer.product.show', $product->id) }}" data-toggle="modal" data-target="#showMyModal">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td class="col-2"><a href="{{route('customer.product.edit', $product->id)}}"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td class="col-1">
                                                    <form action="{{route('customer.product.delete',$product->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="bg-transparent border-0">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <button class="btn btn-primary mt-2 SaveProducts">Save priority</button>
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
            $(".SaveProducts").click(function() {
                let idsArray = {};
                let i = 1;
                $("#sortable tr").each(function() {
                    let id = $(this).data('id');
                    idsArray[id] = i;
                    i++;
                });
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let dataToSend = {
                    idsArray: idsArray
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url: '/product/changePriority',
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
