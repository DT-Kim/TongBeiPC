//新建类型
function AddProType()
{    
    if(($('#ProTypeName').val()).length)
    {
        $.ajax({
        	type:"post",
        	url:"php/ProType.php",
        	async:true,
        	dataType:'json',
        	data:{
        	    falg:'addNew',
        	    name:$('#ProTypeName').val(),
                else:$('#ProTypeElse').val()
        	},
        	success:function(data){
        	    if(data['status'] == 'success')
        	    {
        	        alert('新建成功')
        	        $('#ProTypeName').attr('value','')
        	       $('#ProTypeElse').attr('value','')
        	    }
        	    if(data['status'] == 'exist')
        	    {
        	        alert('产品类型已存在，请核实后再新建')
        	    }
        	},
        	error:function(s,e,t){
        	    alert('产品类型新建失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将产品类型名填写完整')
    }
}

//删除类型
function DelProType()
{
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
            }
        },
        error:function(s,e,t)
        {
            alert('产品类型删除失败，请及时联系管理员')
        }
    });
}

//编辑类型
function EditProType()
{
    if(($('#ProTypeName').val()).length)
    {
        $.ajax({
        	type:"post",
        	url:"php/ProType.php",
        	dataType:'json',
        	async:true,
        	data:{
        	    falg:'editType',
        	    name:$('#ProTypeName').val(),
                else:$('#ProTypeElse').val(),
                id:$('#ProTypeId').val(),
        	},
        	success:function(data){
        	    if(data['status'] == 'success')
        	    {
        	        alert('产品类型修改成功')
        	        $('#ProTypeName').attr('value','')
                    $('#ProTypeElse').attr('value','')
        	    }
        	},
        	error:function(s,e,t){
        	    alert('产品类型修改失败，请及时联系管理员')
        	}
        });
    }else{
        alert('请将产品类型名填写完整')
    }
}

//新建产品
function AddProNew()
{
    alert('新建产品')
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