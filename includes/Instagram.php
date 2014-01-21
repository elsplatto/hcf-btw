<?php
//https://api.instagram.com/v1/tags/sydneyferries/media/recent/?count='+count+'&max_id=1&min_id=200000000&client-id=b48c027b0de949648cf7c72e03dffc49&access_token=226333037.f59def8.c2a41368d2aa45a09b41bf56cdd8fe3e

class Instgram
{
  const ACCESS_TOKEN = '226333037.f59def8.c2a41368d2aa45a09b41bf56cdd8fe3e';
  private function fetchData($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 20);
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
  }

  public function renderResults() {
      $result = $this->fetchData('https://api.instagram.com/v1/tags/sydneyferries/media/recent/?count=5&max_id=1&min_id=200000000&client-id=b48c027b0de949648cf7c72e03dffc49&access_token=226333037.f59def8.c2a41368d2aa45a09b41bf56cdd8fe3e');
      $result = json_decode($result);
      $count = 0;

      if ($result->meta->code == 200)
      {
          foreach ($result->data as $post) {
              if ($count == 0)
              {
                  echo '<div class="small-6 large-6 columns">';
                  echo '<img src="'.$post->images->standard_resolution->url.'" />';
                  echo '<a href="#" class="likes">'.$post->likes->count.'</a>';
                  echo '</div>';
              }
              else
              {
                  echo '<div class="small-3 large-3 columns">';
                  echo '<img src="'.$post->images->low_resolution->url.'" alt="'.$post->images->caption->text.'" />';
                  echo '</div>';                 }

              $count++;
          }
      }
      else {

          $to = 'jason.taikato@tobiasandtobias.com';
          $subject = 'System error mail';
          $message = '<html><head></head><body><p><strong>Type:</strong> '.$result->error_type.'</p><p><strong>Msg:</strong> '.$result->error_message.'</p><p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p></body></html>';


          //$message = 'Error:\rType: '.$result->error_type.'\rMsg: '.$result->error_message.'\rURL: '.$_SERVER['REQUEST_URI'];
          $from = 'website@harbourcityferries.com.au';
          $headers = "MIME-Version: 1.0rn";
          $headers .= "Content-type: text/html; charset=iso-8859-1rn";
          $headers  .= "From: .$from\r\n";
          mail($to,$subject,$message,$headers);


          echo '<div class="systemError"><h2>Error:</h2>';
          echo '<p>An email with the following message has been sent to the webmaster - sorry for any inconvenience.</a></p>';
          echo '<p><strong>Type:</strong> '.$result->error_type.'</p>';
          echo '<p><strong>Msg:</strong> '.$result->error_message.'</p>';
          echo '<p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p>';
          echo '</div>';
      }
  }
}
?>