<center>
Click here to reset your password: 
<br>

<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> <img src="http://www.unixstickers.com/image/data/stickers/pacman/Pacman-key.sh.png"> </a>
</center>