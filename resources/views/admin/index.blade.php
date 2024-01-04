@extends('admin.mainlayout')
@section('content')
    <?php error_reporting(0); ?>
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-auto">

                @if (Session::has('timeout'))
                    <div class="alert alert-danger"> {{ Session::get('timeout') }} </div>
                @endif

                <div class="card shadow rounded border-0 bg-light">
                    <div class="card-body">

                        <form id="formLogin">
                            <input type="hidden" id="user" value="{{ $user }}">
                            <input type="password" id="password" class="form-control" placeholder="secret code">
                            <button type="submit" class="btn btn-primary mt-3"> Check </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#formLogin').on('submit', function(e) {
            e.preventDefault();
            var user = $('#user').val();
            var pass = $('#password').val();
            $.ajax({
                url: '/adminPlace/auth',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    user: user,
                    pass: pass
                },
                success: function(response) {
                    if (response.status == 'ok') {
                        window.location.href = '/adminPlace/home';
                    } else {
                        console.log(response.status);
                    }
                }
            });
        });
    </script>
@endsection
