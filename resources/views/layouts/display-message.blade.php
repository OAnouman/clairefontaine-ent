{{-- Display session.success and session.failed if exists --}}

@if($success = session('success'))


    <alert-dismiss success = "true">


        {{ $success }}


    </alert-dismiss>


@endif

@if($failed = session('failed'))


    <alert-dismiss danger = "true">


        {{ $failed }}


    </alert-dismiss>


@endif
