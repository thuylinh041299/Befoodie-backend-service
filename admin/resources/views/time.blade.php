@extends('theme.default')
@section('content')

<!-- Updated stylesheet url -->
<link rel="stylesheet" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
<style type="text/css">
	.ui-timepicker-wrapper {
	    overflow-y: auto;
	    max-height: 150px;
	    width: 200px;
	    background: #fff;
	    border: 1px solid #ddd;
	    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
	    -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
	    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
	    outline: none;
	    z-index: 10052;
	    margin: 0;
	}
</style>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Trang quản trị</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Thời gian giao hàng và làm việc</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
    	
    	<div class="col-lg-12">
    		@if(Session::has('success_message'))
    		<div class="alert alert-success">
    		    <span class="glyphicon glyphicon-ok"></span>
    		    {!! session('success_message') !!}

    		    <button type="button" class="close" data-dismiss="alert" aria-label="close">
    		        <span aria-hidden="true">&times;</span>
    		    </button>

    		</div>
    		@endif
    	    <div class="card">
    	        <div class="card-body">
    	            <div class="basic-form">
    	                <form action="{{ URL::to('admin/time/store') }}" method="post">
    	                	@csrf
    	                	<div class="form-row">
    	                		<label class="col-sm-2 col-form-label"></label>
    	                	    <div class="form-group col-md-3" style="text-align: center;">
    	                	        <label><strong>Thời gian mở cửa và làm việc</strong></label>
    	                	    </div>
    	                	    <div class="form-group col-md-3" style="text-align: center;">
    	                	        <label><strong>Đóng cửa</strong></label>
    	                	    </div>
                                <div class="form-group col-md-3" style="text-align: center;">
                                    <label><strong>Chọn Đồng ý nếu không hoạt động hôm đó</strong></label>
                                </div>
    	                	</div>
    	                	@foreach ($gettime as $time)
    	                    <div class="form-row">

                                @if ($time->day == "Monday")
                                    <label class="col-sm-2 col-form-label">Thứ 2</label>
                                @endif

                                @if ($time->day == "Tuesday")
                                    <label class="col-sm-2 col-form-label">Thứ 3</label>
                                @endif

                                @if ($time->day == "Wednesday")
                                    <label class="col-sm-2 col-form-label">Thứ 4</label>
                                @endif

                                @if ($time->day == "Thursday")
                                    <label class="col-sm-2 col-form-label">Thứ 5</label>
                                @endif

                                @if ($time->day == "Friday")
                                    <label class="col-sm-2 col-form-label">Thứ 6</label>
                                @endif

                                @if ($time->day == "Saturday")
                                    <label class="col-sm-2 col-form-label">Thứ 7</label>
                                @endif

                                @if ($time->day == "Sunday")
                                    <label class="col-sm-2 col-form-label">Chủ nhật</label>
                                @endif
    	                    	<input type="hidden" name="day[]" value="{{$time->day}}">

                                @if ($time->always_close == '2')
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" placeholder="Thời gian mở cửa" id="open{{$time->day}}" name="open_time[]" value="{{$time->open_time}}">
                                    </div>
                                @else
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" placeholder="Thời gian mở cửa" id="open{{$time->day}}" name="open_time[]" value="Closed" readonly="">
                                    </div>
                                @endif

                                @if ($time->always_close == '2')
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" placeholder="Đóng cửa" id="close{{$time->day}}" name="close_time[]" value="{{$time->close_time}}">
                                    </div>
                                @else
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" placeholder="Đóng cửa" id="close{{$time->day}}" name="close_time[]" value="Closed" readonly="">
                                    </div>
                                @endif

                                <div class="form-group col-md-3">
                                    <select class="form-control" name="always_close[]" id="always_close{{$time->day}}">
                                        <option value="">Chọn Đồng ý nếu không hoạt động hôm đó</option>
                                        <option value="1" @if ($time->always_close == '1') selected @endif>Đồng ý đóng cửa</option>
                                        <option value="2" @if ($time->always_close == '2') selected @endif>Không</option>
                                    </select>
                                </div>
    	                    </div>
    	                    @endforeach
                            @if (env('Environment') == 'sendbox')
                                <button type="button" class="btn btn-primary" onclick="myFunction()">Lưu lại</button>
                            @else
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            @endif
    	                </form>
    	            </div>
    	        </div>
    	    </div>
    	</div>

    </div>
<!-- #/ container -->
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<!-- Updated JavaScript url -->
<script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js" defer></script>
<script>
    $(document).ready(function () {
        $("#openMonday").timepicker();
        $("#closeMonday").timepicker();
        $("#openTuesday").timepicker();
        $("#closeTuesday").timepicker();
        $("#openWednesday").timepicker();
        $("#closeWednesday").timepicker();
        $("#openThursday").timepicker();
        $("#closeThursday").timepicker();
        $("#openFriday").timepicker();
        $("#closeFriday").timepicker();
        $("#openSaturday").timepicker();
        $("#closeSaturday").timepicker();
        $("#openSunday").timepicker();
        $("#closeSunday").timepicker();
    });
</script>