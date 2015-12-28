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
# Arma un menú automático con todas las funciones creadas en el sistema
# -----------------------

require_once './Sfphp/_base.php';

$_menus = Sfphp_Disco::XMLArreglo(new SimpleXMLElement(file_get_contents("./Etc/Config/menu.xml")));
?>
<html>
<head>
	<style type="text/css">
	.cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
	* html .cf { zoom: 1; }
	*:first-child+html .cf { zoom: 1; }

	html { margin: 0; padding: 0; }
	body { font-size: 100%; margin: 0; padding: 1.75em; font-family: 'Helvetica Neue', Arial, sans-serif; }

	h1 { font-size: 1.75em; margin: 0 0 0.6em 0; }

	a { color: #2996cc; }
	a:hover { text-decoration: none; }

	p { line-height: 1.5em; }
	.small { color: #666; font-size: 0.875em; }
	.large { font-size: 1.25em; }

	/**
	* Nestable
	*/

	.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }

	.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
	.dd-list .dd-list { padding-left: 30px; }
	.dd-collapsed .dd-list { display: none; }

	.dd-item,
	.dd-empty,
	.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

	.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
	background: #fafafa;
	background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
	background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
	background:         linear-gradient(top, #fafafa 0%, #eee 100%);
	-webkit-border-radius: 3px;
	border-radius: 3px;
	box-sizing: border-box; -moz-box-sizing: border-box;
	}
	.dd-handle:hover { color: #2ea8e5; background: #fff; }

	.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
	.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
	.dd-item > button[data-action="collapse"]:before { content: '-'; }

	.dd-placeholder,
	.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
	.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
	background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
	  -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
	background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
	     -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
	background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
	          linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
	background-size: 60px 60px;
	background-position: 0 0, 30px 30px;
	}

	.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
	.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
	.dd-dragel .dd-handle {
	-webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
	box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
	}

	/**
	* Nestable Extras
	*/

	.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

	@media only screen and (min-width: 700px) {

	.dd { float: left; width: 48%; }
	.dd + .dd { margin-left: 2%; }

	}

	.dd-hover > .dd-handle { background: #2ea8e5 !important; }

	/**
	* Nestable Draggable Handles
	*/

	.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
	background: #fafafa;
	background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
	background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
	background:         linear-gradient(top, #fafafa 0%, #eee 100%);
	-webkit-border-radius: 3px;
	border-radius: 3px;
	box-sizing: border-box; -moz-box-sizing: border-box;
	}
	.dd3-content:hover { color: #2ea8e5; background: #fff; }

	.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

	.dd3-item > button { margin-left: 30px; }

	.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
	border: 1px solid #aaa;
	background: #ddd;
	background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
	background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
	background:         linear-gradient(top, #ddd 0%, #bbb 100%);
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
	}
	.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
	.dd3-handle:hover { background: #ddd; }
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/united/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://dbushell.github.io/Nestable/jquery.nestable.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

    <div class="dd" id="nestable">
        <ol class="dd-list">
			<?php
			foreach ($_menus as $_menu) {
			?>
			<li class="dd-item">
				<div class="dd-handle">
					<?php echo $_menu["texto"] ?> - <?php echo $_menu["url"] ?>
				</div>
			</li>
			<?php
			}
			?>
        </ol>
    </div>

<script type="text/javascript">
var actual = null
$(function(){
	$('#nestable').nestable({group: 1})
	$('.dd-item').hover(function() {
		actual = this
		$(document).keydown(function(event) {
			if(46 == event.which)
				$(actual).remove()
        });
	}, function() {
       $(document).unbind("keydown")
    })
})
</script>

</body>
</html>