<div class="position-relative" align="center">
    <div class="d-inline-block">
        @if(count($errors) > 0)
            <div class="alert alert-warning py-3 px-5 rounded-pill">
                @foreach($errors->all() as $i)
                    <h6>{{ $i }}</h6>
                    @break
                @endforeach
            </div>
        @endif
        @if(\Session::has('success'))
            <div class="alert alert-success py-3 px-5 rounded-pill">
                <h6>{{ \Session::get('success') }}</h6>
            </div>
        @endif
        @if(\Session::has('warning'))
            <div class="alert alert-warning py-3 px-5 rounded-pill">
                <h6>{{ \Session::get('warning') }}</h6>
            </div>
        @endif
        @if(\Session::has('error'))
            <div class="alert alert-danger py-3 px-5 rounded-pill">
                <h6>{{ \Session::get('error') }}</h6>
            </div>
        @endif
    </div>
</div>
