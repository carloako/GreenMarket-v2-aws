<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
    <link href="/css/stylesheet.css" rel="stylesheet" />
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
    <?php include "backend-edit-product-form.php" ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
    <script>
        setInputFilter(document.getElementById("price"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("decimalPrice"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("onsalePrice"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("onsaleDecimalPrice"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        // Restricts input for the given textbox to the given inputFilter function.
        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
                textbox.addEventListener(event, function(e) {
                    if (inputFilter(this.value)) {
                        // Accepted value
                        if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                            this.classList.remove("input-error");
                            this.setCustomValidity("");
                        }
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        // Rejected value - restore the previous one
                        this.classList.add("input-error");
                        this.setCustomValidity(errMsg);
                        this.reportValidity();
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        // Rejected value - nothing to restore
                        this.value = "";
                    }
                });
            });
        }
        var onsaleObject = document.getElementById("onsale");
        onsaleObject.addEventListener("change", changeOnsaleBox(onsaleObject));

        function changeOnsaleBox(checkbox) {
            var onsaleW = document.getElementById("onsalePrice");
            var onsaleD = document.getElementById("decimalOnsalePrice");
            var onsaleValue = document.getElementById("onsaleValue");
            if (checkbox.checked) {
                onsaleW.readOnly = false;
                onsaleD.readOnly = false;
                onsaleValue.value = 1;
            } else {
                onsaleW.readOnly = true;
                onsaleW.value = "";
                onsaleD.readOnly = true;
                onsaleD.value = "";
                onsaleValue.value = 0;
            }
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>