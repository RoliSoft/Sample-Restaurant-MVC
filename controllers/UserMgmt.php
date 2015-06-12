<?
/**
 * Implements user management.
 */
class UserMgmt extends ControllerBase
{

	/**
	 * Generates the login page.
	 */
	public function login()
	{
		$this->app->view->make('header', $this->getHeaderVariables());
		$this->generateCsrfToken('lgn');
		$this->app->view->make('loginForm');
		$this->app->view->make('footer');
	}

	/**
	 * Logs the user in, if the info is correct.
	 */
	public function doLogin()
	{
		$error = false;

		if (!$this->verifyCsrfToken('lgn')) {
			$error = 'Security error: CSRF token validation failed.';
		}

		if (!$error && empty($name = trim($_POST['user']))) {
			$error = 'No username or email address specified.';
		}

		if (!$error && empty($pass = trim($_POST['pass']))) {
			$error = 'No password specified.';
		}

		if (!$error) {
			$users = (new User($this))->getAll('name = ? or email = ?', [$name, $name]);

			if (empty($users)) {
				$error = 'Specified username or password is incorrect.';
			}
			else {
				$user = $users[0];
			}
		}

		if (!$error && !$user->verifyPassword($pass)) {
			$error = 'Specified username or password is incorrect.';
		}

		$_SESSION['user'] = $user->toArray();
		$_SESSION['user']['time'] = time();

		if ($_POST['remember'] == 'on') {
			setcookie('pid', self::base64Encode(self::encrypt($user->id.'|'.$user->password)), 2000000000);
		}

		$this->app->view->make('header', $this->getHeaderVariables());

		if ($error) {
			$this->app->view->make('loginForm', ['errmsg' => $error]);
		}
		else {
			$this->app->view->make('successForm', [
				'title' => 'Signed In',
				'type' => 'success',
				'icon' => 'ok',
				'text' => 'Welcome back, <strong>'.htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8').'</strong>!',
				'url_href' => 'index',
				'url_text' => 'Go to Front Page'
			]);
		}

		$this->app->view->make('footer');
	}

	/**
	 * Generates the registration page.
	 */
	public function register()
	{
		$this->app->view->make('header', $this->getHeaderVariables());
		$this->generateCsrfToken('reg');
		$this->app->view->make('registerForm');
		$this->app->view->make('footer');
	}

	/**
	 * Registers the user, if the info is correct.
	 */
	public function doRegister()
	{
		$error = false;

		if (!$this->verifyCsrfToken('reg')) {
			$error = 'Security error: CSRF token validation failed.';
		}

		if (!$error && $_POST['agree'] != 'on') {
			$error = 'Agreement to the Terms of Service and Privacy Policy are required.';
		}

		if (!$error && (empty($name = trim($_POST['user'])) || empty($mail = trim($_POST['mail'])) || empty($pass = trim($_POST['pass'])) || empty($pazz = trim($_POST['pazz'])))) {
			$error = 'All fields are required in order to register.';
		}

		if (!$error && $pass != $pazz) {
			$error = 'Specified passwords do not match.';
		}

		if (!$error && strlen($name) < 2) {
			$error = 'Username must be at least 2 characters long.';
		}

		if (!$error && strlen($pass) < 4) {
			$error = 'Password must be at least 4 characters long.';
		}

		if (!$error && ($mail = filter_var($mail, FILTER_VALIDATE_EMAIL)) === false) {
			$error = 'Specified email address doesn\'t seem to be valid.';
		}
		else {
			$parts = explode('@', $mail);
		}

		if (!$error && !checkdnsrr($domain = array_pop($parts), 'MX')) {
			$error = 'Specified domain in email address doesn\'t accept emails.';
		}
		else {
			include 'libs/recaptcha/recaptchalib.php';
		}

		if (!$error && !recaptcha_check_answer('6LepavQSAAAAACIs7B6SHqf4vzLG85hliliqrElD', $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field'])->is_valid) {
			$error = 'Specified captcha is invalid.';
		}

		if (!$error) {
			$users = (new User($this))->getAll('name = ? or email = ?', [$name, $mail]);

			if (!empty($users)) {
				if ($users[0]->email == $mail) {
					$error = 'Specified email address is already registered.';
				}
				else {
					$error = 'Specified username is already taken.';
				}
			}
		}

		if (!$error) {
			$user = new User($this);
			$user->name = $name;
			$user->email = $mail;
			$user->type = UserTypes::Regular;
			$user->setPassword($pass);

			if (!$user->save()) {
				$error = 'Server error occurred while registering.';
			}
		}

		if (!$error) {
			$_SESSION['user'] = [
				'id' => $user->id,
				'name' => $user->name,
				'time' => time()
			];
		}

		$this->app->view->make('header', $this->getHeaderVariables());

		if ($error) {
			$this->app->view->make('registerForm', ['errmsg' => $error]);
		}
		else {
			$this->app->view->make('successForm', [
				'title' => 'Signed Up',
				'type' => 'success',
				'icon' => 'ok',
				'text' => 'You have successfully signed up.',
				'url_href' => 'index',
				'url_text' => 'Go to Front Page'
			]);
		}

		$this->app->view->make('footer');
	}

	/**
	 * Generates the reset page.
	 */
	public function reset()
	{
		$this->app->view->make('header', $this->getHeaderVariables());
		$this->generateCsrfToken('rst');
		$this->app->view->make('resetForm');
		$this->app->view->make('footer');
	}

	/**
	 * Sends a new password to the user.
	 */
	public function doReset()
	{
		$error = false;

		if (!$this->verifyCsrfToken('rst')) {
			$error = 'Security error: CSRF token validation failed.';
		}

		if (!$error && empty($user = trim($_POST['user']))) {
			$error = 'No username or email address specified.';
		}
		else {
			include 'libs/recaptcha/recaptchalib.php';
		}

		if (!$error && !recaptcha_check_answer('6LepavQSAAAAACIs7B6SHqf4vzLG85hliliqrElD', $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field'])->is_valid) {
			$error = 'Specified captcha is invalid.';
		}

		if (!$error) {
			$users = (new User($this))->getAll('name = ? or email = ?', [$user, $user]);

			if (empty($users)) {
				$error = 'No matching accounts found in database.';
			}
			else {
				$user = $users[0];
			}
		}

		if (!$error) {
			$pass = rand(100000, 999999);
			$user->setPassword($pass);

			// TODO: send email.

			if (!$user->save()) {
				$error = 'Server error occurred while resetting.';
			}
			else {
				$parts = explode('@', $users[0]->email);
				$domain = array_pop($parts);
			}
		}

		$this->app->view->make('header', $this->getHeaderVariables());

		if ($error) {
			$this->app->view->make('resetForm', ['errmsg' => $error]);
		}
		else {
			$this->app->view->make('successForm', [
				'title' => 'Account Recovery',
				'type' => 'success',
				'icon' => 'envelope',
				'text' => 'Check your inbox at <strong>'.htmlspecialchars($domain, ENT_QUOTES, 'UTF-8').'</strong> for further instructions.',
				'url_href' => 'index',
				'url_text' => 'Go to Front Page'
			]);
		}

		$this->app->view->make('footer');
	}

	/**
	 * Logs the user out.
	 */
	public function doLogout()
	{
		if (empty($_SESSION['user']) && empty($_COOKIE['pid'])) {
			$this->app->view->make('header', $this->getHeaderVariables());
			$this->app->view->make('successForm', [
				'title' => 'Sign Out',
				'type' => 'danger',
				'icon' => 'remove',
				'text' => 'You are not currently signed in.',
				'url_href' => 'index',
				'url_text' => 'Go to Front Page'
			]);
		}
		else {
			setcookie('pid', '', time() - 3600);
			$_SESSION['user'] = null;

			$this->app->view->make('header', $this->getHeaderVariables());
			$this->app->view->make('successForm', [
				'title' => 'Sign Out',
				'type' => 'success',
				'icon' => 'ok',
				'text' => 'You have been signed out.',
				'url_href' => 'index',
				'url_text' => 'Go to Front Page'
			]);
		}

		$this->app->view->make('footer');
	}

	/**
	 * Generates a CSRF token and inserts it into the session variable.
	 *
	 * @param string $name Name of the token.
	 */
	private static function generateCsrfToken($name)
	{
		if (empty($_SESSION[$name.'_csrf'])) {
			$_SESSION[$name.'_csrf'] = self::base64Encode(openssl_random_pseudo_bytes(19));
		}
	}

	/**
	 * Verifies whether the CSRF token is valid.
	 *
	 * @param string $name Name of the token.
	 * @param string $value Value of the token, or $_POST[token] if null.
	 *
	 * @return bool Value indicating whether the sent token is valid.
	 */
	private static function verifyCsrfToken($name, $value = null)
	{
		self::generateCsrfToken($name);

		if (!isset($value)) {
			$value = $_POST['token'];
		}

		return $_SESSION[$name.'_csrf'] == $value;
	}

	/**
	 * Generates the variables to be passed to the header.
	 *
	 * @return array Pre-set variables.
	 */
	public static function getHeaderVariables()
	{
		self::generateCsrfToken('lgn');

		return [
			'title' => 'Sapientia Canteen',
			'signedIn' => !empty($_SESSION['user']),
			'isAdmin' => $_SESSION['user']['type'] == 0,
			'user' => $_SESSION['user']['name']
		];
	}

	/**
	 * Encodes the input to Base64/URL.
	 *
	 * @param string $str String to encode.
	 *
	 * @return string Encoded string.
	 */
	public static function base64Encode($str)
	{
		return rtrim(strtr(base64_encode($str), '+/=', '-_,'), ',');
	}

	/**
	 * Decodes the input from Base64/URL.
	 *
	 * @param string $str String to decode.
	 *
	 * @return string Decoded string.
	 */
	public static function base64Decode($str)
	{
		return base64_decode(strtr($str, '-_,', '+/='));
	}

	/**
	 * Encrypts the specified string.
	 *
	 * @param string $str String to encrypt.
	 * @param string $key Encryption key.
	 *
	 * @return string Encrypted string.
	 */
	public static function encrypt($str, $key = null)
	{
		if (!isset($key)) {
			$key = '%oX"ea(6Ef]SR@$F%bkTz:4tA?!WdI+#';
		}

		if (strlen($key) != 32) {
			$key = hash('sha256', $key, true);
		}

		$iv = openssl_random_pseudo_bytes(32);

		$pad  = 32 - (strlen($str) % 32);
		$str .= str_repeat(chr($pad), $pad);

		return $iv.mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_CBC, $iv);
	}

	/**
	 * Decrypts the specified string.
	 *
	 * @param string $str String to decrypt.
	 * @param string $key Decryption key.
	 *
	 * @return string Decrypted string.
	 */
	public static function decrypt($str, $key = null)
	{
		if (!isset($key)) {
			$key = '%oX"ea(6Ef]SR@$F%bkTz:4tA?!WdI+#';
		}

		if (strlen($key) != 32) {
			$key = hash('sha256', $key, true);
		}

		$iv  = substr($str, 0, 32);
		$str = substr($str, 32);

		$str = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $str, MCRYPT_MODE_CBC, $iv);
		$pad = ord($str[strlen($str) - 1]);

		return substr($str, 0, -$pad);
	}

}
