<?php

class ViewHomePage extends Programster\AbstractView\AbstractView
{
    private bool $m_isLoggedIn;


    public function __construct(bool $isLoggedIn)
    {
        $this->m_isLoggedIn = $isLoggedIn;
    }

    protected function renderContent()
    {
?>

<?php if ($this->m_isLoggedIn === false): ?>
<a href="/auth/login">Login</a>
<?php else: ?>
<p>Congratulations! You are logged in through the SSO as <?= $_SESSION['user_id']; ?>.</p>
<p><a href="/auth/logout">Logout</a></p>
<?php endif; ?>


<?php
    }

}