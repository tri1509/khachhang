<?php
  $title = "Máy tính";
  include 'inc/header.php';
  include 'inc/sidebar.php';
?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<style>
.calculator {
  padding: 20px;
  -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  border-radius: 1px;
  font-family: 'Source Sans Pro', sans-serif;
  width: 600px;
  margin: 0 auto;
}

.input {
  border: 1px solid #ddd;
  border-radius: 1px;
  height: 100px;
  padding-right: 15px;
  padding-top: 10px;
  text-align: right;
  margin-right: 18px;
  font-size: 2.5rem;
  overflow-x: auto;
  transition: all .2s ease-in-out;
}

.input:hover {
  border: 1px solid #bbb;
  -webkit-box-shadow: inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
}

.operators div {
  display: inline-block;
  border: 1px solid #bbb;
  border-radius: 1px;
  width: 130px;
  text-align: center;
  padding: 10px;
  margin: 20px 4px 10px 0;
  cursor: pointer;
  background-color: #ddd;
  transition: border-color .2s ease-in-out, background-color .2s, box-shadow .2s;
}

.operators div:hover {
  background-color: #ddd;
  -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  border-color: #aaa;
}

.operators div:active {
  font-weight: bold;
}

.leftPanel {
  display: inline-block;
}

.numbers div {
  display: inline-block;
  border: 1px solid #ddd;
  border-radius: 1px;
  width: 142px;
  text-align: center;
  padding: 10px;
  margin: 10px 4px 10px 0;
  cursor: pointer;
  background-color: #f9f9f9;
  transition: border-color .2s ease-in-out, background-color .2s, box-shadow .2s;
}

.numbers div:hover {
  background-color: #f1f1f1;
  -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  border-color: #bbb;
}

.numbers div:active {
  font-weight: bold;
}

div.equal {
  display: inline-block;
  border: 1px solid #3079ED;
  border-radius: 1px;
  width: 17%;
  text-align: center;
  padding: 110px 40px;
  margin: 10px 6px 10px 0;
  vertical-align: top;
  cursor: pointer;
  color: #FFF;
  background-color: #4d90fe;
  transition: all .2s ease-in-out;
}

div.equal:hover {
  background-color: #307CF9;
  -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  border-color: #1857BB;
}

div.equal:active {
  font-weight: bold;
}
</style>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        <h5 class="m-0">Máy tính</h5>
      </div>
      <div class="calculator">
        <div class="input" id="input"></div>
        <div class="buttons">
          <div class="operators">
            <div>+</div>
            <div>-</div>
            <div>&times;</div>
            <div>&divide;</div>
          </div>
          <div class="leftPanel">
            <div class="numbers">
              <div>7</div>
              <div>8</div>
              <div>9</div>
            </div>
            <div class="numbers">
              <div>4</div>
              <div>5</div>
              <div>6</div>
            </div>
            <div class="numbers">
              <div>1</div>
              <div>2</div>
              <div>3</div>
            </div>
            <div class="numbers">
              <div>0</div>
              <div>.</div>
              <div id="clear">C</div>
            </div>
          </div>
          <div class="equal" id="result">=</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
"use strict";
var input = document.getElementById('input'),
  number = document.querySelectorAll('.numbers div'),
  operator = document.querySelectorAll('.operators div'),
  result = document.getElementById('result'),
  clear = document.getElementById('clear'),
  resultDisplayed = !1;
for (var i = 0; i < number.length; i++) {
  number[i].addEventListener("click", function(e) {
    var currentString = input.innerHTML;
    var lastChar = currentString[currentString.length - 1];
    if (resultDisplayed === !1) {
      input.innerHTML += e.target.innerHTML
    } else if (resultDisplayed === !0 && lastChar === "+" || lastChar === "-" || lastChar === "×" || lastChar ===
      "÷") {
      resultDisplayed = !1;
      input.innerHTML += e.target.innerHTML
    } else {
      resultDisplayed = !1;
      input.innerHTML = "";
      input.innerHTML += e.target.innerHTML
    }
  })
}
for (var i = 0; i < operator.length; i++) {
  operator[i].addEventListener("click", function(e) {
    var currentString = input.innerHTML;
    var lastChar = currentString[currentString.length - 1];
    if (lastChar === "+" || lastChar === "-" || lastChar === "×" || lastChar === "÷") {
      var newString = currentString.substring(0, currentString.length - 1) + e.target.innerHTML;
      input.innerHTML = newString
    } else if (currentString.length == 0) {
      console.log("enter a number first")
    } else {
      input.innerHTML += e.target.innerHTML
    }
  })
}
result.addEventListener("click", function() {
  var inputString = input.innerHTML;
  var numbers = inputString.split(/\+|\-|\×|\÷/g);
  var operators = inputString.replace(/[0-9]|\./g, "").split("");
  console.log(inputString);
  console.log(operators);
  console.log(numbers);
  console.log("----------------------------");
  var divide = operators.indexOf("÷");
  while (divide != -1) {
    numbers.splice(divide, 2, numbers[divide] / numbers[divide + 1]);
    operators.splice(divide, 1);
    divide = operators.indexOf("÷")
  }
  var multiply = operators.indexOf("×");
  while (multiply != -1) {
    numbers.splice(multiply, 2, numbers[multiply] * numbers[multiply + 1]);
    operators.splice(multiply, 1);
    multiply = operators.indexOf("×")
  }
  var subtract = operators.indexOf("-");
  while (subtract != -1) {
    numbers.splice(subtract, 2, numbers[subtract] - numbers[subtract + 1]);
    operators.splice(subtract, 1);
    subtract = operators.indexOf("-")
  }
  var add = operators.indexOf("+");
  while (add != -1) {
    numbers.splice(add, 2, parseFloat(numbers[add]) + parseFloat(numbers[add + 1]));
    operators.splice(add, 1);
    add = operators.indexOf("+")
  }
  input.innerHTML = numbers[0];
  resultDisplayed = !0
});
clear.addEventListener("click", function() {
  input.innerHTML = ""
})
</script>
<?php include 'inc/footer.php';?>