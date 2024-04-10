<style>
  body {
    display: flex;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    justify-content: space-around;
    align-items: center;
    font-size: large;
    background-color: darkslateblue;
  }

  .main-container {
    display: flex;
    padding: 10px;
    align-items: center;
    justify-content: center;
    border: 1px solid white;
    border-radius: 10px;
    width: fit-content;
    height: fit-content;
    flex-direction: column;
    background-color: black;
  }

  .title {
    font-size: x-large;
    margin-top: 5px;
    margin-bottom: 5px;
  }

  .result-container {
    border: 1px solid white;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    background-color: black;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .result-grid {
    display: grid;
    text-align: center;
    grid-template-columns: repeat(3, 1fr);
  }

  .result-grid div {
    border: 1px solid white;
    padding: 5px;
  }

  .start-message {
    width: 80%;
    text-align: center;
    border: 1px solid white;
    background-color: black;
    padding: 10px;
    border-radius: 10px;
  }

  .note {
    letter-spacing: 1px;
    font-size: medium;
    text-align: start;
    border-radius: inherit;
    margin: 10px auto 10px auto;
    width: fit-content;
    padding: 10px;
    border: 1px solid white;
  }

  input {
    width: 90%;
    height: 40px;
    border: none;
    border-radius: 10px;
    font-size: medium;
    margin-top: 5px;
  }
</style>

<?php

// ======================
// Machine Problem # 2
// Project Name: JHM Co. Employee Benefits Program
// Project Description: Calculate benefits base on gross pay , age and chosen benefits
// Programmer: John Adrian D. Bonto
// Language: Php
// Date Created: April 3, 2024
// Date Modified: April 4, 2024

// Section: 2-CS1
// Members : John Adrian D. Bonto
//           Harley Dave Andal
//           Mark Peneil Basi 
// ====================== 

// check if the variables are getting have value , otherwise it will go to else block
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['grossPay']) && isset($_GET['age']) && isset($_GET['healthInsurance']) && isset($_GET['disabilityInsurance']) && isset($_GET['lifeInsurance'])) {

  // get the value of gross pay and age
  $grossPay = $_GET['grossPay'];
  $age = $_GET['age'];

  $healthInsuranceOption = $_GET['healthInsurance'];
  $disabilityInsuranceOption = $_GET['disabilityInsurance'];
  $lifeInsuranceOption = $_GET['lifeInsurance'];

  // function to calculate health insurance
  function healthInsurance($healthInsuranceOption)
  {
    if ($healthInsuranceOption === "A" || $healthInsuranceOption === "a") return 1500.00;
    else if ($healthInsuranceOption === "B" || $healthInsuranceOption === "b") return 2750.00;
    else echo "Error: Invalid Choices, please choice either A or B";
  }
  // function to calculate disability insurance
  function disabilityInsurance($disabilityInsuranceOption, $grossPay)
  {
    // convert the gross pay from string into numeric value (float)
    $grossPay = floatval($grossPay);
    if ($disabilityInsuranceOption === "A" || $disabilityInsuranceOption === "a") return 0;
    else if ($disabilityInsuranceOption === "B" || $disabilityInsuranceOption === "b") return $grossPay * 0.012;
    else echo "Error: Invalid Choices, please choice either A or B";
  }

  function lifeInsurance($lifeInsuranceOption, $age)
  {
    // check if the input are number and not string 
    if (!is_numeric($lifeInsuranceOption)) {
      echo "Error: Please enter a numeric value";
    }
    // calculate life insurance 
    // after ? is the if , after : is the else if
    $totalLifeInsurance = ($age > 25) ? ((25 + (($age - 25) * 0.95)) * $lifeInsuranceOption) : (25 * $lifeInsuranceOption);
    return $totalLifeInsurance;

  }

  function calculateTax($grossPay)
  {
    // convert the gross pay from string to float
    $grossPay = floatval($grossPay);
    // if the gross pay is less than or equal to $42,000 the tax is only 18%, else it will be 28%
    $taxRate = $grossPay <= 42000 ? 0.18 : 0.28;
    $taxAmount = $grossPay * $taxRate;
    // return the computed values
    return $taxAmount;
  }

  function calculateRetirement($grossPay)
  {
    // convert the gross pay from string to float 
    $grossPay = floatval($grossPay);
    // return the computed retirement plan (5.5%)
    return $grossPay * 0.055;
  }

  function calculateTotalDeduction($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age)
  {
    // get the values of each function and calculate the total deduction
    $healthInsurance = healthInsurance($healthInsuranceOption);
    $disabilityInsurance = disabilityInsurance($disabilityInsuranceOption, $grossPay);
    $lifeInsurance = lifeInsurance($lifeInsuranceOption, $age);
    $taxes = calculateTax($grossPay);
    $retirement = calculateRetirement($grossPay);
    // adding all the benefits and assign the total to the total deduction variable
    $totalDeductions = $healthInsurance + $disabilityInsurance + $lifeInsurance + $taxes + $retirement;
    // return the computed value
    return $totalDeductions;
  }

  function calculateNetPay($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age)
  {
    // get the values of each function and calculate the total deduction
    $healthInsurance = floatval(healthInsurance($healthInsuranceOption));
    $disabilityInsurance = floatval(disabilityInsurance($disabilityInsuranceOption, $grossPay));
    $lifeInsurance = floatval(lifeInsurance($lifeInsuranceOption, $age));
    $taxes = floatval(calculateTax($grossPay));
    $retirement = floatval(calculateRetirement($grossPay));

    // adding all the benefits and assign the total to the total deduction variable
    $totalDeductions = $healthInsurance + $disabilityInsurance + $lifeInsurance + $taxes + $retirement;
    // converting gross pay from string to float
    $grossPay = floatval($grossPay);
    // getting the net pay by subtracting the gross pay and the total deduction
    $netPay = $grossPay - $totalDeductions;
    // return the computed value
    return $netPay;
  }

  // Main container - left side of screen
  echo "<div class=\"main-container\">";
  echo "<div class=\"title\">JHM Co. Employee Benefits Program</div> <br>";
  echo "1. Annual Gross Pay : $" . number_format($grossPay) . "<br>";
  echo "2. Age : $age <br>";
  echo "3. Health coverage : $healthInsuranceOption<br>";
  echo "4. Disability coverage : $disabilityInsuranceOption <br>";
  echo "5. Life Insurance : $lifeInsuranceOption<br>";
  echo "</div>";

  echo "<div class=\"result-container\">";
  echo "<div class=\"title\">JHM Co. Employee Benefits Program Result</div>";
  echo "<div class=\"result-grid\">";
  // 1st grid column - deduction
  echo
  "<div>
    <div>Deduction</div>

    <div>Health Insurance:</div>  
    <div>Disability Insurance:</div>  
    <div>Life Insurance:</div>  
    <br><br>
    <div>Taxes:</div>
    <div>Retirement:</div>

    <br><br>
    <div>Gross pay:</div>
    <div>Total Deduction:</div>
    <br><br>
    <div>Net pay:</div>
  </div>";

  // 2nd grid column -annual
  echo "<div>
    <div>Annual</div>
    <div>$" . number_format(healthInsurance($healthInsuranceOption), 2) . "</div>
    <div>$" . number_format(disabilityInsurance($disabilityInsuranceOption, $grossPay), 2) . "</div>
    <div>$" . number_format(lifeInsurance($lifeInsuranceOption, $age), 2) . "</div> <br><br>
    <div>$" . number_format(calculateTax($grossPay), 2) . "</div>
    <div>$" . number_format(calculateRetirement($grossPay), 2) . "</div> <br><br>
    <div>$" . number_format($grossPay, 2) . "</div>
    <div>$" . number_format(calculateTotalDeduction($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age), 2) . "</div> <br><br>
    <div>$" . number_format(calculateNetPay($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age), 2) . "</div>
  </div>";

  // 3d grid column- monthly

  echo "<div>
  <div>Monthly</div>
  <div>$" . number_format(healthInsurance($healthInsuranceOption) / 12, 2) . "</div>
  <div>$" . number_format(disabilityInsurance($disabilityInsuranceOption, $grossPay) / 12, 2) . "</div>
  <div>$" . number_format(lifeInsurance($lifeInsuranceOption, $age) / 12, 2) . "</div> <br><br>
  <div>$" . number_format(calculateTax($grossPay) / 12, 2) . "</div>
  <div>$" . number_format(calculateRetirement($grossPay) / 12, 2) . "</div> <br><br>
  <div>$" . number_format($grossPay / 12, 2) . "</div>
  <div>$" . number_format(calculateTotalDeduction($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age) / 12, 2) . "</div> <br><br>
  <div>$" . number_format(calculateNetPay($grossPay, $healthInsuranceOption, $disabilityInsuranceOption, $lifeInsuranceOption, $age) / 12, 2) . "</div>
</div>";

  echo "</div>";
  echo "</div>";
} // This will display when user run this code first time
else  echo "
    <div class=\"start-message\">
    <b>Please copy the link below and add it to the url. Replace 'INPUT' with your desired input.</b>
    <br><br>
    <u><i>?grossPay=INPUT&age=INPUT&healthInsurance=INPUT&disabilityInsurance=INPUT&lifeInsurance=INPUT</u></i> <br><br>
    <div> You can paste the link here and modify it (look at the note below before modifying) </div>
    <input type=\"text\">
    <div class=\"note\">
      Note: <br><br>
      Health Insurance options: <br>
        A. insurance coverage for self only for $1500.00 per year <br>
        B. coverage for self and family for $2750.00 per year.<br><br>
      Disability Insurance options:<br>
        A. no coverage at no cost<br>
        B. coverage which costs 1.2% of annual gross pay<br><br>
      Life Insurance options:<br>
        A. no coverage at no cost (INPUT = 0)<br>
        B. coverage by specifying the amount of coverage (in increments<br>
        of $10,000, so that an input value of 2 means $20,000). <br>
        The cost per year for each $10,000 of life insurance coverage is<br>
        $25.00 plus $0.95 for each year of the employee's age over 25.<br>
    </div>

    </div>
";
?>
<!-- end of code -->