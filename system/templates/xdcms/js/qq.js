function FloatDiv(id)
{
	this.ID = id;
	this.ObjMove = document.getElementById(id);
	this.LastScrollY = 0; // 已经移动
	FloatDiv.prototype.Move = function(obj)
	{
		var scrollTop;
		if (document.documentElement && document.documentElement.scrollTop)
			scrollTop = document.documentElement.scrollTop;
		else if (document.body)
			scrollTop = document.body.scrollTop;
		var percent; // 本次移动像素
		percent = (scrollTop - obj.LastScrollY) * 0.1; // 每次移动10%
		if(percent > 0) percent = Math.ceil(percent); // 截掉小数，数字会变大
		else percent = Math.floor(percent); // 截掉小数，数字会变小
		obj.ObjMove.style.top = parseInt(obj.ObjMove.style.top) + percent + 'px';
		obj.LastScrollY = obj.LastScrollY + percent;
	};
	FloatDiv.prototype.Init = function(obj)
	{
		if (!obj.ObjMove)
		{
			alert('对象不存在');
			return;
		}
		window.setInterval(this.BindInterval(this.Move, obj), 10);
	};
	 // 绑定参数，window.setInterval，不能指定参数，需要绑定
	FloatDiv.prototype.BindInterval = function(funcName)
	{
		var args = [];
		for(var i = 1; i < arguments.length; i++)
		{
			args.push(arguments[i]);
		}
		return function() { funcName.apply(this, args); }
	};
}