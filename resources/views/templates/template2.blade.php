<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="template2/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template2/css/util.css">
    <link rel="stylesheet" type="text/css" href="template2/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="bg-contact2" style="background-image: url('template2/images/bg-01.jpg');">
    <div class="container-contact2">
        <div class="wrap-contact2">
            <form class="contact2-form validate-form">
					<span class="contact2-form-title">
						Podaruj prezent
					</span>

                <div class="wrap-input2 validate-input" data-validate="Name is required">
                    <input class="input2" type="text" name="name">
                    <span class="focus-input2" data-placeholder="Osoba obdarowana"></span>
                </div>

                <div class="wrap-input2 validate-input" data-validate = "Wybót usługi jest wymagany">
                    <input class="input2" type="text" name="service">
                    <span class="focus-input2" data-placeholder="Wybierz usługę"></span>
                </div>
                <div class="wrap-input2 validate-input" data-validate = "Wybót usługi jest wymagany">
                    <input class="input2" type="text" name="amount">
                    <span class="focus-input2" data-placeholder="Kwota"></span>
                </div>

                <div class="container-contact2-form-btn">
                    <div class="wrap-contact2-form-btn">
                        <div class="contact2-form-bgbtn"></div>
                        <button class="contact2-form-btn">
                            Przejdź dalej
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="template2/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template2/vendor/bootstrap/js/popper.js"></script>
<script src="template2/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="template2/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="template2/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
