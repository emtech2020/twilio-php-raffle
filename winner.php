<?

  require('twilio/Services/Twilio.php');

  $client = new Services_Twilio($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

  $messages = $client->account->messages->getPage(0, 100, array('To' => $_ENV['TWILIO_PHONE_NUMBER']))->getItems();

  $numbers = array_unique(array_map(function($x){return $x->from;}, $messages));

  $winner = $numbers[array_rand($numbers)];

  $client->account->calls->create($_ENV['TWILIO_PHONE_NUMBER'], $winner, $_ENV['TWILIO_BASE_URL'] . '/congrats.php');

  echo "We have a winner: " . substr($winner, -4);

?>
