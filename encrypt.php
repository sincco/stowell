<?php
# 
# -/:::::::::::::::::::/- `/soooooooooooooooooooy: ./::::::::::::::::::://`                                                                             
# +:-------------------:+.-ho+/////////////////+sh.:/:------------------:*                                                                             
# +////:::::::::::::////+--hyyyssooooooooooossyyyh-+/////:::::::::::::////+                                                                             
# +/////////////////////+--hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+-.hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+--hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+.-hyyyyyyyyyyyyyyyyyyyyyh.//////////////////////+:                                                                             
# :///////////////////+/. `ohyyyyyyyyyyyyyyyyyyhh/ `////////////////////+:`                                                                             
#  .-------------------.    --------------------.   ```.------.``````````                            .......`           `......            `......`     
# +o+++++++++++++++++++so `:::::::::::::::::::::/-   -syhhyyyhyss-    sssss  ysssss+`    +sssy.  `:+shhyyyyhyy/-    `-ssyhyyyyhsy+`    `/osyhyyyyhys/.  
# hs++///////////////++sh:.+::-----------------:/+`-syyyhyyyyyyyyy+   yyyyh  dyyyyyys.   oyyyh.`:yyyyyyyyyyyyyyho` /hyyyyyyyyyyyyyy+  +hyyyyhyyyyyyyyyo.
# hyyyssssooooooossssyyyh/`+//////::::::::://////+`/hyyyd/-```ohyyh:  yyyyh  dyyyhyyyh:  oyyyh./hyyyy+`   `-hyyyh/.hyyyhs.    /yyyyho-hyyyho-   .-syyyyy
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+`-yyyyyyyyyyhss+:   yyyyh  dyyyhsyyyhh`oyyyh-oyyyh:       `----`yyyyys        ----.oyyyyo       `yyyyh
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+```/oshyyyyyyyyyho  yyyyh  dyyyy +hyyyhhyyyh-yyyyy/       .:::::hyyyys       `::::-oyyyys       -yyyyh
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+.yhyyds`  .:ohyyyd` yyyyh  dyyyy  `yyyyhyyyh./hyyyho.   ./syyyh/.hyyyh+-   `:yyyyh/.hyyyy+:    /yyyyys
# hyyyyyyyyyyyyyyyyyyyyyy-.+/////////////////////+`-yyyyyhyoyhhyyyh:  yyyyh  dyyyy    +hyyyyyh. +hyyyyyhhhyyyyyh+  -hyyyyyhhhyyyyyy/  :yhyyyyhhhyyyyyy+`
# +hhyyyyyyhhhhhhhhhhhhd-  -+++++++++++++++++++++.   /ohhyyyyyhhoo.   hhhhh  dhhhy     -shhhhd.   .syhhhyyhhyo:`     :+shhhyyhhho/      -/ohhhyyhhdo:`  
# 
# NOTICE OF LICENSE
#
# This source file is subject to the Open Software License (OSL 3.0)
# that is available through the world-wide-web at this URL:
# http://opensource.org/licenses/osl-3.0.php
#
# -----------------------
# @author: Iván Miranda
# @version: 1.0.0
# -----------------------
# Ejecución del framework
# -----------------------

require_once './Sfphp/__base.php';
$config = Sfphp_Config::get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sfphp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
    <div class="panel panel-primary">
        <div class="panel-heading">Simple Framework (for) PHP</div>
        <?php if(isset($_POST['s'])) { ?>
        	<h3><?php echo Sfphp::encrypt(trim($_POST['s']),$config['app']['key']); ?></h3>
        <?php } else { ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        	<label>Dato a encriptar:</label><input type="text" name="s" value=""><br>
        	<input type="submit" name="Encriptar" value="Encriptar">
        </form>
        <?php } ?>
	</div>
</body>
</html>
