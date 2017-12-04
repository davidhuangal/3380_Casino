<!--
	name: Kyle Moore
	pawprint: Kamqn2
	date: 11/27/2017
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kyle's Kasino</title>
        <link rel="stylesheet" href="style.css">
        <link href="jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
		<style>
            
			#outer{
                width: 1280px;
                height: 900px;
                border: solid;
                margin: auto;
                border-radius: 100px;
                background-color: saddlebrown;
			}
            
			#inner{
                width: 1180px;
                height: 800px;
                border: solid;
                margin: auto;
                margin-top: 40px;
                border-radius: 100px;
                background-color: darkgreen;
			}
            
            #dmark{
                margin: auto;
                text-align: center;
                border: solid;
                border-radius: 10px;
                border-width: 2px;
                height: 125px;
                width: 1100px;
                border-color: white;
            }
            
            #umark{
                margin: auto;
                text-align: center;
                border: solid;
                border-radius: 10px;
                border-width: 2px;
                height: 125px;
                width: 400px;
                border-color: white;
            }
            
            #p2mark{
                margin: auto;
                text-align: center;
                border: solid;
                border-radius: 10px;
                border-width: 2px;
                height: 125px;
                width: 400px;
                border-color: white;
            }
            
            #p3mark{
                margin: auto;
                text-align: center;
                border: solid;
                border-radius: 10px;
                border-width: 2px;
                height: 125px;
                width: 400px;
                border-color: white;
            }
            
			#dealer{
                text-align: center;
                margin: auto;
                width: 1100px;
			}
            
			#player2{
                text-align: center;
                position: relative;
                transform: rotate(90deg);
                top: 150px;
                left: -500px;
                min-width: 700px;
			}
            
			#player3{
                text-align: center;
                position: relative;
                transform: rotate(-90deg);
                top: -500px;
                left: 500px;
                min-width: 700px;
			}
            
			#user{
                text-align: center;
                margin: auto;
                position: relative;
                top: 0px;
                width: 400px;
			}
            
			#username{
                
			}
            
			.p2img{
                position: relative;
                right: 30px;
                margin-right: -60px;
			}
            
			.p3img{
                position: relative;
                right: 30px;
                margin-right: -60px;
			}
            
			.uimg{
                position: relative;
                right: 30px;
                margin-right: -60px;
			}
            
            #betarea{
                resize: none;
            }
            
		</style>
        <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
		<script> 
            $(document).ready(function(){
                $('#menu').load('menu.html');
                $('#koincount').load('getkoins.php');
            });
                
			var userhand = [];
			var userhandval = 0;
			var player2hand = [];
			var player2handval = 0;
			var player3hand = [];
			var player3handval = 0;
			var dealerhand = [];
			var dealerhandval = 0;
			var types = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];
			var suits = ["c", "d", "h", "s"];
			var deck = [];
			
			function set(){
			    userhand = [];
			    player2hand = [];
			    player3hand = [];
			    dealerhand = []; 
			    userhandval = 0;
			    player2handval = 0;
			    player3handval = 0;
			    dealerhandval = 0;
			    deck = [];
			    for(var i=0; i<suits.length; i++){
			        for(var j=0; j<types.length; j++){
			            var card = {type: types[j], suit: suits[i]};
			            deck.push(card);
			        }
			    }
			}
			
			function start(){
                if(!validatebet()){
                    return;
                }
                document.getElementById("betfield").setAttribute("readonly", true);
			    document.getElementById("Start").disabled = true; 
			    var images = document.getElementsByTagName('img'); 
			    for(var i = 0; i < images.length; i++) {
			        images[i].style.visibility = "hidden";
			    }
			    set();
			    userhand.push(hit());
			    player2hand.push(hit());
			    player3hand.push(hit());
			    dealerhand.push(hit());
			    userhand.push(hit());
			    player2hand.push(hit());
			    player3hand.push(hit());
			    dealerhand.push(hit());
			    displaycards();
			    userhandval = countcards(userhand);
			    player2handval = countcards(player2hand);
			    player3handval = countcards(player3hand);
			    dealerhandval = countcards(dealerhand);
			    document.getElementById("Hit").disabled = false; 
			    document.getElementById("Stand").disabled = false;
                document.getElementById("DoubleDown").disabled = false; 
			}
			
			function hit(){
			    var num = Math.floor(Math.random() * (deck.length - 1)) + 0;
			    var card = deck[num];
			    deck.splice(num , 1);
			    return card;
			}
			
			function userhit(){
			    userhand.push(hit());
			    userhandval = countcards(userhand);
			    if(userhandval == 0){
			        endround();
			    }
			}
			
			function countcards(hand){
			    var totalval = 0;
			    var hasace = false;
			    for(var i=0; i<hand.length; i++){
			        var value = 0;
			        if(hand[i].type == 'A'){
			            value = 11;
			            hasace = true;
			        }
			        if(hand[i].type == 'A' && (totalval + 11) > 21){
			            value = 1;
			        }
			        if(isNaN(hand[i].type) && hand[i].type != 'A'){
			            value = 10;
			        }
			        if(!isNaN(hand[i].type) && value == 0){
			            value = parseInt(hand[i].type);;
			        }
			        totalval += value;
			    }
			    if(totalval > 21 && hasace){
			        totalval = totalval - 10;
			    }
			    if(totalval > 21){
			        totalval = 0;
			    }
			    displaycards();
			    return totalval;
			}
			
			function displaycards(){
			    var i;
			    for(i=0; i<userhand.length; i++){
			        var imgpath = findpath(userhand[i]);
			        var imgid = "u";
			        imgid += (i+1);
			        document.getElementById(imgid).src = imgpath;
			        document.getElementById(imgid).style.visibility = "visible";
			    }
			    for(i=0; i<dealerhand.length; i++){
			        var imgpath = findpath(dealerhand[i]);
			        var imgid = "d";
			        imgid += (i+1);
			        document.getElementById(imgid).src = imgpath;
			        document.getElementById(imgid).style.visibility = "visible";
			    }
			    for(i=0; i<player2hand.length; i++){
			        var imgpath = findpath(player2hand[i]);
			        var imgid = "p2";
			        imgid += (i+1);
			        document.getElementById(imgid).src = imgpath;
			        document.getElementById(imgid).style.visibility = "visible";
			    }
			    for(i=0; i<player3hand.length; i++){
			        var imgpath = findpath(player3hand[i]);
			        var imgid = "p3";
			        imgid += (i+1);
			        document.getElementById(imgid).src = imgpath;
			        document.getElementById(imgid).style.visibility = "visible";
			    }
			}
			
			function findpath(card){
			    var path = "images/cards";
			    if(card.suit == 'c'){
			        path += "/clubs";
			    }
			    if(card.suit == 'd'){
			        path += "/diamonds";
			    }
			    if(card.suit == 'h'){
			        path += "/hearts";
			    }
			    if(card.suit == 's'){
			        path += "/spades";
			    }
			    path += ("/" + card.type);
			    path += ".png";
			    return path;
			}
			
			function compplay(){
			    var dealerstop = false;
			    var player2stop = false;
			    var player3stop = false;
			    while(!player2stop){
			        if(player2handval < 15 && player2handval != 0){
			            player2hand.push(hit());
			            player2handval = countcards(player2hand);
			        }
			        if(player2handval >= 15 && player2handval <= 17 && Math.random() > 0.5){
			            player2hand.push(hit());
			            player2handval = countcards(player2hand);
			        }
			        if(player2handval > 15 || player2handval == 0){
			            player2stop = true;
			        }
			    }
			    while(!player3stop){
			        if(player3handval < 15 && player3handval != 0){
			            player3hand.push(hit());
			            player3handval = countcards(player3hand);
			        }
			        if(player3handval >= 15 && player3handval <= 17 && Math.random() > 0.5){
			            player3hand.push(hit());
			            player3handval = countcards(player3hand);
			        }
			        if(player3handval > 15 || player3handval == 0){
			            player3stop = true;
			        }
			    }
			    while(!dealerstop){
			        if(dealerhandval < 15 || dealerhandval != 0){
			            dealerhand.push(hit());
			            dealerhandval = countcards(dealerhand);
			        }
			        if(dealerhandval >= 15 && dealerhandval <= 17 && Math.random() > 0.5){
			            dealerhand.push(hit());
			            dealerhandval = countcards(dealerhand);
			        }
			        if(dealerhandval > 15 || dealerhandval == 0){
			            dealerstop = true;
			        }
			    }
			}
			
			
			function endround(){
			    document.getElementById("Hit").disabled = true; 
			    document.getElementById("Stand").disabled = true;
                document.getElementById("DoubleDown").disabled = true;
			    compplay();
			    displaycards();
			    if(userhandval > dealerhandval){
			        document.getElementById("stat").setAttribute('value', 'w');
                    alert("You won!");
			    }
			    if(userhandval == dealerhandval && userhandval != 0){
                    document.getElementById("stat").setAttribute('value', 'p');
			        alert("Your hand equals that of the dealer. You push.");
			    }
			    if(userhandval < dealerhandval || userhandval == 0){
                    document.getElementById("stat").setAttribute('value', 'l');
			        alert("You lose!");
			    }
                setTimeout(function(){document.getElementById("betform").submit();}, 3000);
			}

            function doubled(){
                var num = document.forms["betform"]["bet"].value;
                num = num * 2;
                document.forms["betform"]["bet"].value = num;
                userhit();
                endround();
            }
            
            function validatebet(){
                
                //Form validation from https://www.w3schools.com/js/js_validation.asp
                
                var val = document.forms["betform"]["bet"].value;
                
                if(val == ""){
                    alert("Bet can't be empty!");
                    return false;
                }
                if(isNaN(val) || val<1){
                    alert("Invalid bet!");
                    return false;
                }
                return true;
            }
			 
		</script>
	</head>
	<body>
    <div id="menu"></div>
	<div id="table">
		<div id="outer">
			<div id="inner">
				<div id="dealer">
					<h1>Dealer</h1>
					<div id="dmark">						
						<img id="d1" src="images/cards/base.png" alt="Card Image"/>
						<img id="d2" src="images/cards/base.png" alt="Card Image"/>
						<img id="d3" src="images/cards/base.png" alt="Card Image"/>
						<img id="d4" src="images/cards/base.png" alt="Card Image"/>
						<img id="d5" src="images/cards/base.png" alt="Card Image"/>
						<img id="d6" src="images/cards/base.png" alt="Card Image"/>
						<img id="d7" src="images/cards/base.png" alt="Card Image"/>
						<img id="d8" src="images/cards/base.png" alt="Card Image"/>
						<img id="d9" src="images/cards/base.png" alt="Card Image"/>
						<img id="d10" src="images/cards/base.png" alt="Card Image"/>
						<img id="d11" src="images/cards/base.png" alt="Card Image"/>
						<img id="d12" src="images/cards/base.png" alt="Card Image"/>
						<img id="d13" src="images/cards/base.png" alt="Card Image"/>
					</div>
				</div>
				<div id="player2">
					<div id="p2mark">
						<img id="p21" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p22" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p23" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p24" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p25" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p26" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p27" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p28" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p29" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p210" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p211" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p212" src="images/cards/base.png" alt="Card Image" class="p2img"/>
						<img id="p213" src="images/cards/base.png" alt="Card Image" class="p2img"/>
					</div>
					<h1>Player 2</h1>
				</div>
				<div id="user">
                    <div id = "buttons">
                          <h2>Kyle Koin Balance:</h2>
                          <div id="koincount"></div>
                          <form id="betform" action="gameover.php" method="post">
                             <input type="text" placeholder="Enter Bet" name="bet" id="betfield">
                             <input type="hidden" name="status" value="" id="stat">
                          </form>
                          <br>
                          <br>
		                  <button onclick="start()" id = "Start" type="button" class="buttontype3">Start</button>
		                  <button onclick="userhit()" id = "Hit" type="button" class="buttontype4" disabled="true">Hit</button>
		                  <button onclick="endround()" id = "Stand" type="button"     class="buttontype3" disabled="true">Stand</button>
                          <button onclick="doubled()" id = "DoubleDown" type="button" class="buttontype4" disabled="true">Double Down</button>
	                </div>
                    <br>
					<div id="umark">
						<img id="u1" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u2" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u3" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u4" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u5" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u6" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u7" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u8" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u9" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u10" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u11" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u12" src="images/cards/base.png" alt="Card Image" class="uimg"/>
						<img id="u13" src="images/cards/base.png" alt="Card Image" 
							class="uimg"/>
					</div>
					<h1 id="username"><?php print $_GET["dname"]; ?></h1>
					<h4 id="miniuser">(you)</h4>
				</div>
				<div id="player3">
					<div id="p3mark">
						<img id="p31" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p32" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p33" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p34" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p35" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p36" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p37" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p38" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p39" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p310" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p311" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p312" src="images/cards/base.png" alt="Card Image" class="p3img"/>
						<img id="p313" src="images/cards/base.png" alt="Card Image" class="p3img"/>
					</div>
					<h1>Player 3</h1>
				</div>
			</div>
		</div>
	</div>
</body>
</html>