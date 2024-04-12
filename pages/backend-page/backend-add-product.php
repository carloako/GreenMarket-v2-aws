<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
    <!-- Custom Stylesheets -->
    <link href="/css/stylesheet.css" rel="stylesheet" />
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
    <div class="w-50 border border-3 rounded-2 mx-auto mt-3 p-3 bg-white">
        <form class="row g-3 needs-validation" action="/pages/backend-page/add-product.php" method="get">
            <div class="col-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="col-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" maxlength="5" required>
                    <span class="input-group-text">.</span>
                    <input type="text" class="form-control" id="decimalPrice" name="decimalPrice" maxlength="2"
                        required>
                </div>
            </div>
            <div class="col-6">
                <label for="productType" class="form-label">Product Type</label>
                <select class="form-select" id="productType" name="productType" required>
                    <option value="fruits">Fruits</option>
                    <option value="beverages">Beverages</option>
                    <option value="meals">Meals</option>
                    <option value="snacks">Snacks</option>
                </select>
            </div>
            <div class="col-3">
                <input class="form-check-input" type="checkbox" id="onsale" name="onsale" value=""
                    onchange="changeOnsaleBox(this)">
                <input type="hidden" id="onsaleValue" name="onsaleValue" value=0>
                <label for="onsale" class="form-check-label">Onsale</label>
            </div>
            <div class="col-3">
                <label for="onsalePrice" class="form-label">Onsale Price</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="onsalePrice" name="onsalePrice" maxlength="5" readonly>
                    <span class="input-group-text">.</span>
                    <input type="text" class="form-control" id="decimalOnsalePrice" name="decimalOnsalePrice"
                        maxlength="2" readonly>
                </div>
            </div>
            <div class="col-6">
            </div>
            <div class="col-3">
                <input type="submit" class="btn btn-secondary" value="Submit">
            </div>
        </form>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
    <script>
        setInputFilter(document.getElementById("price"), function (value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("decimalPrice"), function (value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("onsalePrice"), function (value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        setInputFilter(document.getElementById("onsaleDecimalPrice"), function (value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        }, "Only digits and '.' are allowed");
        // Restricts input for the given textbox to the given inputFilter function.
        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function (event) {
                textbox.addEventListener(event, function (e) {
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
                onsaleW.required = true;
                onsaleD.readOnly = false;
                onsaleD.required = true;
                onsaleValue.value = 1;
            } else {
                onsaleW.readOnly = true;
                onsaleW.required = false;
                onsaleW.value = "";
                onsaleD.readOnly = true;
                onsaleD.required = false;
                onsaleD.value = "";
                onsaleValue.value = 0;
            }
        }
    </script>
</body>