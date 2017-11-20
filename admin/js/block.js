function fieldtype(type){
		if(type=="text"||type=="textarea"){
			document.getElementById('text_show').style.display = 'block';
		}else{
			document.getElementById('text_show').style.display = 'none';
		}
		
		if(type=="textarea"){
			document.getElementById('textarea_show').style.display = 'block';
		}
		else{
			document.getElementById('textarea_show').style.display = 'none';
		}
}

function islink(value){
		if(value=="1"){
			document.getElementById('text_show').style.display = 'block';
		}else{
			document.getElementById('text_show').style.display = 'none';
		}
}


function checkAll(box1) {
    var ids = document.getElementsByName("id[]");
	if (ids != null) {
		for (i=0; i<ids.length; i++) {
			var obj = ids[i];
			obj.checked = box1.checked;
		}
	}
}

//===========================点击展开关闭效果====================================
function openShutManager(oSourceObj,oTargetObj,shutAble,oOpenTip,oShutTip){
	var sourceObj = typeof oSourceObj == "string" ? document.getElementById(oSourceObj) : oSourceObj;
	var targetObj = typeof oTargetObj == "string" ? document.getElementById(oTargetObj) : oTargetObj;
	var openTip = oOpenTip || "";
	var shutTip = oShutTip || "";
	if(targetObj.style.display!="none"){
	   if(shutAble) return;
	   targetObj.style.display="none";
	   if(openTip && shutTip){
		sourceObj.innerHTML = shutTip; 
	   }
	} else {
	   targetObj.style.display="block";
	   if(openTip && shutTip){
		sourceObj.innerHTML = openTip; 
	   }
	}
}


//根据模型选择模板
function jsSelectIsExitItem(objSelect, objItemValue) { 
	var isExit = false; 
	for (var i = 0; i < objSelect.options.length; i++) { 
		if (objSelect.options[i].value == objItemValue) { 
			isExit = true; 
			break; 
		} 
	} 
	return isExit; 
} 


function jsSelectItemByValue(objSelect,objItemValue)
{    
    //判断是否存在
    for(var i=0;i<objSelect.options.length;i++)
    {
        if(objSelect.options[i].value == objItemValue)
        {
            objSelect.options[i].selected = true;
            break;
        }
    }       
}



function get_model(modelname){
	var cate=document.addform.template_cate;
	var list=document.addform.template_list;
	var show=document.addform.template_show;
	cateValue = "category_"+modelname+".html";
	listValue = "list_"+modelname+".html";
	showValue = "show_"+modelname+".html";
	
	if (jsSelectIsExitItem(cate, cateValue)) { 
		jsSelectItemByValue(cate, cateValue);
	} else { 
		var cateItem = new Option(cateValue, cateValue); 
		cate.options.add(cateItem); 
		jsSelectItemByValue(cate, cateValue);
	} 
	
	if (jsSelectIsExitItem(list, listValue)) { 
		jsSelectItemByValue(list, listValue);
	} else { 
		var listItem = new Option(listValue, listValue); 
		list.options.add(listItem); 
		jsSelectItemByValue(list, listValue);
	} 
	
	if (jsSelectIsExitItem(show, showValue)) { 
		jsSelectItemByValue(show, showValue);
	} else { 
		var showItem = new Option(showValue, showValue); 
		show.options.add(showItem); 
		jsSelectItemByValue(show, showValue);
	} 
}

//取得urlrule
function get_url(value){
	var list=document.addform.url_list;
	var show=document.addform.url_show;
	
	//默认urlrule
	if(value=='0'){
		listValue=1;
		showValue=2;
	}else if(value=='1'){
		listValue=3;
		showValue=4;
	}else{
		listValue=5;
		showValue=6;
	}

	if (jsSelectIsExitItem(list, listValue)) { 
		jsSelectItemByValue(list, listValue);
	} 
	
	if (jsSelectIsExitItem(show, showValue)) { 
		jsSelectItemByValue(show, showValue);
	}
}

function sAlert(str){
	var msgw,msgh,bordercolor;
	msgw=300;//提示窗口的宽度
	msgh=80;//提示窗口的高度
	bordercolor="#336699";//提示窗口的边框颜色
	titlecolor="#99CCFF";//提示窗口的标题颜色
	
	var sWidth,sHeight;
	sWidth=document.body.offsetWidth;
	sHeight=document.body.offsetHeight;
	
	
	var bgObj=document.createElement("div");
	bgObj.setAttribute('id','bgDiv');
	bgObj.style.position="absolute";
	bgObj.style.top="0";
	bgObj.style.background="#777";
	bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";
	bgObj.style.opacity="0.6";
	bgObj.style.left="0";
	bgObj.style.width=sWidth + "px";
	bgObj.style.height=sHeight + "px";
	document.body.appendChild(bgObj);
	var msgObj=document.createElement("div")
	msgObj.setAttribute("id","msgDiv");
	msgObj.setAttribute("align","center");
	msgObj.style.position="absolute";
	msgObj.style.background="white";
	msgObj.style.font="12px/1.6em Verdana, Geneva, Arial, Helvetica, sans-serif";
	msgObj.style.border="1px solid " + bordercolor;
	msgObj.style.width=msgw + "px";
	msgObj.style.height=msgh + "px";
	msgObj.style.top=(document.documentElement.scrollTop + (sHeight-msgh)/2) + "px";
	msgObj.style.left=(sWidth-msgw)/2 + "px";
	var title=document.createElement("h4");
	title.setAttribute("id","msgTitle");
	title.setAttribute("align","right");
	title.style.margin="0";
	title.style.padding="3px";
	title.style.background=bordercolor;
	title.style.filter="progid:DXImageTransform.Microsoft.Alpha(startX=20, startY=20, finishX=100, finishY=100,style=1,opacity=75,finishOpacity=100);";
	title.style.opacity="0.75";
	title.style.border="1px solid " + bordercolor;
	title.style.height="18px";
	title.style.font="12px Verdana, Geneva, Arial, Helvetica, sans-serif";
	title.style.color="white";
	title.style.cursor="pointer";
	title.innerHTML="关闭";
	title.onclick=function(){
		document.body.removeChild(bgObj);
		document.getElementById("msgDiv").removeChild(title);
		document.body.removeChild(msgObj);
	}
	document.body.appendChild(msgObj);
	document.getElementById("msgDiv").appendChild(title);
	var txt=document.createElement("p");
	txt.style.margin="1em 0"
	txt.setAttribute("id","msgTxt");
	txt.innerHTML=str;
	document.getElementById("msgDiv").appendChild(txt);
}