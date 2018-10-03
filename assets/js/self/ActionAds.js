//新建广告
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
    fData.append("flag",'addNew')
    fData.append("dec",$('#adsMes').val())
    fData.append('AdsImg',my_files[0])
    fData.append('AdsSta',$('#AdsSta option:selected') .val())
    
    $.ajax({
        type:"post",
        url:"php/Ads.php",
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
            tabMesSimple.ajax.reload();
            return
        },
        error:function(s,e,t){
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
    fData.append('AdsSta',$('#AdsSta option:selected') .val())
    fData.append("id",$('#MesId').val())
    $.ajax({
        type:"post",
        url:"php/Ads.php",
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
            tabMesSimple.ajax.reload();
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
	    fData.append('AdsSta',$('#AdsSta option:selected') .val())
	    fData.append("id",$('#MesId').val())
    	$.ajax({
    		type:"post",
    		url:"php/Ads.php",
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
        	        tabMesSimple.ajax.reload();
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
	if($('#MesId').val()){
		fData = new FormData();
	    fData.append("flag",'delAds')
	    fData.append("id",$('#MesId').val())
	    $.ajax({
			type:"post",
			url:"php/Ads.php",
			dataType:'json',
			async:true,
			data:fData,
	        processData:false,
	        contentType:false,
			success:function(data){
				if(data['status'] == 'success')
	            {
	                alert('广告节点删除成功')
	               window.location.reload()
	            }
	        },
	        error:function(s,e,t)
	        {
	            alert('广告删除失败，请及时联系管理员')
	        }
			
		});
	}else{
		alert("请选中后再点击删除");
	}
	
}
function closephoto(){
	
	fData = new FormData();
    fData.append("flag",'closephoto')
    fData.append("id",$('#MesId').val())
    fData.append("stament",$('#stament').attr("value"));
	$.ajax({
		type:"post",
		url:"php/Ads.php",
		async:true,
		datatype:'json',
		data:fData,
		processData:false,
        contentType:false,
		success:function(data){
			if(data['status'] = 'success')
            {
            	$("#move1").removeClass("on").addClass("off");
                alert('关闭图片成功！')
			
            }
		},
		error:function(s,e,t)
        {
            alert('关闭图片失败，请及时联系管理员')
        }
	});
}
function showphoto(){
	
	fData = new FormData();
    fData.append("flag",'showphoto')
    fData.append("id",$('#MesId').val())
    fData.append("stament",$('#stament').attr("value"))
	$.ajax({
		type:"post",
		url:"php/Ads.php",
		async:true,
		datatype:'json',
		data:fData,
		processData:false,
        contentType:false,
		success:function(data){
			if(data['status'] = 'success')
            {
            	$("#move1").removeClass("off").addClass("on");
                alert('显示图片成功！')
            }
     
		},
		error:function(s,e,t)
        {
            alert('显示图片失败，请及时联系管理员')
        }
	});
	
}
