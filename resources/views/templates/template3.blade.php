@extends('layouts.checkout')

@section('head')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template3/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template3/css/util.css">
    <link rel="stylesheet" type="text/css" href="template3/css/main.css">
    <!--===============================================================================================-->
@endsection

@section('content')

<div class="bg-contact3" style="background-image: url('template3/images/bg-01.jpg');">
    <div class="container-contact3">
        <div class="wrap-contact3">
            <form class="contact3-form validate-form">
					<span class="contact3-form-title">
						Podaruj prezent
					</span>

                <div class="wrap-contact3-form-radio">
                    <div class="contact3-form-radio m-r-42">
                        <input class="input-radio3" id="radio1" type="radio" name="choice" value="say-hi" checked="checked">
                        <label class="label-radio3" for="radio1">
                            Kwota
                        </label>
                    </div>

                    <div class="contact3-form-radio">
                        <input class="input-radio3" id="radio2" type="radio" name="choice" value="get-quote">
                        <label class="label-radio3" for="radio2">
                            Wybierz usługę
                        </label>
                    </div>
                </div>

                <div class="wrap-input3 validate-input" data-validate="Name is required">
                    <input class="input3" type="text" name="name" placeholder="Osoba obdarowana">
                    <span class="focus-input3"></span>
                </div>

                <div class="wrap-input3 input3-select">
                    <div>
                        <select class="selection-2" name="service">
                            <option>Przykładowa usługa</option>
                            <option>Kolejna usługa</option>
                            <option>Inna usługa</option>
                        </select>
                    </div>
                    <span class="focus-input3"></span>
                </div>

                <div class="wrap-input3 validate-input" data-validate = "Message is required">
                    <input class="input3" type="text" name="amount" placeholder="Kwota">
                    <span class="focus-input3"></span>
                </div>

                <div class="container-contact3-form-btn">
                    <button class="contact3-form-btn">
                        Przejdź dalej
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="template3/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template3/vendor/bootstrap/js/popper.js"></script>
<script src="template3/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template3/vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script src="template3/js/main.js"></script>

@endsection
