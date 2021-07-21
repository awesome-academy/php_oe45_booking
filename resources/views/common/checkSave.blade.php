@if (session('msg_success'))
    <div class="alert alert-success">
        <i class="fa fa-thumbs-up"></i>
        <h3>{{ session('msg_success') }}</h3>
    </div>
@elseif (session('msg_fail'))
    <div class="alert alert-danger">
        <i class="fa fa-thumbs-down"></i>
        <h3>{{ session('msg_fail') }}</h3>
    </div>
@elseif (session('msg_reject'))
    <div class="alert alert-warning">
        <i class="fa fa-thumbs-up"></i>
        <h3>{{ session('msg_reject') }}</h3>
    </div>
@endif
