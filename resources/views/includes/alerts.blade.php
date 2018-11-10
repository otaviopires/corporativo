@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @foreach($errors->all() as $error)
    <p><i class="fa fa-times fa-fw"></i> {{$error}}</p>
    @endforeach
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><i class="fa fa-check fa-fw"></i> {{session('success')}}</p>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><i class="fa fa-times fa-fw"></i> {{session('error')}}</p>
</div>
@endif

@if(isset($sucess) and count($sucess) > 0)
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p><i class="fa fa-check fa-fw"></i> {{$sucess->mensage}}</p>
</div>
@endif