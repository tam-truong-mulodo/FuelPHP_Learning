<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $title; ?></h1>
    <div id="wrapper">
        <?php echo $content; ?>
        <hr>
        <p class="footer">
            <?php 
                $footer = 'Practice by Tam ' . Html::anchor('http://www.mulodo.com.vn/', '@Mulodo Inc.');
                echo $footer;
            ?>
		</p> 
	</div>
</body>
</html>
