<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo Config::get('site_name'); ?></title>
    <?php echo App::getAssets()->css();?>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?php echo Config::get('site_name'); ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php echo App::getRouter()->getController() == 'pages' ? 'class="active"' : ''; ?>>
                        <a href="/pages">Pages</a>
                    </li>
                    <li <?php echo App::getRouter()->getController() == 'contacts' ? 'class="active"' : ''; ?>>
                        <a href="/contacts">Contact Us</a>
                    </li>
                </ul>
                <?php if (Session::get('is_active')) : ?>
                    <a style="float: right" class="navbar-brand" href="/admin">Admin</a>
                    <a style="float: right" class="navbar-brand" href="/users/logout">Logout</a>
                <?php else : ?>
                    <a style="float: right" class="navbar-brand" href="/users/login">Login</a>
                    <a style="float: right" class="navbar-brand" href="/users/register">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="starter-template">
            <?php if (Session::hasFlash()) : ?>
            <div class="alert alert-info" role="alert">
                <?php Session::flash(); ?>
            </div>
            <?php endif; ?>
            <?php echo $data['content']; ?>
        </div>
    </div>
    <?php echo App::getAssets()->js(); ?>
</body>
</html>