@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard slots</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-1">
                        <a href="{{route('customer.slot.create')}}" class="btn btn-primary">Create</a>
                    </div>
                    <div class="col-12">

                        <div class="card">

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Language</th>
                                        <th>Quantity</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>

                                        <th colspan="3">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($slots as $slot)
                                        <tr>
                                            <td>{{$slot->id}}</td>
                                            <td>{{\App\Enums\Languages::getStringLanguage($slot->language)}}</td>
                                            <td>{{$slot->attendee_qty}}</td>
                                            <td>{{$slot->start_date}}</td>
                                            <td>{{$slot->end_date}}</td>
                                            <td class="col-1"><a class="showSlot" href="#" data-toggle="modal" data-target="#showMyModal" data-route="{{route('customer.slot.show', $slot->id)}}"><i class="far fa-eye"></i></a></td>

                                            <td><a href="{{route('customer.slot.edit', $slot->id)}}"><i class="fas fa-pencil-alt"></i></a></td>
                                            <td>
                                                <form action="{{route('customer.slot.delete',$slot->id)}}" method="POST">
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

                    </div>


                </div>
                <!-- /.row -->

            </div>
        @include('customer.slot.modals.showMyModal')
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
