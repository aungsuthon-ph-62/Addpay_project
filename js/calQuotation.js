if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

function ready() {
  
  var quantityInputs = document.getElementsByClassName("cart-quantity-input");
  for (var i = 0; i < quantityInputs.length; i++) {
    var input = quantityInputs[i];
    input.addEventListener("change", quantityChanged);
  }

  var priceInputs = document.getElementsByClassName("cart-price");
  for (var i = 0; i < priceInputs.length; i++) {
    var priceinput = priceInputs[i];
    priceinput.addEventListener("change", priceChanged);
  }
}

var items = 0;

function addItem() {
  items++;

  var html = "<tr class='cart-row'>";
  html += "<th class=''>" + items + "</th>";
  html +=
    "<td><input type='text' class='form-control w-100 items-title' placeholder='รายการ' name='itemName[]'></td>";
  html +=
    "<td class='cart-quantity'><input type='number' class='form-control w-100 cart-quantity-input' placeholder='จำนวน' name='itemamount[]' id='itemamount' value='1'></td>";
  html +=
    "<td class='cart-price'><input type='number' class='form-control w-100 cart-price-input' placeholder='ราตาต่อหน่วย' name='itemprice[]' id='itemprice' value='1'></td>";
  html += "<td><p class='cart-total-price text-muted'></p></td>";
  html +=
    "<td><button type='button' class='float-end mr-1 btn btn-danger btn-sm' onclick='deleteRow(this);'><i class='fa-solid fa-trash-can'></i></button></td>";
  html += "</tr>";

  var row = document.getElementById("tbody").insertRow(0);
  row.innerHTML = html;
  row.getElementsByClassName("cart-quantity-input")[0].addEventListener("change", quantityChanged);
  row.getElementsByClassName("cart-price-input")[0].addEventListener("change", priceChanged);
}

function deleteRow(button) {
  items--;
  button.parentElement.parentElement.remove();
  // first parentElement will be td and second will be tr.
}

function quantityChanged(event) {
  var input = event.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  resultofitem();
}

function priceChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
      input.value = 1;
    }
    resultofitem();
  }

function resultofitem() {
  var cartItemContainer = document.getElementsByClassName("cart-items")[0];
  var cartRows = cartItemContainer.getElementsByClassName("cart-row");
  var total = 0;
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    console.log(cartRow);
    var priceElement = cartRow.getElementsByClassName("cart-price")[0];
    var quantityElement = cartRow.getElementsByClassName("cart-quantity-input")[0];
    var price = parseFloat(priceElement.innerText.replace("$", ""));
    var quantity = quantityElement.value;
    total = total + price * quantity;
  }
  total = Math.round(total * 100) / 100;
  document.getElementsByClassName("cart-total-price")[0].innerText =
    "$" + total;
}
