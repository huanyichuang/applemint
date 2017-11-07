//Switch Price Automatically
var prc = new Array();
var theForm = document.forms["shoppingCart"];
prc["青春還原露"] = 100;
prc["青春修復霜"] = 200;
prc["無敵保濕乳"] = 300;

function getPrice(){
var prodPrice = 0;
var prod = theForm.elements["sel1"];
prodPrice = prc[prod.value];

return prodPrice;

}
function calculateTotal()
{
    //Here we get the total price by calling our function
    //Each function returns a number so by calling them we add the values they return together
    var cakePrice = getPrice();

    //display the result
    var divobj = document.getElementById('price');
    divobj.style.display='block';
    divobj.innerHTML = "NT$ "+cakePrice;
    divobj.value = cakePrice;
    document.getElementById('priceAmt').value = cakePrice;
}
function hideTotal()
{
    var divobj = document.getElementById('price');
    divobj.style.display='none';
}

function passPrice(){

}