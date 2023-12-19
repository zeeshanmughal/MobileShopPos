@if(session('success'))
    <div class="alert alert-success alert-dismissible justify-content-between">
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible justify-content-between">
        <span>{{ session('error') }}</span>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif