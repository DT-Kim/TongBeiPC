//新建积分商品
function AddProExc()
{
    $.ajax({
    	type:"post",
    	url:"php/Exc.php",
    	async:true,
    	dataType:'json',
    	data:{
    	    falg:'addNew',
    	    name:$('#ProExcName').val(),
    	    reqc:$('#ProExcReq').val(),
    	    else:$('#ProExcElse').val(),
    	},
    	success:function(data){
    	    console.log(data)
    	    if(data['status'] == 'success')
    	    {
    	        alert('积分商品新建成功')
    	        $('#proexc-add').modal('hide')
    	    }
    	},
    	error:function(s,e,t){
    	    alert('积分商品新建失败，请及时联系管理员')
    	}
    });
}
//删除积分商品
function DelProExc()
{
    
}
//编辑积分商品
function EditProExc()
{
    
}