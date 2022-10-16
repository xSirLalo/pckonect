<style>
    .posicion {
        position: absolute;
        top: 7%;
        left: 84%;
        right: 0;
        z-index: 9999;
    }

</style>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block alert-dismissible fade show posicion" role="alert" auto-close="3000">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="mb-0">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block alert-dismissible fade show" role="alert" auto-close="3000">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="mb-0">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block alert-dismissible fade show" role="alert" auto-close="3000">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="mb-0">{{ $message }}</p>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block alert-dismissible fade show" role="alert" auto-close="3000">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <p class="mb-0">{{ $message }}</p>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif
