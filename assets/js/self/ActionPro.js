//新建类型
function AddProType()
{    

    if(($('#ProTypeName').val()).length&&($('#ProTypeLogo').val()).length&&($('#ProTypeFile').val()).length)
    {
    	ProTypeLogo = document.getElementById("ProTypeLogo").files;
    	ProTypeFile = document.getElementById("ProTypeFile").files;
    	fData = new FormData();
	    fData.append("falg",'addNew')
	    fData.append("name",$('#ProTypeName').val())
	    fData.append('else',$('#ProTypeElse').val())
	    fData.append('ProTypeLogo',ProTypeLogo[0])
	    fData.append('ProTypeFile',ProTypeFile[0])
	    
        $.ajax({
        	type:"post",
        	url:"php/ProType.php",
        	async:true,
        	dataType:'json',
        	data:fData,
        	processData:false,
        	contentType:false,
        	success:function(data){
//      		console.log(data);
        	    if(data['status'] == 'success')
        	    {
        	        alert('新建成功')
        	        $('#ProTypeName').attr('value','')
        	        $('#ProTypeElse').attr('value','')
        	        tabMesType.ajax.reload();
        	    }
        	    if(data['status'] == 'exist')
        	    {
        	        alert('产品类型已存在，请核实后再新建')
        	    }
        	},
        	error:function(s,e,t){
//      		console.log(s+"  "+t+"  "+x);
        	    alert('产品类型新建失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将产品类型名填写完整，并上传图标和图片')
    }
}

//删除类型
function DelProType()
{
	var id = $('#ProTypeId').val();
	if(id != ""){
		$.ajax({
	    	type:"post",
	        url:"php/ProType.php",
	        dataType:'json',
	        async:true,
	        data:{
	            falg:'delType',
	            id:$('#ProTypeId').val(),
	        },
	        success:function(data){
	            if(data['status'] == 'success')
	            {
	                alert('产品类型删除成功')
	                tabMesType.ajax.reload();
	            }
	        },
	        error:function(s,e,t)
	        {
	            alert('产品类型删除失败，请及时联系管理员')
	        }
	    });
	}else{
		alert("请选择产品类型再进行删除");
	}
    
}

//编辑类型
function EditProType()
{
	if(($('#ProTypeName').val()).length)
    {
        
    	ProTypeLogo = document.getElementById("ProTypeLogo").files;
    	ProTypeFile = document.getElementById("ProTypeFile").files;
    	fData = new FormData();
	    fData.append("falg",'editType')
	    fData.append("name",$('#ProTypeName').val())
	    fData.append('else',$('#ProTypeElse').val())
	    fData.append('id',$('#ProTypeId').val())
	    if(ProTypeLogo.length > 0){
	    	fData.append('ProTypeLogo',ProTypeLogo[0])
	    }
	    if(ProTypeFile.length > 0){
	    	fData.append('ProTypeFile',ProTypeFile[0])
	    }
	    
        $.ajax({
        	type:"post",
        	url:"php/ProType.php",
        	async:true,
        	dataType:'json',
        	data:fData,
        	processData:false,
        	contentType:false,
        	success:function(data){
//      		console.log(data);
        	    if(data['status'] == 'success')
//      	    {
        	        alert('产品类型修改成功')
        	        $('#ProTypeName').attr('value','')
                    $('#ProTypeElse').attr('value','')
                    $('#ProTypeLogo').val("");
                    $('#ProTypeFile').val("");
                    tabMesType.ajax.reload();
//      	    }
        	},
        	error:function(x,s,t){
        		console.log(s+": "+t);
        	    alert('产品类型新建失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将产品类型名填写完整')
    }
//  if(($('#ProTypeName').val()).length)
//  {
//      $.ajax({
//      	type:"post",
//      	url:"php/ProType.php",
//      	dataType:'json',
//      	async:true,
//      	data:{
//      	    falg:'editType',
//      	    name:$('#ProTypeName').val(),
//              else:$('#ProTypeElse').val(),
//              id:$('#ProTypeId').val(),
//      	},
//      	success:function(data){
//      	    if(data['status'] == 'success')
//      	    {
//      	        alert('产品类型修改成功')
//      	        $('#ProTypeName').attr('value','')
//                  $('#ProTypeElse').attr('value','')
//                  tabMesType.ajax.reload();
//      	    }
//      	}, 
//      	error:function(s,e,t){
//      	    alert('产品类型修改失败，请及时联系管理员')
//      	}
//      });
//  }else{
//      alert('请将产品类型名填写完整')
//  }
}

//新建产品
function AddProNew()
{
	if(($('#ProListPic').val()).length && ($('#ListName').val()).length)
    {
        
        ProListPic = document.getElementById("ProListPic").files;
        fData = new FormData();
        fData.append('falg','addNewPro')
        fData.append('name',$('#ListName').val())
        fData.append('unit',$('#ListUnit').val())
        fData.append('price',$('#ListPrice').val())
        fData.append('score',$('#ListScore').val())
        fData.append('listid',$('#ProTypeId').val())
        fData.append('ProListPic',ProListPic[0])
        
        $.ajax({
        	type:"post",
        	url:"php/ProType.php",
        	async:true,
        	dataType:'json',
        	data:fData,
        	processData:false,
            contentType:false,
        	success:function(data){
        	    if(data['status'] == 'success')
        	    {
        	        alert('新建成功')
        	        $('#ListName').attr('value','')
        	        $('#ListUnit').attr('value','')
        	        $('#ListPrice').attr('value','')
        	        $('#ListScore').attr('value','')
        	        $('#ListId').attr('value','')
        	        tabMesList.ajax.reload();
        	    }
        	    if(data['status'] == 'exist')
        	    {
        	        alert('产品已存在，请核实后再新建')
        	    }
        	    $('#promes-add').modal('hide')
        	},
        	error:function(s,e,t){
        	    alert('产品新建失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将产品名填写完整')
    }
}

//删除产品
function DelProNew()
{
    alert('删除产品')
}

//修改产品信息
function EditProNew()
{
    alert('修改产品信息')
}

//

//

//

//

//

//

//

//

//

//

//

//

//

//

//

//