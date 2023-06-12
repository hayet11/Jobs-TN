
/*const header = document.querySelector("header");

window.addEventListener ("scroll", function() {
	header.classList.toggle ("sticky", window.scrollY > 0);
});

let menu = document.querySelector('#menu-icon');
let navlist = document.querySelector('.navlist');

menu.onclick = () => {
	menu.classList.toggle('show-menu');
	navlist.classList.toggle('open');
    
};

window.onscroll = () => {
	menu.classList.remove('show-menu');
	navlist.classList.remove('open');
};*/

var project = setInterval(projectDone, 10)
var clients = setInterval(happyClients, 10)
var coffee = setInterval(cupsCoffee, 10)
let count1 = 1;
let count2 = 1;
let count3 = 1;

function projectDone() {
	count1++
	document.querySelector("#number1").innerHTML = count1
	if (count1 == 500) {
		clearInterval(project)
	}
}

function happyClients() {
	count2++
	document.querySelector("#number2").innerHTML = count2
	if (count2 == 89) {
		clearInterval(clients)
	}
}

function cupsCoffee() {
	count3++
	document.querySelector("#number3").innerHTML = count3
	if (count3 == 359) {
		clearInterval(coffee)
	}
}


let a =document.getElementById('Ovalt');
let b=document.getElementById('Cadiou');
let c=document.getElementById('Coulidoor');
let clienttext=document.getElementById('avis');
let clientimg=document.getElementById('img-avis');
console.log(a);
console.log(b);
console.log(c);
function client1()
{
	clienttext.innerHTML="Il est désormais facile de suivre les candidatures pour toutes les filiales";
	clientimg.src="undraw_Female_avatar_efig-removebg-preview.png";
	
}
function client2()
{
	clienttext.innerHTML="nous avons pu avancer rapidement lors de la mise en place du logiciel et nous avons toujours une réponse rapide à nos questions.";
	clientimg.src="undraw_Male_avatar_g98d-removebg-preview.png";
}
function client3()
{
	clienttext.innerHTML="Le  traitement des recrutement est devenu facile. Tant sur le partage, que la création de viviers et les réponses aux candidatures.";
	clientimg.src="undraw_Profile_pic_re_iwgo-removebg-preview.png";
}




a.addEventListener('click',client1);
b.addEventListener('click',client2);
c.addEventListener('click',client3);




function myFunction() {

    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }