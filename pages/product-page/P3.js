// calculate total
function subtotalCalc() {
    var price = document.getElementById("hidden-price").value;
    var x = price * parseInt(document.getElementById("quantity").value);
    document.getElementById("subtotal").value = "$" + x.toFixed(2);
}

// load quantity on load
// function loadQuantity() {
//   <?php
//   ?>
// }

// add quantity
function plus() {
    if (document.getElementById("quantity").value === "") {
        document.getElementById("quantity").value = 0;
    }
    document.getElementById("quantity").value = parseInt(document.getElementById("quantity").value) + 1;
    save();
}
// substract quantity
function minus() {
    if (document.getElementById("quantity").value === "") {
        document.getElementById("quantity").value = 0;
    }
    if (document.getElementById("quantity").value != 1) {
        document.getElementById("quantity").value = parseInt(document.getElementById("quantity").value) - 1;
    }
    save();
}

// readmore button
function readMore() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("readmore");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        moreText.style.display = "none";
        btnText.innerHTML = "More Description";
    } else {
        dots.style.display = "none";
        moreText.style.display = "inline";
        btnText.innerHTML = "Less Description";
    }
}

function goToAddToCart() {
    document.getElementById("checkAdd").value = "1";
}

function loadTest() {
    var id = document.getElementById("productID").value;
    var load = localStorage.getItem(id);
    if (load != null) {
        document.getElementById("quantity").value = load;
    } else {
        document.getElementById("quantity").value = 1;
    }
}

function saveTest() {
    var id = document.getElementById("productID").value;
    var save = document.getElementById("quantity").value;
    localStorage.setItem(id, save);
}

// add quantity and calculate on click of plus
document.getElementById("plus").addEventListener("click", plus);
document.getElementById("plus").addEventListener("click", subtotalCalc);
// substruct quantity and calculate on click of minus
document.getElementById("minus").addEventListener("click", minus);
document.getElementById("minus").addEventListener("click", subtotalCalc);
// load quantity and calculate total on load
window.addEventListener("load", loadQuantity);

// window.addEventListener("load", loadTest);
window.addEventListener("load", subtotalCalc);
  // window.addEventListener("beforeunload", saveTest);
  // document.getElementById("testsave").onclick = clickTestSave;