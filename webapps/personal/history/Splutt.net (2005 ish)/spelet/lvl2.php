<html>
<head>
<title>Escape!</title>
<script language="JavaScript" type="text/javascript">

isNS4 = (document.layers) ? true : false;
isIE4 = (document.all && !document.getElementById) ? true : false;
isIE5 = (document.all && document.getElementById) ? true : false;
isNS6 = (!document.all && document.getElementById) ? true : false;

var curX, curY, curX2, curY2, boxX, boxY, moving=0, touch=0;
var gametime=0, started=0, speed;
var starttime, endtime, finaltime=0; //pass finaltime to popup window to ask for initials
var enemyxdir = new Array(1,1,1,1);
var enemyydir = new Array(1,1,1,1);

if (isNS4 || isNS6){
document.captureEvents(Event.MOUSEUP|Event.MOUSEDOWN|Event.MOUSEMOVE);
}
document.onmousedown = start;
document.onmousemove = checkLocation;
document.onmouseup = stop;

function startclock() {var today = new Date(); starttime = today.getTime();}
function endclock() {var today = new Date(); endtime = today.getTime();}
function calctime() {var time = (endtime - starttime - 0)/1000;	return time;}

function giveposX(divname) {
	if (isNS4) var posLeft = document.layers[divname].left;
	else if (isIE4 || isIE5) var posLeft = document.all(divname).style.pixelLeft;
	else if (isNS6) var posLeft = parseInt(document.getElementById(divname).style.left + "");
	return posLeft;
}

function giveposY(divname) {
	if (isNS4) var posTop = document.layers[divname].top;
	else if (isIE4 || isIE5) var posTop = document.all(divname).style.pixelTop;
	else if (isNS6) var posTop = parseInt(document.getElementById(divname).style.top + "");
	return posTop;
}

function setposX(divname, xpos) {
	if (isNS4) document.layers[divname].left = xpos;
	else if (isIE4 || isIE5) document.all(divname).style.pixelLeft = xpos;
	else if (isNS6) document.getElementById(divname).style.left = xpos;
}

function setposY(divname, ypos) {
	if (isNS4) document.layers[divname].top = ypos;
	else if (isIE4 || isIE5) document.all(divname).style.pixelTop = ypos;
	else if (isNS6) document.getElementById(divname).style.top = ypos;
}

function givesize(divname, dimension) {
	var divsize = 0;
		if (dimension == 'y') {
			if (isNS4) divsize = document.layers[divname].clip.height;
			else if (isIE4 || isIE5) divsize = document.all(divname).style.pixelHeight;
			else if (isNS6) divsize = parseInt(document.getElementById(divname).style.height + "");
		}
		else if (dimension == 'x') {
			if (isNS4) divsize = document.layers[divname].clip.width;
			else if (isIE4 || isIE5) divsize = document.all(divname).style.pixelWidth;
			else if (isNS6) divsize = parseInt(document.getElementById(divname).style.width + "");
		}

	return divsize;
}

// check to see if 'box' is touching 'enemy1'	
function checktouching(num) {
	
	var enemy = "enemy" + num + ""
	var difX = giveposX('box') - giveposX(enemy) - 0; // -0 converts to integer
	var difY = giveposY('box') - giveposY(enemy) - 0;
	
	// set touch = 1 if it is touching an enemy
	if (difX > (-1 * givesize('box', 'x')) && difX < givesize(enemy, 'x') && difY > (-1 * givesize('box', 'y')) && difY < givesize(enemy, 'y')) {
		touch = 1;
	}
	else touch = 0;

}

function movenemy(num,step_x,step_y){

	var enemy = "enemy" + num + ""
	var enemyx = givesize(enemy, 'x');
	var enemyy = givesize(enemy, 'y');

	if (giveposX(enemy) >= (450 - enemyx) || giveposX(enemy) <= 0) {
		enemyxdir[num] = -1 * enemyxdir[num];
		}
	if (giveposY(enemy) >= (450 - enemyy) || giveposY(enemy) <= 0) {
		enemyydir[num] = -1 * enemyydir[num];
		}

	var newposx = giveposX(enemy) + (step_x*enemyxdir[num]) + 0;
	var newposy = giveposY(enemy) + (step_y*enemyydir[num]) + 0;
	
	setposX(enemy, newposx);
	setposY(enemy, newposy);

	checktouching(num + "");
	if (touch == 1) {
		stop(); reset();
		}
}

function movenemies() {

	gametime = gametime + 1
	
	if (gametime >= 0 && gametime < 100) speed = 80;
	else if (gametime >= 100 &&  gametime < 200) speed = 60;
	else if (gametime >= 200 &&  gametime < 300) speed = 40;
	else if (gametime >= 300 &&  gametime < 400) speed = 30;
	else if (gametime >= 400 &&  gametime < 500) speed = 20;
	else speed = 10;
	// window.status = "speed:  " + speed + "   gametime: " + gametime;
	
	movenemy(0,-10,12);
	movenemy(1,-12,-20);
	movenemy(2,15,-13);
	movenemy(3,17,11);
	
	setTimeout(movenemies,speed);
}

function start(e) { 

	if (started == 0) {	movenemies(); 	startclock(); 	started = 1;	}
		
	curX = (isNS4 || isNS6) ? e.pageX : window.event.x ;
    curY = (isNS4 || isNS6) ? e.pageY : window.event.y ;
		
	curX2 = eval(curX - 40);
	curY2 = eval(curY - 40);
		
	boxX = eval(curX - 20);
	boxY = eval(curY - 20);	
		
	var boxleft = giveposX('box');
	var boxtop = giveposY('box');
				
	if (curX > boxleft && curX2 < boxleft && curY > boxtop && curY2 < boxtop) {
		
		moving = 1;
		setposX('box', boxX);
		setposY('box', boxY);

		if (isNS4 || isNS6){
		document.captureEvents(Event.MOUSEMOVE);
		}
	}
}

function stop(e){
    moving=0;
	if (isNS4 || isNS6){
	document.releaseEvents(Event.MOUSEMOVE);
	}
}

function reset(e){
    endclock();
	moving=0;
	if (isNS4 || isNS6){
		document.releaseEvents(Event.MOUSEMOVE);
		}

	if (finaltime == 0) {
		finaltime = calctime();
			if (finaltime >= 9) {

				window.alert('Du klarade ' + finaltime + ' sekunder. Nästa nivå:\nlvl 3');
				window.alert('Klarar du med ännu större ruta, i 10 sekunder?');
				location.href = "index.php?lvl=3";
				} else {
		window.alert('Du klarade ' + finaltime + ' sekunder. Försök igen...'); 
//		var entername = window.confirm('Enter your name?');
//			if (entername) {
//			window.open("?" + finaltime,'winwin','width=300,height=500,left=40,top=40,status=1,resizable');
//			document.location.reload();
//			}
//			else document.location.reload();
			document.location.reload(); }

		}
}

function checkLocation(e){
        
		curX = (isNS4 || isNS6) ? e.pageX : window.event.x ;
        curY = (isNS4 || isNS6) ? e.pageY : window.event.y ;		
		
		boxX = eval(curX - 20);
		boxY = eval(curY - 20);	
	
	checktouching('1');

	if (moving == 1 && touch == 0){
	
			setposX('box',boxX);
			setposY('box',boxY);
			
			if (curY > 69 && curX > 69 && curY < 381 && curX < 381) return false;
			else stop(); reset();
	}
	
	else if (touch == 1){
	stop(); reset();
	}

}

</script>
</head>

<body bgcolor="#ffffff" text="#ffffff" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

<div id="box" style="position: absolute; top: 180; left: 180; width:60; height:60; layer-background-color: #990000; background-color: #990000;">
<table width="60" height="60">
<tr><td>&nbsp;</td></td></tr>
</table>
</div>

<div id="enemy0" style="position: absolute; top: 330; left: 270; width:60; height:50; layer-background-color: #000099; background-color: #000099;">
<table width="60" height="50">
<tr><td>&nbsp;</td></tr>
</table>
</div>

<div id="enemy1" style="position: absolute; top: 60; left: 300; width:100; height:20; layer-background-color: #000099; background-color: #000099;">
<table width="100" height="20">
<tr><td>&nbsp;</td></tr>
</table>
</div>

<div id="enemy2" style="position: absolute; top: 320; left: 70; width:30; height:60; layer-background-color: #000099; background-color: #000099;">
<table width="30" height="60">
<tr><td>&nbsp;</td></tr>
</table>
</div>

<div id="enemy3" style="position: absolute; top: 70; left: 70; width:60; height:60; layer-background-color: #000099; background-color: #000099;">
<table width="60" height="60">
<tr><td>&nbsp;</td></tr>
</table>
</div>


<table border="0" cellspacing="0" cellpadding="0">
<!-- row 1 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 2 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 3 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 4 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 5 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 6 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 7 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 8 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>

<!-- row 9 -->
<tr>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
	<td width="50" height="50" bgcolor="#000000"><table><tr><td></td></tr></table></td>
</tr>
</table>
<br>
</body>
</html>