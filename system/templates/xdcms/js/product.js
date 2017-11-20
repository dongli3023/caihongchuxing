var speed1=25//速度数值越大速度越慢
document.getElementById("demo2").innerHTML=document.getElementById("demo1").innerHTML
function Marquee1(){
if(document.getElementById("demo2").offsetWidth-document.getElementById("demo").scrollLeft<=0)
document.getElementById("demo").scrollLeft-=document.getElementById("demo1").offsetWidth
else{
document.getElementById("demo").scrollLeft++
}
}
var MyMar1=setInterval(Marquee1,speed1)
document.getElementById("demo").onmouseover=function () {clearInterval(MyMar1)}
document.getElementById("demo").onmouseout=function () {MyMar1=setInterval(Marquee1,speed1)}