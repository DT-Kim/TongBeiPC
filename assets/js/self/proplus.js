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