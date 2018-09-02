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
            console.log(data)
            if(data['status'] == 'success'){
                //显示图片
                $('#ImgShow').attr('src',data['url'])
                //刷新表格数据
                tabMesSimple.ajax.reload();
                return
            }
            alert(data['warm'])
        },
        error:function(s,e,t){
            alert('出现错误，请及时联系管理员')
        }
    });
}

//修改广告信息
function EditAds()
{
    
}

//删除广告信息
function DelAds()
{
    
}
