<html>
  <title>Tool tải hình Google Map - Get Google Map Picture - LPTech.Asia</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <div class="jumbotron text-center">
  <h1>Tool tải hình Google Map - Get Google Map Picture</h1>
  <form action="" method="post">
    <input type="text" name="url">
    <button type="submit">Download</button>
</form>
</div>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
   $url = $_POST['url'];
    $html = get_web_page($url);
    $re = '/"AF1Qip\w+"/m';
    preg_match_all($re, $html, $images, PREG_SET_ORDER, 0);
    // Print the entire match result
    $data = [];
    foreach ($images as $value) {
        foreach ($value as $item) {
            $data[] = str_replace('"', '', $item);
        }
    }
    $links = array_unique($data);
}

function get_web_page( $url )
	{
	    $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
	    $options = array(
	        CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
	        CURLOPT_POST           =>false,        //set to GET
	        CURLOPT_USERAGENT      => $user_agent, //set user agent
	        CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
	        CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
	        CURLOPT_RETURNTRANSFER => true,     // return web page
	        CURLOPT_HEADER         => false,    // don't return headers
	        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	        CURLOPT_ENCODING       => "gzip",       // handle all encodings
	        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
	        CURLOPT_CONNECTTIMEOUT => 180,      // timeout on connect
	        CURLOPT_TIMEOUT        => 180,      // timeout on response
	        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	    );

	    $ch      = curl_init( $url );
	    curl_setopt_array( $ch, $options );
	    $content = curl_exec( $ch );
	    $err     = curl_errno( $ch );
	    $errmsg  = curl_error( $ch );
	    $header  = curl_getinfo( $ch );
	    curl_close( $ch );

	    $header['errno']   = $err;
	    $header['errmsg']  = $errmsg;
	    $header['content'] = $content;
	    
	    return $content;
	}
?>

<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Img</th>
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if (isset($links) && !empty($links))
  {
    foreach ($links as $item)
    {
        echo "<tr>
                <td><img src='https://lh3.ggpht.com/p/{$item}=s1024' width='120'></td>
                <td><a href='https://lh3.ggpht.com/p/{$item}=s1024' target='_blank'>Tải hình</a></td>
            </tr>";
    }
    }?>
  </tbody>
</table>
</div>