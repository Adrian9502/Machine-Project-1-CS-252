<style>
  body {
    display: flex;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
    justify-content: space-around;
    align-items: center;
    font-size: large;
    background-color: darkslategray;
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
</style>

<?php
    // ======================
    // Machine Problem # 1
    // Project Name - Banking Application
    // Project Description - Calculate the Initial balance and interest annually
    // Programmer - John Adrian D. Bonto
    // Language - PHP
    // Date Created - April 3,2024
    // Date Modified - April 3,2024
    // ======================
    // Members : John Adrian D. Bonto
    //           Harley Dave Andal
    //           Mark Peneil Basi   
    // ======================  


// check if the form are filled out
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['initialBalance']) && isset($_GET['interestRate']) && isset($_GET['yearDeposited']) && isset($_GET['yearWithdrawn'])) {

  // initialize the variable and use GET method to get the value in the url
  $initialBalance = $_GET['initialBalance'];
  $interestRate = $_GET['interestRate'];
  $yearDeposited = $_GET['yearDeposited'];
  $yearWithdraw = $_GET['yearWithdrawn'];

  echo "<div class=\"main-container\">";
  echo "<div class=\"title\">Problem #1-Banking System</div> <br>";
  echo "1. Initial balance : $initialBalance <br>";
  echo "2. Interest rate : $interestRate <br>";
  echo "3. Year deposited : $yearDeposited<br>";
  echo "4. Year to be withdrawn : $yearWithdraw <br>";
  echo "</div>";
  // set initial balance to balance variable
  $balance = $initialBalance;

  echo "<div class=\"result-container\">";
  echo "<div class=\"title\">Result</div>";
  echo "<div class=\"result-grid\">";
  echo "<div>Year</div>";
  echo "<div>Interest</div>";
  echo "<div>Balance</div>";


  // loop from initial year to final year
  for ($year = $yearDeposited; $year <= $yearWithdraw; $year++) {
    // if the year is the current year, theres 0 interest and the balance remain the same, because the interest is annually (every year)
    if ($year === $yearDeposited) {
      $interest = 0;
      $interestFormatted = number_format($interest, 2);
      $balance = $initialBalance;
      $balanceFormatted = number_format($balance, 2);
      echo "<div>";
      echo "$year";
      echo "</div>";
      echo "<div>";
      echo "Php: $interestFormatted";
      echo "</div>";

      echo "<div>";
      echo "Php: $balanceFormatted";
      echo "</div>";
    }
    // calculate the interest and balance if year is not equal to year deposited
    else {
      $interest = $balance * $interestRate;
      $interestFormatted = number_format($interest, 2);
      $balance += $interest;

      $balanceFormatted = number_format($balance, 2);
      echo "<div>";
      echo "$year";
      echo "</div>";

      echo "<div>";
      echo "Php: $interestFormatted";
      echo "</div>";

      echo "<div>";
      echo "Php: $balanceFormatted";
      echo "</div>";
    }
  }

  echo "</div>";
  echo "</div>";
  // if the user did fill out, the codes above will not run
} else    echo "
Please copy this link below and add it to the url. Replace 'EnterInput' with your desired input. <br><br>
?initialBalance=EnterInput&interestRate=EnterInput&yearDeposited=EnterInput&yearWithdrawn=EnterInput
";

