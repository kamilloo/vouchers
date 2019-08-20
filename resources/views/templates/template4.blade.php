@extends('layouts.checkout')

@section('head')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template4/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template4/css/util.css">
    <link rel="stylesheet" type="text/css" href="template4/css/main.css">
    <!--===============================================================================================-->
@endsection

@section('content')

<div class="container-contact100">
    <div class="wrap-contact100">
        <form class="contact100-form validate-form">
				<span class="contact100-form-title">
					Podaruj prezent
				</span>

            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <span class="label-input100">Osoba obdarowana</span>
                <input class="input100" type="text" name="name" placeholder="">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 input100-select">
                <span class="label-input100">Wybierz usługę</span>
                <div>
                    <select class="selection-2" name="service">
                        <option>Przykładowa usługa</option>
                        <option>Kolejna usługa</option>
                        <option>Inna usługa</option>
                    </select>
                </div>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Kwota jest wymagana">
                <span class="label-input100">Kwota</span>
                <input class="input100" type="text" name="email" placeholder="Kwota">
                <span class="focus-input100"></span>
            </div>

            <div class="container-contact100-form-btn">
                <div class="wrap-contact100-form-btn">
                    <div class="contact100-form-bgbtn"></div>
                    <button class="contact100-form-btn">
							<span>
								Przejdź dalej
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="template4/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/bootstrap/js/popper.js"></script>
<script src="template4/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="template4/vendor/daterangepicker/moment.min.js"></script>
<script src="template4/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="template4/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="template4/js/main.js"></script>

@endsection
