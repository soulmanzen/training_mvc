<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo Config::get('site_name'); ?> - <?php echo Lang::get('admin'); ?></title>
    <?php echo App::getAssets()->css();?>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" href="/css/style.css">-->
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
            <a class="navbar-brand" href="/admin"><?php echo Config::get('site_name'); ?> - <?php echo Lang::get('admin'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if (Session::get('user')) : ?>
                    <?php if (Session::get('role') == 'admin') : ?>
                    <li <?php echo App::getRouter()->getController() == 'users' ? 'class="active"' : ''; ?>>
                        <a href="/admin/users">Users</a>
                    </li>
                    <li <?php echo App::getRouter()->getController() == 'notifications' ? 'class="active"' : ''; ?>>
                        <a href="/admin/notifications">Notifications</a>
                    </li>
                    <?php endif; ?>
                <li <?php echo App::getRouter()->getController() == 'pages' ? 'class="active"' : ''; ?>>
                <a href="/admin/pages">Pages</a>
                </li>
                <li <?php echo App::getRouter()->getController() == 'contacts' ? 'class="active"' : ''; ?>>
                    <a href="/admin/contacts">Contact Us</a>
                </li>
                <?php endif; ?>
            </ul>
            <a style="float: right" class="navbar-brand" href="/">Home</a>
            <a style="float: right" class="navbar-brand" href="/users/logout">Logout</a>
            <div class="navbar-brand" style="font-size: 90%">
                <div style="color: darkgray;">Logged as </div>
                <div style="color: coral; float: right;" ><?php echo Session::get('user') ?></div>
            </div>
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