@extends('admin.layouts.main')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create slot</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

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

                    <div class="col-12">

                        <form action="{{route('customer.slot.store')}}" method="POST" class="w-25">
                            @csrf
                            @error('custom_validation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control" required >
                                @error('quantity')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="datetimes" id="daterange" class="form-control"/>
                                @error('datetimes')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Start Time</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="time_hour_start1" class="form-control">
                                            <?php for ($i = 0; $i <= 23; $i++): ?>
                                            <option value="{{$i}}"><?php echo sprintf('%02d', $i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <select name="time_minute_start1" class="form-control">
                                            <?php for ($i = 0; $i <= 59; $i++): ?>
                                            <option value="{{$i}}"><?php echo sprintf('%02d', $i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>End Time</label>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="time_hour_start2" class="form-control">
                                            <?php for ($i = 0; $i <= 23; $i++): ?>
                                            <option value="{{$i}}"><?php echo sprintf('%02d', $i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <select name="time_minute_start2" class="form-control">
                                            <?php for ($i = 0; $i <= 59; $i++): ?>
                                            <option value="{{$i}}"><?php echo sprintf('%02d', $i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Languages</label>
                                <select class="form-control" name="language" style="width: 100%;">
                                    @foreach($languages as $key => $language)
                                        <option value="{{ $language }}">
                                            {{ $key }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Available</label>
                                <select class="form-control" name="is_available" style="width: 100%;">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @error('language')
                                <div class="text-danger">{{@$message}}</div>
                                @enderror
                            </div>


                            <input type="submit" class="btn btn-primary" value="Create">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
