@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard History</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12 mt-2">
                        <form class="col-12" action="{{route('purchase.index')}}" method="GET">
                            <div class="row form-group justify-content-between mb-3">
                                <div class="col-10">
                                    <input  class="form-control" name="search" value="{{$search??""}}" type="text" style="border-radius: 55px;" placeholder="Search">
                                </div>
                                <div class="col-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap ">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="col-1"><a
                                                href="{{route('purchase.index', ['SortName'=>"customId", "SortBy" => $sortBy??"asc"])}}">ID</a>
                                        </th>
                                        <th class="col-2">Buyer</th>
                                        <th class="col-2"><a
                                                href="{{route('purchase.index', ['SortName'=>"total_sold_price", "SortBy" => $sortBy??"asc"])}}">Sold
                                                price</a></th>
                                        <th class="col-1"><a
                                                href="{{route('purchase.index', ['SortName'=>"status", "SortBy" => $sortBy??"asc"])}}">Status</a>
                                        </th>
                                        <th class="col-2">Date</th>
                                        <th class="col-2">Information</th>
                                        <th class="col-2">Payment link</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">

                                    @foreach($purchases as $item)

                                        <tr>
                                            <td class="col-1">{{$item->customId}}</td>
                                            {{--                                            @foreach($item->product['title'] as $lg => $i)--}}
                                            {{--                                                @if(\Illuminate\Support\Facades\Cookie::get('locale') == $lg)--}}
                                            {{--                                                    <td class='col-2'>{{ $i }}</td>--}}
                                            {{--                                                @endif--}}
                                            {{--                                            @endforeach--}}

                                            <td class="col-1">{{$item->booking['first_name']. " ".$item->booking['last_name']}}</td>
                                            <td class="col-1">{{$item->total_sold_price}}</td>
                                            <td class="col-1">
                                                <select class="Payments form-control" data-id="{{$item->booking->id}}"
                                                        name="payments_status">
                                                    <option
                                                        value="unpaid" {{$item->booking['payment_status']=='unpaid'?'selected':''}} >
                                                        Unpaid
                                                    </option>
                                                    <option
                                                        value="paid" {{$item->booking['payment_status']=='paid'?'selected':''}} >
                                                        Paid
                                                    </option>
                                                    <option
                                                        value="cancelled" {{$item->booking['payment_status']=='cancelled'?'selected':''}} >
                                                        Cancelled
                                                    </option>
                                                    <option
                                                        value="done" {{$item->booking['payment_status']=='done'?'selected':''}} >
                                                        Done
                                                    </option>
                                                    <option
                                                        value="pending" {{$item->booking['payment_status']=='pending'?'selected':''}} >
                                                        Pending
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                {{$item->created_at}}
                                            </td>
                                            <td>
                                                <a class="showPurchase" href="#"
                                                   data-route="{{ route('purchase.show', $item->booking['id']) }}"
                                                   data-toggle="modal" data-target="#showMyModal">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                            <td><a href="{{$item->paymentLink}}" class="payment-link-copy"> <i
                                                        class="fa-solid fa-wallet"></i> </a></td>
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
            @include('customer.history.modals.showMyModal')
        </section>
        <!-- /.content -->
    </div>
@endsection
