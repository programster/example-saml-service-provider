<?php

class ViewHtmlTemplate extends Programster\AbstractView\AbstractView
{
    private string $m_body;

    
    public function __construct(string|stringable $body)
    {
        $this->m_body = (string)$body;
    }


    protected function renderContent()
    {
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SAML test</title>
</head>
<body>
    <?= $this->m_body; ?>
</body>
</html>


<?php
    }

}