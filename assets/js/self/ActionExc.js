//新建商品
function AddExc()
{     
	if(($('#ProExcName').val()).length)
	{     
		$.ajax({
			type:"post",
			url:"php/Exc.php",
			async:true,
			dataType:'json',
			data:{
				falg:'addNew',
				name:$('#ProExcName').val(),
				req:$('#ExcReq').val(),
				else:$('#ProExcElse').val()
			},
			success:function(data){
				console.log(data)
				if(data['status'] == 'success')
        	    {
        	        alert('新建成功')
        	        $('#ProExcName').attr('value','')
        	        $('#ExcReq').attr('value','')
        	        $('#ProExcElse').attr('value','')
        	    }
        	    if(data['status'] == 'exist')
        	    {
        	        alert('商品类型已存在，请核实后再新建')
        	    }
        	},
        	error:function(s,e,t){
        	    alert('商品类型新建失败，请及时联系管理员')
        	}
		});
	}
	else{
        alert('请将产品类型名填写完整')
    }
}

//删除商品
function DelExc(){
	$.ajax({
		type:"post",
		url:"php/Exc.php",
		dataType:'json',
		async:true,
		data:{
			falg:'delExc',
			id:$('#ExcId').val(),
		},
//		console.log(data)
		success:function(data){
			if(data['status'] == 'success')
            {
                alert('商品删除成功')
            }
        },
        error:function(s,e,t)
        {
            alert('商品删除失败，请及时联系管理员')
        }
		
	});
}
//编辑商品
function EditExc(){
	if(($('#ProExcName').val()).length)
    {
    	
        $.ajax({
        	type:"post",
        	url:"php/Exc.php",
        	dataType:'json',
        	async:true,
        	data:{
        	    falg:'editExc',
        	    name:$('#ProExcName').val(),
        	    req:$('#ExcReq').val(),
                else:$('#ProExcElse').val(),
                id:$('#ExcId').val(),
        	},
            
        	success:function(data){
        	    if(data['status'] == 'success')
        	    {
        	        alert('商品修改成功')
        	        $('#ProExcName').attr('value','')
        	        $('#ExcReq').attr('value','')
                    $('#ProExcElse').attr('value','')
        	    }
        	},
        	error:function(s,e,t){
        	    alert('商品修改失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将商品内容填写完整')
    }
}
