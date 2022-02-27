
this project was created with the instruction of ( https://www.linkedin.com/learning/php-object-oriented-programming-with-databases?contextUrn=urn%3Ali%3AlyndaLearningPath%3A57bdd8a292015ae4c0cb990f )
course 




in the bicycles folder, 
in the show file, the money_format function is deprecated as of 7.4 and eliminated in 8.0.
To format the price in USD, use the following: 
  $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
  echo h($fmt->formatCurrency($bicycle->price, "USD"));
  OR here is a function to do the same thing: 
  function formatDollars($value) { 
    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($value, "USD"); 
  }
