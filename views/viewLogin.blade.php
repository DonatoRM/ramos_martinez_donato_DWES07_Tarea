@extends('templates/generalTemplate')
@section('title')
    {{ $title }}
@endsection
@section('scripts')
    <script type="text/javascript" src="../vendor/fortawesome/font-awesome/js/all.min.js"></script>
    @php
        $xajax->printJavascript();
    @endphp
    <script type="text/javascript" src="../js/login.js"></script>
@endsection
@section('content')
    <main>
        <section class="vw-100 vh-100 d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title mt-1"><i class="fa-solid fa-gear me-3"></i>Registro</h2>
                </div>
                <div class="card-body">
                    <form name="formLogin" id="formLogin" method="POST" action="listing.php" target="_self">
                        <div class="">
                            <span id="errorUser"
                                class="d-flex justify-content-center align-items-center rounded
                                bg-danger text-white mb-0"></span>
                            <div class="input-group mb-3">
                                <label for="user" class="input-group-text"><i class="fa-solid fa-user"></i></label>
                                <input type="text" class="form-control" name="user" id="user" size="25"
                                    placeholder="Usuarios">
                            </div>
                        </div>
                        <div class="">
                            <span id="errorPass"
                                class="d-flex justify-content-center align-items-center rounded bg-danger text-white mb-0"></span>
                            <div class="input-group mb-3">
                                <label for="pass" class="input-group-text"><i class="fa-solid fa-key"></i></label>
                                <input type="password" class="form-control" name="pass" id="pass" size="25"
                                    placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-8">
                                    <span id="errorDB"
                                        class="d-flex justify-content-center align-items-center rounded bg-danger text-white mt-1">
                                    </span>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-azul text-white float-end" name="register"
                                            id="register">Registrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
