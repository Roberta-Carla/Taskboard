/**
 * Function called when 'Login' button is pressed.
 * The browser will be redirected to the login.php page.
*/
function login() {
    window.top.location.replace('http://localhost/taskboard/header/login.php');
}

/**
 * Function called when 'Register' button is pressed.
 * The browser will be redirected to the register.php page.
*/
function register() {
    window.top.location.replace('http://localhost/taskboard/header/register.php');
}

/**
 * Function called when 'Logout' button is pressed.
 * The browser will be redirected to the logout.php page.
*/
function logout() {
    window.top.location.replace('http://localhost/taskboard/header/logout.php');
}
