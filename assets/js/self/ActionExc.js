//新建商品
function AddExc()
{     
	if(($('#ProListPic').val()).length && ($('#ProExcName').val()).length)
	{     
		ProListPic = document.getElementById("ProListPic").files;
        fData = new FormData();
        fData.append('flag','addNew')
        fData.append('name',$('#ProExcName').val())
        fData.append('req',$('#ExcReq').val())
        fData.append('else',$('#ProExcElse').val())
        fData.append('ProListPic',ProListPic[0])
        
		$.ajax({
			type:"post",
			url:"php/Exc.php",
			async:true,
			dataType:'json',
        	data:fData,
        	processData:false,
            contentType:false,
			success:function(data){
//				console.log(data)
				if(data['status'] == 'success')
        	    {
        	        alert('新建成功')
					$('#ProExcName').val('')
        	        $('#ExcReq').val('')
        	        $('#ProExcElse').val('')
        	        tabMesType.ajax.reload();
        	    }
        	    if(data['status'] == 'exist')
        	    {
        	        alert('商品类型已存在，请核实后再新建')
        	    }
        	},
        	error:function(s,e,t){
        		console.log(s +"  "+e)
        	    alert('商品类型新建失败，请及时联系管理员')
        	}
		});
	}
	else{
        alert('请将产品类型名或者图片上传填写完整')
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
			flag:'delExc',
			id:$('#ExcId').val(),
		},
//		console.log(data)
		success:function(data){
			if(data['status'] == 'success')
            {
                alert('商品删除成功');
                window.location.reload();
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
    {	ProListPic = document.getElementById("ProListPic").files;
        fData = new FormData();
        fData.append('flag','editExc')
        fData.append('name',$('#ProExcName').val())
        fData.append('req',$('#ExcReq').val())
        fData.append('else',$('#ProExcElse').val())
        fData.append('id',$('#ExcId').val())
        fData.append('ProListPic',ProListPic[0])
	        $.ajax({
	        	type:"post",
	        	url:"php/Exc.php",
	        	dataType:'json',
	        	async:true,
	        	data:fData,
        		processData:false,
           		contentType:false,
//	        	data:{
//	        	    flag:'editExc',
//	        	    name:$('#ProExcName').val(),
//	        	    req:$('#ExcReq').val(),
//	                else:$('#ProExcElse').val(),
//	                id:$('#ExcId').val(),
//	        	},
	            
	        	success:function(data){
//	        		console.log(data)
	        	    if(data['status'] == 'success')
	        	    {
	        	        alert('商品修改成功')
						$('#ProExcName').val('')
	        	        $('#ExcReq').val('')
	        	        $('#ProExcElse').val('')
	        	        $('#ProListPic').val('')
	        	        
	                    tabMesType.ajax.reload();
	                    return
	        	    }
        	},
        	error:function(s,e,t){
        		console.log(s +"  "+e)
        	    alert('商品修改失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将商品内容填写完整')
    }
}
function AddAds()
{     
    my_files = document.getElementById("AdsImg").files;
    if(!my_files.length)
    {
        alert('请选择文件后上传')
        return
    }
    //获取数据
    fData = new FormData();
    fData.append("flag",'add_photo')
    fData.append("dec",$('#adsMes').val())
    fData.append('AdsImg',my_files[0])
    fData.append('PhoSta',$('#AdsSta option:selected').val())
    fData.append('goodID',$('#goodid') .val());//商品的id
//  alert($('#goodid') .val())
    $.ajax({
        type:"post",
        url:"php/Exc.php",
        async:true,
        dataType:'json',
        data:fData,
        processData:false,
        contentType:false,
        success:function(data){
//          console.log(data)
            if(data['status'] == 'success'){
                //显示图片
                $('#ImgShow').attr('src',data['url'])
            }
            alert("新建成功")
//          alert(data['warm'])
            //刷新表格数据
            tabMesList.ajax.reload();
            return
        },
        error:function(s,e,t){
        	console.log(s +"  "+e)
            alert('出现错误，请及时联系管理员')
        }
    });
}

//修改广告信息
function EditAds()
{	
	my_files = document.getElementById("AdsImg").files;
//	修改图片的情况
    if(my_files.length)
    {
	fData = new FormData();
    fData.append("flag",'editAds')
    fData.append("dec",$('#adsMes').val())
    fData.append('AdsImg',my_files[0])
    fData.append('PhoSta',$('#AdsSta option:selected').val())
    fData.append("id",$('#MesId').val())
//  alert($('#MesId').val())
    $.ajax({
        type:"post",
        url:"php/Exc.php",
        async:true,
        dataType:'json',
        data:fData,
        processData:false,
        contentType:false,
        success:function(data){
        
            if(data['status'] == 'success'){
                //显示图片
                $('#ImgShow').attr('src',data['url'])
            }
            alert("修改成功")
//          alert(data['warm'])
            //刷新表格数据
            tabMesList.ajax.reload();
            return
        },
        error:function(s,e,t){
            alert('出现错误，请及时联系管理员')
        }
    });
}
    if(!my_files.length){
    	
    	fData = new FormData();
	    fData.append("flag",'editAds2')
	    fData.append("dec",$('#adsMes').val())
	    fData.append('PhoSta',$('#AdsSta option:selected').val())
	    fData.append("id",$('#MesId').val())
    	$.ajax({
    		type:"post",
    		url:"php/Exc.php",
    		async:true,
    		datatype:'json',
    		data:fData,
    		processData: false,
			contentType: false,
    		success:function(data){
    		 if(data['status']='success')
    			 {
        	        alert('修改成功')
        	        $('#adsMes').attr('value','')
        	        $('#AdsSta').attr('value','')
        	        tabMesList.ajax.reload();
        	    }
        	},
        	error:function(s,e,t){
        	    alert('商品修改失败，请及时联系管理员')
        	}
        });
    }
    
 }


//删除广告信息
function DelAds()
{
	if($("#adsMes").val() != "" || $("#adsMes").attr("value") != undefined){
		fData = new FormData();
	    fData.append("flag",'delAds')
	    fData.append("id",$('#MesId').val())
	    $.ajax({
			type:"post",
			url:"php/Exc.php",
			dataType:'json',
			async:true,
			data:fData,
	        processData:false,
	        contentType:false,
			success:function(data){
				if(data['status'] == 'success')
	            {
	                alert('广告节点删除成功')
	                tabMesList.ajax.reload();
	//             window.location.reload()
	            }
	        },
	        error:function(s,e,t)
	        {
	            alert('广告删除失败，请及时联系管理员')
	        }
			
		});
	}else{
		alert("请选择节点后再操作")
	}
}

